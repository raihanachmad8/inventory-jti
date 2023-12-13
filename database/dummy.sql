-- Active: 1683523504910@@127.0.0.1@3306@peminjaman_inventaris
INSERT INTO Level (ID_Level, Nama) VALUES
	('L1', 'Admin'),
	('L2', 'Dosen'),
	('L3', 'Mahasiswa');

INSERT INTO Status (ID_Status, Nama) VALUES
	('S1', 'Menunggu'),
	('S2', 'Ditolak'),
	('S3', 'Diterima'),
	('S4', 'Sedang Dipinjam'),
	('S5', 'Selesai'),
	('S6', 'Dibatalkan'),
	('S7', 'Menunggu Ganti')

INSERT INTO Kategori (ID_Kategori, Nama) VALUES
	('K1', 'Peralatan'),
	('K2', 'Elektronik'),
	('K3', 'ATK');

INSERT INTO Pengguna (ID_Pengguna, ID_Level, `Nomor_Identitas`, Password, Nama, Email, Nomor_HP, Foto, `Status`) VALUES
	('P1', 'L1', '1', 'Admin', 'Admin', '-', '-', '-', 'Aktif'),
	('P2', 'L2', '0702108601', 'Dosen', 'Elok Nur Hamdana', 'ElokNurHamdana@polinema.ac.id', '82184', 'ProfileP2.png', 'Aktif'),
	('P3', 'L3', '2241720220', 'Mahasiswa', 'Putra Zakaria Muzaki', 'PutraZakaria@polinema.ac.id', '82183', 'ProfileP3.png', 'Aktif');

INSERT INTO OTP (ID_OTP, ID_Pengguna, Kode, Expired) VALUES
	('O1', 'P2', 'SAD12', '2023-10-30 12:00:00'),
	('O2', 'P3', 'DAQW23', '2023-10-31 0:00:00');

INSERT INTO Inventaris (ID_Inventaris, Nama, Stok, ID_Kategori, Asal, Deskripsi, Gambar ) VALUES
	('I1', 'Spidol', '10', 'K3', 'Hibah', '-', 'inventaris1.png'),
	('I2', 'Penghapus', '7', 'K3', 'Beli', '-', 'inventaris2.png'),
	('I3', 'Tang Crimping', '14', 'K1', 'Hibah', '-', 'inventaris3.png'),
	('I4', 'Obeng', '16', 'K1', 'Beli', '-', 'inventaris4.png'),
	('I5', 'Konektor Proyektor', '30', 'K2', 'Hibah', '-', 'inventaris5.png'),
	('I6', 'Keyboard', '17', 'K2', 'Beli', '-', 'inventaris6.png'),
	('I7', 'Mouse', '24', 'K2', 'Hibah', '-', 'inventaris7.png'),
	('I8', 'Monitor', '10', 'K2', 'Hibah', '-', 'inventaris8.png');

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
	('T1', 'P2', 'M1', 'S5', '2023-11-01 8:00:00', '2023-11-05 15:00:00', 'Perlu untuk acara seminar', '-', 'Silahkan diambil diruang admin lt.6'),
	('T2', 'P3', 'M1', 'S5', '2023-11-02 9:00:00', '2023-11-08 15:00:00', 'Untuk keperluan riset', 'JaminanT2.png', 'Silahkan diambil diruang teknisi lt.7'),
	('T3', 'P2', 'M2', 'S2', '2023-11-05 10:00:00', '2023-11-15 15:00:00', 'Acara workshop', '-', 'Silahkan diambil diruang teknisi lt.5'),
	('T4', 'P3', 'M1', 'S5', '2023-11-10 11:00:00', '2023-11-20 15:00:00', 'Untuk keperluan presentasi', 'JaminanT4.png', 'Silahkan diambil diruang admin lt.6'),
	('T5', 'P2', 'M3', 'S5', '2023-11-15 12:00:00', '2023-11-25 15:00:00', 'Acara pelatihan', '-', 'Silahkan diambil diruang teknisi lt.7'),
	('T6', 'P3', 'M3', 'S6', '2023-11-20 13:00:00', '2023-11-30 15:00:00', 'Untuk tugas kuliah', 'JaminanT6.png', 'Silahkan diambil diruang admin lt.6'),
	('T7', 'P3', 'M2', 'S4', '2023-11-30 15:00:00', '2023-12-10 15:00:00', 'Untuk presentasi akhir', 'JaminanT7.png', 'Silahkan diambil diruang teknisi lt.7'),
	('T8', 'P2', 'M1', 'S7', '2023-11-25 14:00:00', '2023-12-05 15:00:00', 'Acara seminar ', '-', 'Silahkan diambil diruang teknisi lt.5'),
	('T9', 'P2', 'M3', 'S4', '2023-12-01 16:00:00', '2023-12-12 15:00:00', 'Acara workshop akhir tahun', '-', 'Silahkan diambil diruang admin lt. 6'),
	('T10', 'P3', 'M2', 'S3', '2023-12-05 17:00:00', '2023-12-15 15:00:00', 'Untuk kegiatan UKM', 'JaminanT8.png', 'Silahkan diambil diruang teknisi lt.7'),
	('T11', 'P3', 'M1', 'S1', '2023-12-06 17:00:00', '2023-12-15 15:00:00', 'Untuk mengerjakan tugas akhir', 'JaminanT9.png', 'Silahkan diambil diruang teknisi lt.5');

INSERT INTO DetailTransaksi (ID_DetailTrc, ID_Transaksi, ID_Inventaris, Jumlah, Kondisi) VALUES
	('DT1', 'T1', 'I1', '2', 'Normal'),
	('DT2', 'T1', 'I3', '3', 'Normal'),
	('DT3', 'T1', 'I2', '1', 'Normal'),
	('DT4', 'T2', 'I7', '5', 'Normal'),
	('DT5', 'T2', 'I8', '2', 'Normal'),
	('DT6', 'T2', 'I4', '2', 'Normal'),
	('DT7', 'T3', 'I6', '3', 'Normal'),
	('DT8', 'T3', 'I2', '4', 'Normal'),
	('DT9', 'T3', 'I5', '1', 'Normal'),
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
	('DT24', 'T8', 'I3', '3', 'Normal'),
	('DT25', 'T9', 'I2', '4', 'Normal'),
	('DT26', 'T9', 'I4', '1', 'Normal'),
	('DT27', 'T9', 'I5', '1', 'Normal'),
	('DT28', 'T10', 'I4', '2', 'Normal'),
	('DT29', 'T10', 'I6', '3', 'Normal'),
	('DT30', 'T10', 'I7', '3', 'Normal'),
	('DT31', 'T11', 'I4', '1', 'Normal'),
	('DT32', 'T11', 'I3', '1', 'Normal');