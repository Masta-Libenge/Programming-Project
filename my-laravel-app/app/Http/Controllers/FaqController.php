<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FaqQuestion;

class FaqController extends Controller
{
    /**
     * Toon gepubliceerde FAQ's + vraagformulier
     */
    public function index()
    {
        $faqs = FaqQuestion::where('gepubliceerd', true)
                           ->whereNotNull('answer')
                           ->latest()
                           ->get();

        return view('faq', compact('faqs'));
    }

    /**
     * Sla een nieuwe vraag op van de student
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'question' => 'required|string|min:10',
        ]);

        FaqQuestion::create([
            'user_id' => auth()->id(),
            'subject' => $request->input('subject'),
            'question' => $request->input('question'),
        ]);

        return redirect()->route('faq')->with('success', 'Je vraag is verzonden naar de admin.');    }
}
