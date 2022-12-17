from flask import Flask, render_template, request, session, redirect, url_for, flash
import pymysql
from termcolor import colored
from time import sleep
import hashlib
from cryptography.fernet import Fernet


app = Flask(__name__)

# python -c 'import secrets; print(secrets.token_hex())' <- generate key
app.secret_key = '4237a91524e5e4a67402ea137e94460fffffe8cbd7e2c9dd771db652c7798f86'

# fungsi untuk mengkoneksikan ke database mysql
def koneksi():
    host = 'localhost'
    user = 'root'
    pwd = ''
    db = 'dbpedulidiri'
    conn = pymysql.connect(host=host, user=user, password=pwd, database=db)
    return conn


# route halaman index
@app.route('/')
def index():
    return render_template('login.html') 


# route halaman login
@app.route('/login', methods=['GET', 'POST'])
def login():

    if request.method == "POST":

        nik = request.form['nik']
        nama = request.form['nama']

        hash_nik = hashlib.sha256(nik.encode()).hexdigest()
        hash_nama = hashlib.sha256(nama.encode()).hexdigest()

        try :
            conn = koneksi()
            cursor = conn.cursor()
            cursor.execute(f"SELECT nik, nama FROM tbuser WHERE nik = '{hash_nik}' AND nama = '{hash_nama}' ")
            session['username'] = nama
            session['nomernik'] = hash_nik
            return redirect(url_for('home'))

        except Exception as e :
            flash('Login Error !', 'danger')
            print(colored(f'[Error : {e}]', 'red', attrs=['bold']))

        finally :
            if cursor:
                cursor.close()
            if conn:
                conn.close()

    return render_template('login.html') 


# route halaman register
@app.route('/register', methods=['GET', 'POST'])
def register():
    
    if request.method == "POST":

        nik = request.form['nik']
        nama = request.form['nama']

        hash_nik = hashlib.sha256(nik.encode()).hexdigest()
        hash_nama = hashlib.sha256(nama.encode()).hexdigest()

        try :
            conn = koneksi()
            cursor = conn.cursor()
            cursor.execute(f"INSERT INTO `tbuser`(`nik`, `nama`) VALUES ('{hash_nik}', '{hash_nama}')")
            flash('Anda Berhasil Terdaftar!', 'success')
            conn.commit()
            sleep(3.0)
            return redirect(url_for('login'))

        except Exception as e :
            flash('Gagal Terdaftar!', 'danger')
            print(colored(f'[Error : {e}]', 'red', attrs=['bold']))

    return render_template('register.html') 

# route logout
@app.route('/logout')
def logout():

    session.pop('username', None)
    session.pop('nomernik', None)

    return redirect(url_for('login'))


# route halaman home
@app.route('/home')
def home():

    return render_template('home.html')


# route halaman catatan perjalanan
@app.route('/catatan_perjalanan')
def catatan_perjalanan():

    try : 
        conn = koneksi()
        cursor = conn.cursor()

        if (cursor.execute(f"SELECT tanggal, waktu, lokasi, suhu FROM tbperjalanan WHERE nik='{session['nomernik']}'")):
            data = cursor.fetchall()
            return render_template('catatan_perjalanan.html', data=data)

        else :
            flash('Data Belum Di Isi', 'danger')

    except Exception as e:
        print(colored(f'[Error : {e}]', 'red', attrs=['bold']))

    return render_template('catatan_perjalanan.html')


# route halaman isi data
@app.route('/isi_data', methods=['GET', 'POST'])
def isi_data():

    if request.method == "POST":

        tanggal= request.form['tanggal']
        jam = request.form['jam']
        lokasi = request.form['lokasi']
        suhu = request.form['suhu']

        try :  
            conn = koneksi()
            cursor = conn.cursor()
            cursor.execute(f"INSERT INTO tbperjalanan (nik, tanggal, waktu, lokasi, suhu)VALUES('{session['nomernik']}', '{tanggal}', '{jam}', '{lokasi}', '{suhu}')")
            flash('Data Tersimpan!', 'success')
            conn.commit()
            sleep(3.0)
            return redirect(url_for('catatan_perjalanan'))

        except Exception as e:
            flash('Data Gagal Tersimpan!', 'danger')
            print(colored(f'[Error : {e}]', 'red', attrs=['bold']))

        finally:
            if cursor:
                cursor.close()
            if conn:
                conn.close()
            
    return render_template('isi_data.html')


if __name__ == '__main__':
    app.run(host='127.0.0.1', debug=True, port=5050)