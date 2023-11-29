<?php

class DashboardAdminController
{
  public function index()
  {
    return View::renderView('/admin/dashboard/dashboard');
  }
}
