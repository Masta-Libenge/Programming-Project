namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // 🧾 Show the editable profile form
    public function edit()
    {
        $student = Auth::user(); // Assuming the student is the logged-in user
        return view('student.profile', compact('student'));
    }

    // 💾 Handle form submission
    public function update(Request $request)
    {
        $student = Auth::user();

        // ✅ Basic validation
        $request->validate([
            'description' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:20',
            'avatar' => 'nullable|image|max:2048',
        ]);

        // ✏️ Save description and color
        $student->description = $request->input('description');
        $student->card_color = $request->input('color');

        // 🖼️ Save uploaded profile picture (if any)
        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $student->avatar_path = $path;
        }

        $student->save();

        return redirect()->route('student.profile')->with('success', 'Profiel succesvol bijgewerkt!');
    }
}
