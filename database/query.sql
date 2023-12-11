-- Active: 1683523504910@@127.0.0.1@3306@inventaris jti
DROP DATABASE IF EXISTS peminjaman_inventaris;

CREATE DATABASE IF NOT EXISTS peminjaman_inventaris;

USE peminjaman_inventaris;

CREATE TABLE Level (
    ID_Level VARCHAR(50) PRIMARY KEY,
    Nama VARCHAR(15)
);

CREATE TABLE Status (
    ID_Status VARCHAR(50) PRIMARY KEY,
    Nama VARCHAR(15)
);

CREATE TABLE Kategori (
    ID_Kategori VARCHAR(50) PRIMARY KEY,
    Nama VARCHAR(15)
);

CREATE TABLE Pengguna (
    ID_Pengguna VARCHAR(50) PRIMARY KEY,
    ID_Level VARCHAR(50),
    Nomor_Identitas VARCHAR(20),
    Password VARCHAR(200),
    Nama VARCHAR(100),
    Email VARCHAR(255),
    Nomor_HP VARCHAR(15),
    Foto VARCHAR(50),
    Status ENUM('Aktif', 'Tidak Aktif'),
    Salt VARCHAR(50),
    FOREIGN KEY (ID_Level) REFERENCES Level(ID_Level)
);

CREATE TABLE OTP (
    ID_OTP VARCHAR(50) PRIMARY KEY,
    ID_Pengguna VARCHAR(50),
    Kode CHAR(6),
    Expired DATETIME,
    FOREIGN KEY (ID_Pengguna) REFERENCES Pengguna(ID_Pengguna)
);

CREATE TABLE Maintainer (
    ID_Maintainer VARCHAR(50) PRIMARY KEY,
    Nama VARCHAR(100)
);

CREATE TABLE Inventaris (
    ID_Inventaris VARCHAR(50) PRIMARY KEY,
    Nama VARCHAR(100),
    Stok INT,
    ID_Kategori VARCHAR(50),
    Asal ENUM('Hibah', 'Beli'),
    Deskripsi TEXT,
    Gambar VARCHAR(50),
    FOREIGN KEY (ID_Kategori) REFERENCES Kategori(ID_Kategori)
);

CREATE TABLE MaintainerInventaris (
    ID_Maintainer VARCHAR(50),
    ID_Inventaris VARCHAR(50),
    PRIMARY KEY (ID_Maintainer, ID_Inventaris),
    FOREIGN KEY (ID_Maintainer) REFERENCES Maintainer(ID_Maintainer),
    FOREIGN KEY (ID_Inventaris) REFERENCES Inventaris(ID_Inventaris)
);

CREATE TABLE Transaksi (
    ID_Transaksi VARCHAR(50) PRIMARY KEY,
    ID_Pengguna VARCHAR(50),
    ID_Admin VARCHAR(50),
    ID_Status VARCHAR(50),
    StartDate DATETIME,
    EndDate DATETIME,
    Deskripsi_Keperluan TEXT,
    Jaminan VARCHAR(50),
    Pesan TEXT,
    FOREIGN KEY (ID_Pengguna) REFERENCES Pengguna(ID_Pengguna),
    FOREIGN KEY (ID_Admin) REFERENCES Maintainer(ID_Maintainer),
    FOREIGN KEY (ID_Status) REFERENCES Status(ID_Status)
);

CREATE TABLE DetailTransaksi (
    ID_DetailTrc VARCHAR(50) PRIMARY KEY,
    ID_Transaksi VARCHAR(50),
    ID_Inventaris VARCHAR(50),
    Jumlah INT,
    Kondisi ENUM('Normal', 'Rusak', 'Hilang'),
    FOREIGN KEY (ID_Transaksi) REFERENCES Transaksi(ID_Transaksi),
    FOREIGN KEY (ID_Inventaris) REFERENCES Inventaris(ID_Inventaris)
);