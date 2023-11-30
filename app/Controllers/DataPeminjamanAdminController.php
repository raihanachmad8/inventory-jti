<?php

class DataPeminjamanAdminController
{
  public function index()
  {
    return View::renderView('/admin/data-peminjaman/dataPeminjaman');
  }
}
