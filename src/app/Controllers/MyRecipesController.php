<?php

namespace App\Controllers;

class MyRecipesController extends BaseController
{
    public function index()
    {
        return view("dashboard/my_recipes");
    }
}
