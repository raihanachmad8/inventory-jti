USE inventory_jti;

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
DELETE FROM Pengguna WHERE Email = "someone@gmail.com";

SELECT * FROM pengguna;
SELECT * FROM OTP;
DELETE FROM OTP;
;

DELETE FROM OTP;
INSERT INTO Pengguna (ID_Pengguna, ID_Level, Nomor_Identitas, Password, Nama, Email, Nomor_HP, Foto, Status, Salt) VALUES
	('P1', 'L2', '404079101', '$2y$10$yqNUmO1/7VmSSSFs08Whh.rt.mdDSy7/rwRy2YBsmuf8yMHr.K3Dq', 'Ade Ismail', 'AdeIsmail@polinema.ac.id', '82182', NULL, 'Aktif', 'dnaqdkn'), -- password: adei
	('P2', 'L3', '2241720220', '$2y$10$Ri8hZ/.0L4SGseYP4qRCAOVZ5b0jKj9DXCGnBwXAn.BswlApv0/AC', 'Putra Zakaria', 'PutraZakaria@polinema.ac.id', '82183', NULL, 'Tidak Aktif', 'hdgjdf'), -- password: putraz
	('P3', 'L2', '702108601', '$2y$10$usALhD/GLuasah1TdXdECuI6RBUhoklPlz2ys3GqDdwsW/YZTji1.', 'Elok Nur Hamdana', 'ElokNurHamdana@polinema.ac.id', '82184', NULL, 'Aktif', 'hkshgg'), -- password: eloks
	('P4', 'L3', '2241720005', '$2y$10$car8JKOrDZBSwA31IxLNOuE.66tb9dpox.pzk4ZVngpQ5zaztZ.dS', 'Vunky Himawan', 'VunkyHimawan@polinema.ac.id', '82185', NULL, 'Aktif', 'hfoemx'),  -- password: vunkg
	('P5', 'L1', '502108400', '$2y$10$VvaBwldO5Vtn8LD00jIPPONkHeNCsXSMX2O8Ef3iUvwqrWAkNkapa', 'Anggi Putra Woon', 'AnggiPutraWoon@polinema.ac.id', '82186', NULL, 'Aktif', 'hemoqm'),  -- password: awoon
	('P6', 'L1', '502108401', '$2y$10$W0dppQ9LCYHqjl6i7d3q2uf0nnOTNNY75rr3/xapkbeCUC8Enqz9i', 'Sujadi', 'Sujadi@polinema.ac.id', '82187', NULL, 'Aktif', 'jdsiwu'), -- password: sjadi
	('P7', 'L3', '2241720192', '$2y$10$vRIKgd73eN8ev2XR6cJnI.qQN.KPenUfdqGdDDj9jC/mcZIF.//dO', 'Achmad Raihan', 'AchmadRaihan@polinema.ac.id', '82188', NULL, 'Aktif', 'heimqo'),  -- password: achrhan
	('P8', 'L1', '502108402', '$2y$10$4WjQQtVDdjHGLWg/N1x3cOJnwuUN/Gv3KHYMJ7poR69/WaXbY08yy', 'Dwi Atmo Nugroho', 'DwiAtmoNugroho@polinema.ac.id', '82189', NULL, ' Tidak Aktif', 'dnaqdkn'); -- password: atmnugh

INSERT INTO OTP (ID_OTP, ID_Pengguna, Kode, Expired) VALUES
	('O1', 'P1', 'SAD12', '2023-10-30 12:00:00'),
	('O2', 'P2', 'DAQW23', '2023-10-31 0:00:00'),
	('O3', 'P3', 'DFE421', '2023-11-03 15:00:00'),
	('O4', 'P4', 'DETE43', '2023-11-10 10:00:00'),
	('O5', 'P7', 'JJD083', '2023-11-10 11:00:00');
SELECT * FROM Pengguna;
SELECT * FROM OTP;
INSERT INTO Inventaris (ID_Inventaris, Nama, Stok, ID_Kategori, Asal, Deskripsi, Gambar ) VALUES
	('I1', 'Spidol', '10', 'K3', 'Hibah', '-', 'inventaris1.png'),
	('I2', 'Penghapus', '7', 'K3', 'Beli', '-', 'inventaris2.png'),
	('I3', 'Tang Crimping', '29', 'K1', 'Hibah', '-', 'inventaris3.png'),
	('I4', 'Obeng', '15', 'K1', 'Beli', '-', 'inventaris4.png'),
	('I5', 'Konektor Proyektor', '14', 'K2', 'Hibah', '-', 'inventaris5.png'),
	('I6', 'Keyboard', '10', 'K2', 'Beli', '-', 'inventaris6.png'),
	('I7', 'Mouse', '12', 'K2', 'Hibah', '-', 'inventaris7.png');

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

INSERT INTO Transaksi (ID_Transaksi, ID_Pengguna, ID_Admin, ID_Status, StartDate, EndDate, Deskripsi_Keperluan, Jaminan, Pesan) VALUES
	('T1', 'P1', 'P6', 'S5', '2023-11-11 10:00:00', '2023-11-14 10:00:00', 'Keperluan Mengajar', '', 'Silahkan Ambil Barang di ruang teknisi Lantai 7'),
	('T2', 'P4', 'P8', 'S6', '2023-11-13 10:00:00', '2023-11-15 10:00:00', 'Keperluan Belajar Mandiri', 'jaminan1.png', 'Peminjaman Dibatalkan oleh peminjam');

INSERT INTO DetailTransaksi (ID_DetailTrc, ID_Transaksi, ID_Inventaris, Jumlah) VALUES
	('DT1', 'T1', 'I3', '10'),
	('DT2', 'T1', 'I4', '10'),
	('DT3', 'T1', 'I5', '1');
