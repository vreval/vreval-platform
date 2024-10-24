<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Marker;
use Illuminate\Http\Request;

class MarkerController extends Controller
{
    public function index(): \Illuminate\Database\Eloquent\Collection
    {
        return Marker::all();
    }

    public function show(Marker $marker): Marker
    {
        return $marker;
    }
}
