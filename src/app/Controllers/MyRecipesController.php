<?php

namespace App\Controllers;

class MyRecipesController
{
    public function index()
    {
        return view("secure/user/my_recipes");
    }
}
