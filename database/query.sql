-- Active: 1669815006177@@127.0.0.1@3306@prakwebdb
DROP DATABASE IF EXISTS inventory_jti;

CREATE DATABASE IF NOT EXISTS inventory_jti;

USE inventory_jti;

CREATE TABLE Level (
    ID_Level VARCHAR(10) PRIMARY KEY,
    Nama VARCHAR(15)
);

CREATE TABLE Status (
    ID_Status VARCHAR(10) PRIMARY KEY,
    Nama VARCHAR(15)
);

CREATE TABLE Kategori (
    ID_Kategori VARCHAR(10) PRIMARY KEY,
    Nama VARCHAR(15)
);

CREATE TABLE Pengguna (
    ID_Pengguna VARCHAR(50) PRIMARY KEY,
    ID_Level VARCHAR(10),
    Nomor_Identitas VARCHAR(20),
    Password VARCHAR(200),
    Nama VARCHAR(100),
    Email VARCHAR(255),
    Nomor_HP VARCHAR(15),
    Foto VARCHAR(50),
    Status ENUM('AKTIF','TIDAK AKTIF'),
    Salt VARCHAR(50),
    FOREIGN KEY (ID_Level) REFERENCES Level(ID_Level)
);

CREATE TABLE OTP (
    ID_OTP VARCHAR(10) PRIMARY KEY,
    ID_Pengguna VARCHAR(50),
    Kode CHAR(6),
    Expired DATETIME,
    FOREIGN KEY (ID_Pengguna) REFERENCES Pengguna(ID_Pengguna)
);

CREATE TABLE Maintainer (
    ID_Maintainer VARCHAR(10) PRIMARY KEY,
    Nama VARCHAR(100)
);

CREATE TABLE Inventaris (
    ID_Inventaris VARCHAR(10) PRIMARY KEY,
    Nama VARCHAR(100),
    Stok INT,
    ID_Kategori VARCHAR(10),
    Asal ENUM('HIBAH', 'BELI'),
    Deskripsi TEXT,
    Gambar VARCHAR(50),
    FOREIGN KEY (ID_Kategori) REFERENCES Kategori(ID_Kategori)ON DELETE SET NULL ON UPDATE CASCADE
);

CREATE TABLE MaintainerInventaris (
    ID_Maintainer VARCHAR(10),
    ID_Inventaris VARCHAR(10),
    FOREIGN KEY (ID_Maintainer) REFERENCES Maintainer(ID_Maintainer) ON UPDATE CASCADE,
    FOREIGN KEY (ID_Inventaris) REFERENCES Inventaris(ID_Inventaris)  ON UPDATE CASCADE
);

CREATE TABLE Transaksi (
    ID_Transaksi VARCHAR(10) PRIMARY KEY,
    ID_Pengguna VARCHAR(10),
    ID_Admin VARCHAR(10),
    ID_Status VARCHAR(10),
    StartDate DATETIME,
    EndDate DATETIME,
    Deskripsi_Keperluan TEXT,
    Jaminan VARCHAR(50),
    Pesan TEXT,
    FOREIGN KEY (ID_Pengguna) REFERENCES Pengguna(ID_Pengguna) ON UPDATE CASCADE,
    FOREIGN KEY (ID_Admin) REFERENCES Maintainer(ID_Maintainer) ON UPDATE CASCADE,
    FOREIGN KEY (ID_Status) REFERENCES Status(ID_Status) ON UPDATE CASCADE
);
CREATE TABLE DetailTransaksi (
    ID_DetailTrc VARCHAR(10) PRIMARY KEY,
    ID_Transaksi VARCHAR(10),
    ID_Inventaris VARCHAR(10),
    Kondisi ENUM('Normal', 'Rusak', 'Hilang'),
    Jumlah INT,
    FOREIGN KEY (ID_Transaksi) REFERENCES Transaksi(ID_Transaksi) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (ID_Inventaris) REFERENCES Inventaris(ID_Inventaris)  ON UPDATE CASCADE
);
