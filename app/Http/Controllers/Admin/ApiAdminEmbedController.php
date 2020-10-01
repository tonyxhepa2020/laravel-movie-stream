<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmbedUrl;
use Illuminate\Http\Request;

class ApiAdminEmbedController extends Controller
{
    public function destroy($id)
    {
        $embed = EmbedUrl::findOrFail($id);
        $embed->delete();

        return response('Embed Deleted ');
    }
}
