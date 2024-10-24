<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Form;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function index(): \Illuminate\Database\Eloquent\Collection
    {
        return Form::all();
    }

    public function show(Form $form): Form
    {
        return $form;
    }
}
