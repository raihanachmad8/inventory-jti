--panggil data barang
--panggil data transaksi

SELECT * FROM otp


SELECT * FROM pengguna


SELECT
    I.ID_Inventaris,
    I.Nama,
    I.`Gambar`,
    I.Stok - COALESCE(SUM(DT.Jumlah), 0) AS StokTersedia
FROM
    Inventaris I
LEFT JOIN
    DetailTransaksi DT ON I.ID_Inventaris = DT.ID_Inventaris
GROUP BY
    I.ID_Inventaris, I.Nama, I.Stok
HAVING
    StokTersedia > 0
ORDER BY
    I.Stok DESC
LIMIT 3;

