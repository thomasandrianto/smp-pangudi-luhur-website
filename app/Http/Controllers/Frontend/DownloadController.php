<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Download;
use Inertia\Inertia;

use App\Http\Resources\DownloadResource;

class DownloadController extends Controller
{
    public function index()
    {
        $downloads = DownloadResource::collection(
            Download::latest()
                ->paginate(10)
        );

        return Inertia::render('Download/Index', [
            'downloads' => $downloads,
        ]);
    }
}