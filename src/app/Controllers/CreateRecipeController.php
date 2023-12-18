<?php

namespace App\Controllers;

class CreateRecipeController extends BaseController
{
    public function index()
    {
        return view("dashboard/create_recipe");
    }
}
