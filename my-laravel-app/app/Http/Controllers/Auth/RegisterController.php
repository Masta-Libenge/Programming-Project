<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'type' => 'required|in:student,bedrijf',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'voornaam'     => 'required_if:type,student|string|max:255',
            'achternaam'   => 'required_if:type,student|string|max:255',
            'opleiding'    => 'required_if:type,student|string|max:255',
            'jaar'         => 'required_if:type,student|string|max:255',
            'company_name' => 'required_if:type,bedrijf|string|max:255',
        ]);

        if ($request->type === 'student') {
            $user = User::create([
                'voornaam'   => $request->voornaam,
                'achternaam' => $request->achternaam,
                'opleiding'  => $request->opleiding,
                'jaar'       => $request->jaar,
                'name'       => $request->voornaam . ' ' . $request->achternaam,
                'email'      => $request->email,
                'type'       => 'student',
                'password'   => Hash::make($request->password),
            ]);
        } else {
            $user = User::create([
                'name'     => $request->company_name,
                'email'    => $request->email,
                'type'     => 'bedrijf',
                'password' => Hash::make($request->password),
            ]);
        }

        $user->profile()->create([]);
        Auth::login($user);
        return $user->type === 'student'
            ? redirect()->route('student.dashboard')
            : redirect()->route('bedrijf.dashboard');
    }

    public function showStudentRegisterForm()
    {
        return view('auth.register_student');
    }

    public function showBedrijfRegisterForm()
    {
        return view('auth.register_bedrijf');
    }

    public function studentRegister(Request $request)
    {
        $request->validate([
            'voornaam'   => 'required|string|max:255',
            'achternaam' => 'required|string|max:255',
            'opleiding'  => 'required|string|max:255',
            'jaar'       => 'required|string|max:255',
            'email'      => 'required|email|unique:users',
            'password'   => 'required|confirmed|min:6',
        ]);

        $student = User::create([
            'voornaam'   => $request->voornaam,
            'achternaam' => $request->achternaam,
            'opleiding'  => $request->opleiding,
            'jaar'       => $request->jaar,
            'name'       => $request->voornaam . ' ' . $request->achternaam,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
            'type'       => 'student',
        ]);

        $student->profile()->create([]);
        Auth::login($student);
        return redirect('/student/dashboard');
    }

    public function bedrijfRegister(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'email'        => 'required|email|unique:users',
            'password'     => 'required|confirmed|min:6',
        ]);

        $bedrijf = User::create([
            'name'     => $request->company_name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'type'     => 'bedrijf',
        ]);

        $bedrijf->profile()->create([]);
        Auth::login($bedrijf);
        return redirect()->route('bedrijf.dashboard');
    }
}
