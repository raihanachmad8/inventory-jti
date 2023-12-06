<?php

class HomeController
{
    public function index()
    {
        return View::renderPage('home');
    }
    public function about()
    {
        return View::renderPage('about');
    }
}
