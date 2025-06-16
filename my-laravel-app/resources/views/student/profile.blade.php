@extends('layouts.app')

@section('content')
<div class="profile-container">
    <div class="profile-header">
        <button class="edit-btn">bewerken</button>
        <img src="/images/avatar.png" alt="Profielfoto" class="profile-pic">
        <h2>student</h2>
    </div>

    <div class="section">
        <h3>Persoonlijke Informatie</h3>
        <div class="info-grid">
            <div class="info-box">Omar</div>
            <div class="info-box">Ouanane</div>
            <div class="info-box email">Email123@gmail.com</div>
        </div>
    </div>

    <div class="section">
        <h3>Hogeschool</h3>
        <div class="info-grid">
            <div class="info-box">Toegepaste Informatica</div>
            <div class="info-box">Jaar 1</div>
        </div>
    </div>

    <div class="section">
        <h3>Vaardigheden</h3>
        <div class="skills-grid">
            <div class="skill">HTML</div>
            <div class="skill">Javascript</div>
            <div class="skill">CSS</div>
            <div class="skill">ctrl c/ctrl v</div>
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

.edit-btn {
    position: absolute;
    top: 0;
    left: 0;
    background: #e0f0fa;
    border: none;
    border-radius: 12px;
    padding: 6px 12px;
    font-weight: bold;
    color: #007acc;
    box-shadow: 3px 3px 6px #c0d8ea, -3px -3px 6px #ffffff;
    cursor: pointer;
}

.profile-pic {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    margin-top: 40px;
    margin-bottom: 10px;
    box-shadow: 3px 3px 8px #c0d8ea, -3px -3px 8px #ffffff;
}
    position: relative;
}

.edit-btn {
    position: absolute;
    top: 0;
    left: 0;
    background: #e0f0fa;
    border: none;
    border-radius: 12px;
    padding: 6px 12px;
    font-weight: bold;
    color: #007acc;
    box-shadow: 3px 3px 6px #c0d8ea, -3px -3px 6px #ffffff;
    cursor: pointer;
}

.profile-pic {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    margin-top: 40px;
    margin-bottom: 10px;
    box-shadow: 3px 3px 8px #c0d8ea, -3px -3px 8px #ffffff;
}

.section h3 {
    margin-bottom: 10px;
    color: #222;
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

.skill {
    background: #3490dc;
    color: white;
    padding: 10px 16px;
    border-radius: 20px;
    box-shadow: 2px 2px 6px #c0d8ea, -2px -2px 6px #ffffff;
    font-weight: bold;
}
</style>
@endsection