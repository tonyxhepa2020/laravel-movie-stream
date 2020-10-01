<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WatchUrl;
use Illuminate\Http\Request;

class ApiAdminWatchController extends Controller
{
    public function destroy($id)
    {
        $look = WatchUrl::findOrFail($id);
        $look->delete();

        return response('Watch url Deleted ');
    }
}
