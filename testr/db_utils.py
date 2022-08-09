#!/usr/bin/python3
import sqlite3

DB_NAME = 'testr.db'

# returns a db cursor object
def db_con():
    return sqlite3.connect(DB_NAME)

# seeds the database with test data
def seed_db():
    con = db_con()
    cur = con.cursor()

    # reset the database so that it starts the same each
    # time the app is launched

    cur.execute('DROP TABLE IF EXISTS users')

    # create the users table

    cur.execute('CREATE TABLE users (email TEXT PRIMARY KEY, is_admin INTEGER, approved INTEGER, name TEXT NOT NULL, '+\
        'website TEXT, password TEXT NOT NULL, secret_phrase TEXT NOT NULL)')

    # seed users
    # username : password : secret_phrase
    # admin@tes.tr : $$7e75r$$4dm1n$$2021 : Blu3F1r3H0rs3
    # joe558@gmail.com : joeismyname : massivebabyfarts
    # anna.pavic@gmail.com : matryoshka : webbasedide
    # edinbruh09@gmail.com : ballislife : abitcringeinit
    # wienmalanders2021@gmail.com : mozart : systemoutprintln

    users = [('admin@tes.tr', 1, 1, 'Admin', None, 'eca50a7b0826ff1be5d9cb0796271a130ffcb48e485a8301d98cdd40bc016738', '2cc91f5afb99b3d2b22592cd760450321e86b2dd63ff7f2cd047f6b630a8a421'),
             ('joe558@gmail.com', None, 1, 'Joe', 'https://tuwien.ac.at', 'cc36428ca4376d8e1e43ea4e3141ab98690f8c227ae3e8a6e2ab21b5bb25daad', '6b7b160d22a0e6d18fe2af96d51e1f17ef7afaea5ea9b090387ee66ae8d2bc54'),
             ('anna.pavic@gmail.com', None, 1, 'Anna', 'https://minecraft.net', '3109ae030933b596b162e4717fc65bae94e11112109ba8b0d2990ed6fca941a2', '1e49402762907477939908fbdaeaf51e5f789e4299c8d45c6a0a7adb5d4deb0c'),
             ('edinbruh09@gmail.com', None, None, 'Marcus', None, '4ef61797d0a8a1c45b46e8c253060149c742df7561b299e7a57efaac2fb0489a', '02578f27155fa0f20b278c7cafa2da9b3c8a3a265b7ab376ec9c48c990da193c'),
             ('wienmalanders2021@gmail.com', None, None, 'Johannes', 'https://google.com', '06fca49e873e311ce7dac2de09b1f01193b94248daff30b9ca7a1ef7c6dfc471', 'd9cdf819e44e42d9ddd2c02adad30c76b6a0792f82b062542a77fce4826d4279')]

    cur.executemany('INSERT INTO users VALUES (?,?,?,?,?,?,?)', users)

    # commit and close connection
    con.commit()
    con.close()