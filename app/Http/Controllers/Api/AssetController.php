<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    public function index(): \Illuminate\Database\Eloquent\Collection
    {
        return Asset::all();
    }

    public function show(Asset $asset): Asset
    {
        return $asset;
    }
}
