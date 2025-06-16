{{-- ✅ No @extends for now — pure standalone --}}

<h1>Profiel Bewerken</h1>

{{-- ✅ Show success message if available --}}
@if (session('success'))
    <div style="color: green; margin-bottom: 1rem;">
        {{ session('success') }}
    </div>
@endif

{{-- ✅ Form to update description & card color --}}
<form action="{{ route('student.profile.update') }}" method="POST">
    @csrf

    <label for="description">Beschrijving:</label><br>
    <textarea name="description" rows="4" cols="50">{{ old('description', $user->profile->description ?? '') }}</textarea><br><br>

    <label for="card_color">Kaart Kleur:</label><br>
    <select name="card_color">
        <option value="">-- Kies een kleur --</option>
        <option value="red" {{ (old('card_color', $user->profile->card_color ?? '') == 'red') ? 'selected' : '' }}>Rood</option>
        <option value="blue" {{ (old('card_color', $user->profile->card_color ?? '') == 'blue') ? 'selected' : '' }}>Blauw</option>
        <option value="green" {{ (old('card_color', $user->profile->card_color ?? '') == 'green') ? 'selected' : '' }}>Groen</option>
    </select><br><br>

    <button type="submit">Sla gegevens op</button>
</form>

<hr>

{{-- ✅ Form to upload a profile picture --}}
<h3>Profielfoto uploaden</h3>
@if ($user->profile && $user->profile->photo_path)
    <p>Huidige foto:</p>
    <img src="{{ Storage::url($user->profile->photo_path) }}" alt="Profielfoto" style="max-width: 150px;">
@endif

<form action="{{ route('student.profile.upload-picture') }}" method="POST" enctype="multipart/form-data" style="margin-top: 1rem;">
    @csrf

    <input type="file" name="profile_picture" accept="image/*" required>
    <button type="submit">Upload Foto</button>
</form>
