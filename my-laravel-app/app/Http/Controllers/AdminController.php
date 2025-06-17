<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vacature;
use App\Models\FaqQuestion;

class AdminController extends Controller
{
    // Admin dashboard
    public function index()
    {
        $students = User::where('type', 'student')->get();
        $bedrijven = User::where('type', 'bedrijf')->get();
        $vacatures = Vacature::all();
        $faqs = FaqQuestion::latest()->get();

        return view('admin.dashboard', compact('students', 'bedrijven', 'vacatures', 'faqs'));
    }

    // Gebruiker verwijderen
    public function destroyUser($id)
    {
        if (auth()->id() == $id) {
            return redirect()->route('admin.dashboard')->with('error', 'Je kunt jezelf niet verwijderen.');
        }

        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Gebruiker succesvol verwijderd.');
    }

    // Vacature verwijderen
    public function destroyVacature($id)
    {
        $vacature = Vacature::findOrFail($id);
        $vacature->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Vacature succesvol verwijderd.');
    }

    // FAQ beantwoorden
    public function answerFaq(Request $request, $id)
    {
        $faq = FaqQuestion::findOrFail($id);
        $faq->answer = $request->input('answer');
        $faq->save();

        return redirect()->route('admin.dashboard')->with('success', 'Antwoord opgeslagen.');
    }

    // FAQ publiceren/verbergen
    public function toggleFaq($id)
    {
        $faq = FaqQuestion::findOrFail($id);
        $faq->gepubliceerd = !$faq->gepubliceerd;
        $faq->save();

        return redirect()->route('admin.dashboard')->with('success', 'FAQ-status gewijzigd.');
    }
}
