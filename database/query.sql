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
    Username VARCHAR(100),
    Password VARCHAR(200),
    Nama VARCHAR(100),
    Email VARCHAR(255),
    Nomor_HP VARCHAR(15),
    Foto VARBINARY(MAX),
    Status ENUM('AKTIF','TIDAK AKTIF'),
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
    Gambar VARBINARY(MAX),
    FOREIGN KEY (ID_Kategori) REFERENCES Kategori(ID_Kategori)
);

CREATE TABLE MaintainerInventaris (
    ID_Maintainer VARCHAR(10),
    ID_Inventaris VARCHAR(10),
    PRIMARY KEY (ID_Maintainer, ID_Inventaris),
    FOREIGN KEY (ID_Maintainer) REFERENCES Maintainer(ID_Maintainer),
    FOREIGN KEY (ID_Inventaris) REFERENCES Inventaris(ID_Inventaris)
);

CREATE TABLE Transaksi (
    ID_Transaksi VARCHAR(10) PRIMARY KEY,
    ID_Pengguna VARCHAR(10),
    ID_Admin VARCHAR(10),
    ID_Status VARCHAR(10),
    StartDate DATETIME,
    EndDate DATETIME,
    Deskripsi_Keperluan TEXT,
    Jaminan VARBINARY(MAX),
    Pesan TEXT,
    FOREIGN KEY (ID_Pengguna) REFERENCES Pengguna(ID_Pengguna),
    FOREIGN KEY (ID_Admin) REFERENCES Pengguna(ID_Pengguna),
    FOREIGN KEY (ID_Status) REFERENCES Status(ID_Status)
);
CREATE TABLE DetailTransaksi (
    ID_DetailTrc VARCHAR(10) PRIMARY KEY,
    ID_Transaksi VARCHAR(10),
    ID_Inventaris VARCHAR(10),
    Jumlah INT,
    FOREIGN KEY (ID_Transaksi) REFERENCES Transaksi(ID_Transaksi),
    FOREIGN KEY (ID_Inventaris) REFERENCES Inventaris(ID_Inventaris)
);
