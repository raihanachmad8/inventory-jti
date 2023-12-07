--Profil
SELECT
    `Foto`, `Nama`, `Nomor_Identitas`,
    `Email`, `Nomor_HP`
FROM pengguna
WHERE `ID_Pengguna` = --id ndek session

--Keamanan
SELECT
    `Nomor_Identitas`, `Password`
FROM pengguna
WHERE `ID_Pengguna` = --id ndek session

--Pesan
SELECT
    t.`Pesan`
FROM pengguna p
JOIN transaksi t ON t.`ID_Pengguna` = p.`ID_Pengguna`
WHERE `ID_Pengguna` = --id ndek session

