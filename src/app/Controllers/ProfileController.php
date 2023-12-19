<?php

namespace App\Controllers;

class ProfileController
{
    public function index()
    {
        return view("secure/user/profile");
    }
}
