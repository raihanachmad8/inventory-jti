--Tabel
SELECT
    t.`ID_Transaksi`, t.`StartDate`, t.`EndDate`, s.`Nama`
FROM transaksi t
JOIN status s on s.`ID_Status` = t.`ID_Status`;

--Detail Peminjaman
SELECT
    l.`Nama` 'Jenis Peminjam', p.`Nama`, p.`Nomor_Identitas`, s.`Nama` 'Status Peminjaman', t.`StartDate` 'Tanggal Peminjaman', t.`EndDate` 'Waktu Pengembalian', t.`Deskripsi_Keperluan` 'Alasan Peminjaman', t.`Pesan`, t.`Jaminan`,
    dt.`ID_Inventaris`, i.`Nama` 'Nama Barang', dt.`Jumlah`, k.`Nama` 'Kategori'
FROM transaksi t
JOIN detailtransaksi dt on t.`ID_Transaksi` = dt.`ID_Transaksi`
JOIN inventaris i on i.`ID_Inventaris` = dt.`ID_Inventaris`
JOIN status s on s.`ID_Status` = t.`ID_Status`
JOIN pengguna p on p.`ID_Pengguna` = t.`ID_Pengguna`
JOIN level l on l.`ID_Level` = p.`ID_Level`
JOIN kategori k ON i.`ID_Kategori` = k.`ID_Kategori`