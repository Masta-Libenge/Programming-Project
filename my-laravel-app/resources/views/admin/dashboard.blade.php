<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard – CareerLaunch</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 2rem;
            background-color: #f8fafc;
            color: #0f172a;
        }

        h1 {
            font-size: 2rem;
            margin-bottom: 2rem;
        }

        section {
            margin-bottom: 3rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        th, td {
            padding: 1rem;
            border-bottom: 1px solid #e2e8f0;
            text-align: left;
        }

        th {
            background-color: #f1f5f9;
        }

        form {
            display: inline;
        }

        button {
            background: #ef4444;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            cursor: pointer;
        }

        button:hover {
            background: #dc2626;
        }

        .message {
            padding: 10px;
            margin-bottom: 1rem;
            border-radius: 5px;
        }

        .success {
            background-color: #d1fae5;
            color: #065f46;
        }

        .error {
            background-color: #fee2e2;
            color: #991b1b;
        }

        textarea {
            width: 100%;
            min-height: 60px;
            margin-bottom: 10px;
        }

        @media (max-width: 768px) {
            table, thead, tbody, th, td, tr {
                display: block;
            }

            tr {
                margin-bottom: 1rem;
                background: white;
                border-radius: 10px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            }

            td {
                padding: 0.5rem;
                border: none;
                border-bottom: 1px solid #e2e8f0;
            }

            th {
                display: none;
            }
        }
    </style>
</head>
<body>

<h1>Admin Dashboard</h1>

{{-- Flash messages --}}
@if(session('success'))
    <div class="message success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="message error">{{ session('error') }}</div>
@endif

{{-- Studenten --}}
<section>
    <h2>Studenten ({{ $students->count() }})</h2>
    <table>
        <thead>
            <tr>
                <th>Naam</th>
                <th>Email</th>
                <th>Type</th>
                <th>Actie</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->type }}</td>
                    <td>
                        @if(auth()->id() !== $user->id)
                            <form method="POST" action="{{ route('admin.user.destroy', $user->id) }}">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Weet je zeker dat je deze gebruiker wilt verwijderen?')">Verwijder</button>
                            </form>
                        @else
                            <span style="color: gray;">(jezelf)</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</section>

{{-- Bedrijven --}}
<section>
    <h2>Bedrijven ({{ $bedrijven->count() }})</h2>
    <table>
        <thead>
            <tr>
                <th>Naam</th>
                <th>Email</th>
                <th>Type</th>
                <th>Actie</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bedrijven as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->type }}</td>
                    <td>
                        @if(auth()->id() !== $user->id)
                            <form method="POST" action="{{ route('admin.user.destroy', $user->id) }}">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Weet je zeker dat je deze gebruiker wilt verwijderen?')">Verwijder</button>
                            </form>
                        @else
                            <span style="color: gray;">(jezelf)</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</section>

{{-- Vacatures --}}
<section>
    <h2>Vacatures ({{ $vacatures->count() }})</h2>
    <table>
        <thead>
            <tr>
                <th>Titel</th>
                <th>Beschrijving</th>
                <th>Type</th>
                <th>Actie</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vacatures as $vacature)
                <tr>
                    <td>{{ $vacature->title }}</td>
                    <td>{{ Str::limit($vacature->desc, 50) }}</td>
                    <td>{{ $vacature->type }}</td>
                    <td>
                        <form method="POST" action="{{ route('admin.vacature.destroy', $vacature->id) }}">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Vacature verwijderen?')">Verwijder</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</section>

{{-- FAQ vragen --}}
<section>
    <h2>FAQ-vragen ({{ $faqs->count() }})</h2>
    <table>
        <thead>
            <tr>
                <th>Gebruiker</th>
                <th>Onderwerp</th>
                <th>Vraag</th>
                <th>Antwoord</th>
                <th>Actie</th>
            </tr>
        </thead>
        <tbody>
            @foreach($faqs as $faq)
                <tr>
                    <td>{{ $faq->user->name }}</td>
                    <td>{{ $faq->subject }}</td>
                    <td>{{ $faq->question }}</td>
                    <td>
                        @if($faq->answer)
                            {{ $faq->answer }}
                        @else
                            <form method="POST" action="{{ route('admin.faq.answer', $faq->id) }}">
                                @csrf
                                <textarea name="answer" placeholder="Typ een antwoord..." required></textarea>
                                <button type="submit">Opslaan</button>
                            </form>
                        @endif
                    </td>
                    <td>
                        <form method="POST" action="{{ route('admin.faq.toggle', $faq->id) }}">
                            @csrf
                            <button type="submit">
                                {{ $faq->gepubliceerd ? 'Verberg' : 'Publiceer' }}
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</section>

</body>
</html>
