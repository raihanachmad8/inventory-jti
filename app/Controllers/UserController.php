<?php

class UserController
{
  public function dashboard()
  {
    return View::renderView('/user/dashboard/dashboard');
  }

  public function peminjaman()
  {
    return View::renderView('/user/peminjaman/peminjaman');
  }

  public function riwayat()
  {
    return View::renderView('/user/riwayat/riwayat');
  }
}
