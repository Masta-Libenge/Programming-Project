{{-- ✅ No @extends or @section --}}

<div class="profile-container">
    <div class="profile-header">
        {{-- Optional: link to your edit page --}}
        <a href="{{ route('student.profile') }}">
            <button class="edit-btn">Bewerken</button>
        </a>

        {{-- ✅ Use actual user profile photo if it exists --}}
        @if ($user->profile && $user->profile->photo_path)
            <img src="{{ Storage::url($user->profile->photo_path) }}" alt="Profielfoto" class="profile-pic">
        @else
            <img src="/images/avatar.png" alt="Profielfoto" class="profile-pic">
        @endif

        <h2>{{ ucfirst($user->type) }}</h2>
    </div>

    <div class="section">
        <h3>Persoonlijke Informatie</h3>
        <div class="info-grid">
            <div class="info-box">{{ $user->name }}</div>
            {{-- If you have first & last name, split here, else repeat name --}}
            {{-- <div class="info-box">{{ $user->first_name }}</div> --}}
            {{-- <div class="info-box">{{ $user->last_name }}</div> --}}
            <div class="info-box email">{{ $user->email }}</div>
        </div>
    </div>

    <div class="section">
        <h3>Beschrijving</h3>
        <div class="info-grid">
            <div class="info-box">
                {{ $user->profile->description ?? 'Geen beschrijving' }}
            </div>
        </div>
    </div>

    <div class="section">
        <h3>Kleur</h3>
        <div class="info-grid">
            <div class="info-box">
                {{ $user->profile->card_color ?? 'Geen kleur gekozen' }}
            </div>
        </div>
    </div>
</div>

<style>
body {
    background: #dceeff;
    font-family: 'Segoe UI', sans-serif;
    margin: 0;
    padding: 0;
}

.profile-container {
    max-width: 400px;
    margin: 30px auto;
    padding: 20px;
    text-align: center;
}

.profile-header {
    display: flex;
    flex-direction: column;
    align-items: center;
    position: relative;
}

        .username {
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .section-title {
            font-weight: bold;
            margin-top: 25px;
            margin-bottom: 10px;
            font-size: 1rem;
            color: var(--text-dark);
        }

        .info-block {
            background: #e2ecf9;
            padding: 10px 16px;
            border-radius: 14px;
            margin-bottom: 10px;
            box-shadow: inset 1px 1px 3px #cbdbe8,
                        inset -1px -1px 3px #ffffff;
            color: var(--text-dark);
        }

.info-grid, .skills-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    justify-content: center;
}

.info-box {
    background: #e6f0fa;
    padding: 10px 18px;
    border-radius: 14px;
    box-shadow: inset 2px 2px 4px #cddfea, inset -2px -2px 4px #ffffff;
    font-weight: 500;
    color: #444;
    min-width: 120px;
    text-align: center;
}

.email {
    width: 100%;
}
</style>
