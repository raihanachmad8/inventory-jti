<?php

class InventoryController
{
    public function dashboard()
    {
        // $inventory = Inventory::all();
        // $response = new InventoryResponse($inventory);
        // $response->render();
        View::renderView('inventory/dashboard/dashboard');
    }

    public function peminjaman()
    {
        View::renderView('inventory/peminjaman/peminjaman');
    }

    public function riwayat()
    {
        View::renderView('inventory/riwayat/riwayat');
    }

    public function profil()
    {
        View::renderView('profile/profile');
    }
    public function keamanan()
    {
        View::renderView('profile/keamanan');
    }
    public function pesan()
    {
        View::renderView('profile/pesan');
    }
    public function hapusAkun()
    {
        View::renderView('profile/hapus-akun');
    }
}
