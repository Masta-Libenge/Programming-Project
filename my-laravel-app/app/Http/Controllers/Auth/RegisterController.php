<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /**
     * 👩‍🎓 Show the student registration form.
     */
    public function showStudentRegisterForm()
    {
        return view('auth.register_student');
    }

    /**
     * ✅ Handle student registration logic
     * 
     * NOTE:
     * - We now store 'voornaam' and 'achternaam' separately.
     * - We also create a combined 'name' field to satisfy the database
     *   and keep compatibility with parts of Laravel that expect 'name'.
     */
    public function studentRegister(Request $request)
    {
        // ✅ Validate input
        $request->validate([
            'voornaam' => 'required|string|max:255',
            'achternaam' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        // ✅ Create the student
        $student = User::create([
            'voornaam' => $request->voornaam,                    // store first name
            'achternaam' => $request->achternaam,                // store last name
            'name' => $request->voornaam . ' ' . $request->achternaam, // fallback full name
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => 'student',                                 // explicitly mark as student
        ]);

        // ✅ Create an empty profile linked to this user
        $student->profile()->create([]);

        // ✅ Log the student in immediately
        Auth::login($student);

        // ✅ Redirect to student dashboard
        return redirect('/student/dashboard');
    }

    /**
     * 🏢 Show the company (bedrijf) registration form.
     */
    public function showBedrijfRegisterForm()
    {
        return view('auth.register_bedrijf');
    }

    /**
     * ✅ Handle company registration logic.
     * 
     * NOTE:
     * - Companies just have 'name', no voornaam/achternaam needed.
     */
    public function bedrijfRegister(Request $request)
    {
        // ✅ Validate input
        $request->validate([
            'company_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        // ✅ Create the company user
        $bedrijf = User::create([
            'name' => $request->company_name,                    // company name goes in 'name'
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => 'bedrijf',                                 // explicitly mark as company
        ]);

        // ✅ Create empty profile for the company too
        $bedrijf->profile()->create([]);

        // ✅ Log the company in immediately
        Auth::login($bedrijf);

        // ✅ Redirect to company dashboard
        return redirect()->route('bedrijf.dashboard');
    }
}
