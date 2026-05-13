<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Album;
use Inertia\Inertia;

use App\Http\Resources\AlbumResource;
use App\Http\Resources\GalleryResource;

class GalleryController extends Controller
{
    // =========================
    // LIST ALBUM
    // =========================
    public function index()
    {
        $albums = Album::withCount('galleries')
            ->with([
                'galleries' => function ($query) {
                    $query->latest()->take(5);
                }
            ])
            ->latest()
            ->get();

        return Inertia::render('Galleries/Index', [
            // WAJIB resolve()
            'albums' => AlbumResource::collection($albums)->resolve(),
        ]);
    }

    // =========================
    // DETAIL ALBUM
    // =========================
    public function show($id)
    {
        $album = Album::with('galleries')->findOrFail($id);

        return Inertia::render('Galleries/Show', [
            'album' => [
                'id' => $album->id,

                'name' => $album->name,

                'cover' => $album->cover
                    ? asset('storage/' . $album->cover)
                    : null,

                // WAJIB resolve()
                'photos' => GalleryResource::collection(
                    $album->galleries
                )->resolve(),
            ]
        ]);
    }
}