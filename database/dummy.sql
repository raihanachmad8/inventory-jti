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
	('S6', 'Dibatalkan');

INSERT INTO Kategori (ID_Kategori, Nama) VALUES
	('K1', 'Peralatan'),
	('K2', 'Elektronik'),
	('K3', 'ATK');

INSERT INTO Pengguna (ID_Pengguna, ID_Level, Username, Password, Nama, Email, Nomor_HP, Status) VALUES
	('P1', 'L2', '404079101', 'adei', 'Ade Ismail', 'AdeIsmail@polinema.ac.id', '82182', 'AKTIF'),
	('P2', 'L3', '2241720220', 'putraz', 'Putra Zakaria', 'PutraZakaria@polinema.ac.id', '82183', 'TIDAK AKTIF'),
	('P3', 'L2', '702108601', 'eloks', 'Elok Nur Hamdana', 'ElokNurHamdana@polinema.ac.id', '82184', 'AKTIF'),
	('P4', 'L3', '2241720005', 'vunkg', 'Vunky Himawan', 'VunkyHimawan@polinema.ac.id', '82185', 'AKTIF'),
	('P5', 'L1', '502108400', 'awoon', 'Anggi Putra Woon', 'AnggiPutraWoon@polinema.ac.id', '82186', 'AKTIF'),
	('P6', 'L1', '502108401', 'sjadi', 'Sujadi', 'Sujadi@polinema.ac.id', '82187', 'AKTIF'),
	('P7', 'L3', '2241720192', 'achrhan', 'Achmad Raihan', 'AchmadRaihan@polinema.ac.id', '82188', 'AKTIF'),
	('P8', 'L1', '502108402', 'atmnugh', 'Dwi Atmo Nugroho', 'DwiAtmoNugroho@polinema.ac.id', '82189', 'AKTIF');

INSERT INTO OTP (ID_OTP, ID_Pengguna, Kode, Expired) VALUES
	('O1', 'P1', 'SAD12', '2023-10-30 12:00:00'),
	('O2', 'P2', 'DAQW23', '2023-10-31 0:00:00'),
	('O3', 'P3', 'DFE421', '2023-11-03 15:00:00'),
	('O4', 'P4', 'DETE43', '2023-11-10 10:00:00'),
	('O5', 'P7', 'JJD083', '2023-11-10 11:00:00');

INSERT INTO Inventaris (ID_Inventaris, Nama, Stok, ID_Kategori, Asal, Deskripsi ) VALUES
	('I1', 'Spidol', '10', 'K3', 'Hibah', '-'),
	('I2', 'Penghapus', '7', 'K3', 'Beli', '-'),
	('I3', 'Tang Crimping', '14', 'K1', 'Hibah'),
	('I4', 'Obeng', '16', 'K1', 'Beli', '-'),
	('I5', 'Konektor Proyektor', '30', 'K2', 'Hibah', '-'),
	('I6', 'Keyboard', '17', 'K2', 'Beli', '-'),
	('I7', 'Mouse', '24', 'K2', 'Hibah', '-');

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
	('I7', 'M3');

INSERT INTO Transaksi (ID_Transaksi, ID_Pengguna, ID_Admin, ID_Status, StartDate, EndDate, Deskripsi_Keperluan, Pesan) VALUES
	('T1', 'P1', 'P6', 'S5', '2023-11-11 10:00:00', '2023-11-14 10:00:00', 'Keperluan Mengajar', 'Silahkan Ambil Barang di ruang teknisi Lantai 7'),
	('T2', 'P4', 'P8', 'S6', '2023-11-13 10:00:00', '2023-11-15 10:00:00', 'Keperluan Belajar Mandiri', 'Peminjaman Dibatalkan oleh peminjam');

INSERT INTO DetailTransaksi (ID_DetailTrc, ID_Transaksi, ID_Inventaris, Jumlah) VALUES
	('DT1', 'T1', 'I3', '10'),
	('DT2', 'T1', 'I4', '10'),
	('DT3', 'T1', 'I5', '1');
