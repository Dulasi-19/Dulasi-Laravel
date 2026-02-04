<?php

use Illuminate\Support\Facades\Route;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('portfolio');
});

Route::post('/', function (Request $request) {
    // Validate request
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'message' => 'required|string',
    ]);

    // Save to database
    ContactMessage::create($data);

    if ($request->ajax() || $request->wantsJson()) {
        return response()->json(['success' => 'Thanks to approach me, I will respond shortly!']);
    }
    return redirect()->back()->with('success', 'Thanks to approach me, I will respond shortly!');
});
