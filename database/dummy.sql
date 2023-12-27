-- Active: 1669815006177@@127.0.0.1@3306@inventory_jti
USE inventory_jti;

DELETE FROM DetailTransaksi;
DELETE FROM Transaksi;
DELETE FROM MaintainerInventaris;
DELETE FROM Inventaris;
DELETE FROM Maintainer;
DELETE FROM OTP;
DELETE FROM Pengguna;

DELETE FROM Status;

DELETE FROM Level;
DELETE FROM Kategori;

INSERT INTO Level (ID_Level, Nama) VALUES
	('L1', 'Admin'),
	('L2', 'Dosen'),
	('L3', 'Mahasiswa');

INSERT INTO Status (ID_Status, Nama) VALUES
	('S1', 'Menunggu'),
	('S2', 'Ditolak'),
	('S3', 'Diterima'),
	('S4', 'Proses'),
	('S5', 'Selesai'),
	('S6', 'Dibatalkan'),
    ('S7', 'Menunggu Ganti');

INSERT INTO Kategori (ID_Kategori, Nama) VALUES
	('K1', 'Peralatan'),
	('K2', 'Elektronik'),
	('K3', 'ATK');

INSERT INTO Pengguna (ID_Pengguna, ID_Level, Nomor_Identitas, Password, Nama, Email, Nomor_HP, Foto, Status, Salt) VALUES
	('P1', 'L1', '-', '$2y$10$k0yKxQLv4OSWGgEAWv4qr./UYbe5.f.SLyjJY9/XEqB6lJr81wQiS', 'Teknisi', 'adminInventory@polinema.ac.id', '8288482182', NULL, 'Aktif', 'asdfa'), -- password: admin
	('P2', 'L2', '199323048193211111', '$2y$10$vHIDwjeDhad.EKSaIda9duI60DRyjUNp/ORxubqJl1CmwlDoIBA0O', 'Dosen', 'dosen@dosen.polinema.ac.id', '82182324233', NULL, 'Aktif', 'adhel'), -- password: dosen
	('P3', 'L3', '2453635735', '$2y$10$Tp4nMLs0s3VzbjrLVoUYquFuEXQUgltSWWtI5QpvON9/iq96tUBCS', 'Mahasiswa 2E', 'mahasiswa@student.polinema.ac.id', '8288492928', NULL, 'Aktif', 'jdkad'); -- password: mahasiswa

INSERT INTO OTP (ID_OTP, ID_Pengguna, Kode, Expired) VALUES
	('O1', 'P2', 'SAD12', '2023-10-30 12:00:00'),
	('O2', 'P3', 'DAQW23', '2023-10-31 0:00:00');

INSERT INTO Inventaris (ID_Inventaris, Nama, Stok, ID_Kategori, Asal, Deskripsi, Gambar ) VALUES
	('I1', 'Spidol', '10', 'K3', 'Hibah', '-', 'spidol.jpeg'),
	('I2', 'Penghapus', '7', 'K3', 'Beli', '-', 'penghapus.jpeg'),
	('I3', 'Tang Crimping', '14', 'K1', 'Hibah', '-', 'tang-krimping.jpeg'),
	('I4', 'Obeng', '16', 'K1', 'Beli', '-', 'obeng.jpeg'),
	('I5', 'Konektor Proyektor', '30', 'K2', 'Hibah', '-', 'konektor-proyektor.jpeg'),
	('I6', 'Keyboard', '17', 'K2', 'Beli', '-', 'keyboard.jpeg'),
	('I7', 'Mouse', '24', 'K2', 'Hibah', '-', 'mouse.jpeg'),
	('I8', 'Monitor', '10', 'K2', 'Hibah', '-', 'monitor.jpeg');

INSERT INTO Maintainer (ID_Maintainer, Nama) VALUES
	('M1', 'Mas Woon'),
	('M2', 'Pak Jaidi'),
	('M3', 'Mbak Novi');

INSERT INTO MaintainerInventaris (ID_Inventaris, ID_Maintainer) VALUES
	('I1', 'M1'),
	('I2', 'M2'),
	('I3', 'M1'),
	('I4', 'M3'),
	('I5', 'M1'),
	('I6', 'M2'),
	('I7', 'M3'),
	('I8', 'M3');


INSERT INTO Transaksi (ID_Transaksi, ID_Pengguna, ID_Admin, ID_Status, StartDate, EndDate, Deskripsi_Keperluan, Jaminan, Pesan) VALUES
	('T1', 'P2', 'M1', 'S5', '2023-11-01 8:00:00', '2023-11-05 15:00:00', 'Perlu untuk acara seminar', null, 'Silahkan diambil diruang admin lt.6 || 2023-11-01 8:10:00'),
	('T2', 'P3', 'M1', 'S5', '2023-11-02 9:00:00', '2023-11-08 15:00:00', 'Untuk keperluan riset', 'anggap-aja-ktm.jpg', 'Silahkan diambil diruang teknisi lt.7 || 2023-11-02 9:10:00'),
	('T3', 'P2', 'M2', 'S2', '2023-11-05 10:00:00', '2023-11-15 15:00:00', 'Acara workshop', null, 'Silahkan diambil diruang teknisi lt.5 || 2023-11-05 10:10:00'),
	('T4', 'P3', 'M1', 'S5', '2023-11-10 11:00:00', '2023-11-20 15:00:00', 'Untuk keperluan presentasi', 'anggap-aja-ktm.jpg', 'Silahkan diambil diruang admin lt.6 || 2023-11-10 11:10:00'),
	('T5', 'P2', 'M3', 'S5', '2023-11-15 12:00:00', '2023-11-25 15:00:00', 'Acara pelatihan', null, 'Silahkan diambil diruang teknisi lt.7 || 2023-11-15 12:10:00'),
	('T6', 'P3', 'M3', 'S6', '2023-12-19 13:00:00', '2023-11-30 15:00:00', 'Untuk tugas kuliah', 'anggap-aja-ktm.jpg', 'Silahkan diambil diruang admin lt.6 || 2023-12-19 13:10:00'),
	('T7', 'P3', 'M2', 'S5', '2023-11-30 15:00:00', '2023-12-10 15:00:00', 'Untuk presentasi akhir', 'anggap-aja-ktm.jpg', 'Silahkan diambil diruang teknisi lt.7 || 2023-11-30 15:10:00'),
	('T8', 'P2', 'M1', 'S7', '2023-12-25 14:00:00', '2023-12-05 15:00:00', 'Acara seminar ', null, 'Silahkan diambil diruang teknisi lt.5 || 2023-12-25 14:10:00'),
	('T9', 'P2', 'M3', 'S5', '2023-12-01 16:00:00', '2023-12-12 15:00:00', 'Acara workshop akhir tahun', null, 'Silahkan diambil diruang admin lt. 6 || 2023-12-01 16:10:00'),
	('T10', 'P3', 'M2', 'S3', '2023-12-05 17:00:00', '2023-12-15 15:00:00', 'Untuk kegiatan UKM', 'anggap-aja-ktm.jpg', 'Silahkan diambil diruang teknisi lt.7 || 2023-12-05 17:10:00'),
	('T11', 'P3', 'M1', 'S1', '2023-12-18 17:00:00', '2023-12-15 15:00:00', 'Untuk mengerjakan tugas akhir', 'anggap-aja-ktm.jpg', 'Silahkan diambil diruang teknisi lt.5 || 2023-12-18 17:10:00');

INSERT INTO DetailTransaksi (ID_DetailTrc, ID_Transaksi, ID_Inventaris, Jumlah, Kondisi) VALUES
	('DT1', 'T1', 'I1', '2', 'Normal'),
	('DT2', 'T1', 'I3', '3', 'Normal'),
	('DT3', 'T1', 'I2', '1', 'Normal'),
	('DT4', 'T2', 'I7', '5', 'Rusak'),
	('DT5', 'T2', 'I8', '2', 'Normal'),
	('DT6', 'T2', 'I4', '2', 'Hilang'),
	('DT7', 'T3', 'I6', '3', 'Normal'),
	('DT8', 'T3', 'I2', '4', 'Normal'),
	('DT9', 'T3', 'I5', '1', 'Hilang'),
	('DT10', 'T4', 'I4', '2', 'Normal'),
	('DT11', 'T4', 'I6', '3', 'Normal'),
	('DT12', 'T4', 'I1', '2', 'Normal'),
	('DT13', 'T5', 'I3', '1', 'Normal'),
	('DT14', 'T5', 'I1', '5', 'Normal'),
	('DT15', 'T5', 'I4', '2', 'Normal'),
	('DT16', 'T6', 'I2', '1', 'Normal'),
	('DT17', 'T6', 'I7', '4', 'Normal'),
	('DT18', 'T6', 'I5', '2', 'Normal'),
	('DT19', 'T7', 'I4', '3', 'Rusak'),
	('DT20', 'T7', 'I6', '2', 'Hilang'),
	('DT21', 'T7', 'I7', '3', 'Normal'),
	('DT22', 'T8', 'I2', '2', 'Normal'),
	('DT23', 'T8', 'I1', '2', 'Normal'),
	('DT24', 'T8', 'I3', '3', 'Rusak'),
	('DT25', 'T9', 'I2', '4', 'Normal'),
	('DT26', 'T9', 'I4', '1', 'Normal'),
	('DT27', 'T9', 'I5', '1', 'Normal'),
	('DT28', 'T10', 'I4', '2', 'Normal'),
	('DT29', 'T10', 'I6', '3', 'Normal'),
	('DT30', 'T10', 'I7', '3', 'Normal'),
	('DT31', 'T11', 'I4', '1', 'Normal'),
	('DT32', 'T11', 'I3', '1', 'Normal');
