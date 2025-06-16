<h1>Test Profiel Pagina</h1>

<p><strong>Naam:</strong> {{ $user->name }}</p>
<p><strong>Beschrijving:</strong> {{ $user->profile->description ?? 'Geen beschrijving' }}</p>
<p><strong>Kleur:</strong> {{ $user->profile->card_color ?? 'Geen kleur' }}</p>

@if ($user->profile && $user->profile->photo_path)
    <p><strong>Profielfoto:</strong></p>
    <img src="{{ Storage::url($user->profile->photo_path) }}" alt="Profielfoto" style="max-width: 200px;">
@else
    <p><strong>Profielfoto:</strong> Geen foto geüpload</p>
@endif
