<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * 🔁 Toon het algemene registratieformulier (1 formulier met type dropdown)
     */
    public function showRegistrationForm()
    {
        return view('auth.register'); // registreer met keuze student/bedrijf
    }

    /**
     * 🧠 Verwerk het algemene registratieformulier
     */
    public function register(Request $request)
    {
        // ✅ Validatie
        $request->validate([
            'type' => 'required|in:student,bedrijf',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            // extra velden per type
            'voornaam'     => 'required_if:type,student|string|max:255',
            'achternaam'   => 'required_if:type,student|string|max:255',
            'company_name' => 'required_if:type,bedrijf|string|max:255',
        ]);

        // ✅ Gebruiker aanmaken afhankelijk van type
        if ($request->type === 'student') {
            $user = User::create([
                'voornaam' => $request->voornaam,
                'achternaam' => $request->achternaam,
                'name' => $request->voornaam . ' ' . $request->achternaam,
                'email' => $request->email,
                'type' => 'student',
                'password' => Hash::make($request->password),
            ]);
        } else {
            $user = User::create([
                'name' => $request->company_name,
                'email' => $request->email,
                'type' => 'bedrijf',
                'password' => Hash::make($request->password),
            ]);
        }

        // ✅ Leeg profiel aanmaken
        $user->profile()->create([]);

        // ✅ Login + redirect
        Auth::login($user);
        return $user->type === 'student'
            ? redirect()->route('student.dashboard')
            : redirect()->route('bedrijf.dashboard');
    }

    /**
     * 👩‍🎓 Optioneel: apart student registratieformulier
     */
    public function showStudentRegisterForm()
    {
        return view('auth.register_student');
    }

    /**
     * 👨‍💼 Optioneel: apart bedrijf registratieformulier
     */
    public function showBedrijfRegisterForm()
    {
        return view('auth.register_bedrijf');
    }

    /**
     * 👩‍🎓 Student registratie apart
     */
    public function studentRegister(Request $request)
    {
        $request->validate([
            'voornaam' => 'required|string|max:255',
            'achternaam' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        $student = User::create([
            'voornaam' => $request->voornaam,
            'achternaam' => $request->achternaam,
            'name' => $request->voornaam . ' ' . $request->achternaam,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => 'student',
        ]);

        $student->profile()->create([]);
        Auth::login($student);
        return redirect('/student/dashboard');
    }

    /**
     * 🏢 Bedrijf registratie apart
     */
    public function bedrijfRegister(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        $bedrijf = User::create([
            'name' => $request->company_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => 'bedrijf',
        ]);

        $bedrijf->profile()->create([]);
        Auth::login($bedrijf);
        return redirect()->route('bedrijf.dashboard');
    }
}
