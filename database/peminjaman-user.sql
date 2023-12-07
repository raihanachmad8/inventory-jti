--List Barang
SELECT
    i.`Gambar`, i.`Nama` 'Nama Barang', k.`Nama` 'Kategori', `Stok`, m.`Nama` 'Maintainer'
FROM inventaris i
JOIN kategori k on k.`ID_Kategori` = i.`ID_Kategori`
JOIN maintainerinventaris mk on mk.`ID_Inventaris` = i.`ID_Inventaris`
JOIN maintainer m on mk.`ID_Maintainer` = m.`ID_Maintainer`
WHERE i.`Stok` != 0;

--Konfirmasi Peminjaman