<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Environment;
use Illuminate\Http\Request;

class EnvironmentController extends Controller
{
    public function index(): \Illuminate\Database\Eloquent\Collection
    {
        return Environment::all();
    }

    public function show(Environment $environment): Environment
    {
        return $environment;
    }
}
