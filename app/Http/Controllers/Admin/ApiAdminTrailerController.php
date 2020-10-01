<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TrailerUrl;
use Illuminate\Http\Request;

class ApiAdminTrailerController extends Controller
{
    public function destroy($id)
    {
        $trailer = TrailerUrl::findOrFail($id);
        $trailer->delete();

        return response('Watch url Deleted ');
    }
}
