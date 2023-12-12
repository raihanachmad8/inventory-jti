<?php

class AdminController
{
  public function dashboard()
  {
    return View::renderView('admin/dashboard/dashboard');
  }

  public function dataPeminjaman()
  {
    return View::renderView('admin/data-peminjaman/dataPeminjaman');
  }

  public function inventarisir()
  {
    return View::renderView('admin/inventarisir/inventarisir');
  }

  public function riwayat()
  {
    return View::renderView('admin/riwayat-peminjaman/riwayat-peminjaman');
  }
  public function maintainer()
  {
    return View::renderView('admin/maintainer/maintainer');
  }
  public function maintainerdetails()
  {
    return View::renderView('admin/maintainer/details');
  }
}
