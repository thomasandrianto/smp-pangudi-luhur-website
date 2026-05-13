<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ContactController extends Controller
{
    /**
     * Display contact page.
     */
    public function index(): Response
    {
        return Inertia::render('Contact/Index');
    }

    /**
     * Store incoming contact message.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
            ],
            'email' => [
                'required',
                'email:rfc,dns',
                'max:100',
            ],
            'phone' => [
                'nullable',
                'string',
                'max:30',
            ],
            'message' => [
                'required',
                'string',
                'max:2000',
            ],
        ]);

        Message::create([
            'name' => trim($validated['name']),
            'email' => strtolower(trim($validated['email'])),
            'phone' => isset($validated['phone'])
                ? trim($validated['phone'])
                : null,
            'message' => trim($validated['message']),
            'is_read' => false,
        ]);

        return back()->with(
            'success',
            'Pesan berhasil dikirim. Terima kasih telah menghubungi kami.'
        );
    }
}