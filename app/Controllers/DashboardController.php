<?php


class DashboardController
{
  public function index()
  {
    return View::renderView('/user/dashboard/dashboard');
  }
}
