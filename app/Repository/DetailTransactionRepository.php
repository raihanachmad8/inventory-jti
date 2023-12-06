<?php

require_once __DIR__ . '/../Models/DetailTransaksi.php';
require_once __DIR__ . '/../Models/Inventaris.php';
require_once __DIR__ . '/../Models/Transaksi.php';

require_once __DIR__ . '/InventarisRepository.php';
require_once __DIR__ . '/TransaksiRepository.php';



class DetailTransaksiRepository
{
    private PDO $connection;
    private InventarisRepository $InventarisRepository;
    private TransaksiRepository $TransaksiRepository;
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
        $this->InventarisRepository = new InventarisRepository($connection);
        $this->TransaksiRepository = new TransaksiRepository($connection);
    }

}
