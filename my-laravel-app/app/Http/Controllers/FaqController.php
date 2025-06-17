<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FaqQuestion;

class FaqController extends Controller
{
    public function index()
    {
        return view('faq');
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'question' => 'required|string|min:10',
        ]);

        FaqQuestion::create([
            'user_id' => auth()->id(),
            'subject' => $request->subject,
            'question' => $request->question,
        ]);

        return back()->with('success', 'Je vraag is verzonden naar de admin.');
    }
}
