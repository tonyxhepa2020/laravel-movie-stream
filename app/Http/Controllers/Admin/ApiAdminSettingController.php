<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ApiAdminSettingController extends Controller
{
    public function backup()
    {
        Artisan::call('backup:run');

        return response()->json(Artisan::output());
    }
    public function inspire()
    {
        Artisan::call('inspire');

        return response()->json(Artisan::output());
    }

    public function optimize()
    {
       Artisan::call('optimize:clear');
        return response()->json(Artisan::output());
    }
    public function sitemap()
    {
        Artisan::call('sitemap:generate');
        return response()->json(Artisan::output());
    }
}
