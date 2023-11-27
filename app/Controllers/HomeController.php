<?php

class HomeController
{
    public function index()
    {
        return View::renderView('home');
    }
    public function about()
    {
        return View::renderView('about');
    }
}
