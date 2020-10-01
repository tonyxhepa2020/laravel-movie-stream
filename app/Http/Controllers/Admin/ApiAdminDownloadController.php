<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DownloadUrl;
use Illuminate\Http\Request;

class ApiAdminDownloadController extends Controller
{
    public function destroy($id)
    {
        $download = DownloadUrl::findOrFail($id);
        $download->delete();

        return response('Download Deleted ');
    }
}
