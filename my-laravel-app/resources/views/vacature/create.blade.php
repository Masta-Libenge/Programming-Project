<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Vacature aanmaken</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #e3f2fd, #ffffff);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background: #fff;
            padding: 30px 40px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
        }

        h1 {
            text-align: center;
            margin-bottom: 25px;
            color: #1e88e5;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
            color: #333;
        }

        input[type="text"],
        textarea,
        select,
        input[type="color"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 8px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            transition: border 0.3s ease;
        }

        input:focus,
        textarea:focus,
        select:focus {
            border-color: #1e88e5;
            outline: none;
        }

        button {
            margin-top: 25px;
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background-color: #1e88e5;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background-color: #1565c0;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h1>Vacature Aanmaken</h1>

        <form method="POST" action="{{ route('vacature.store') }}">
            @csrf

            <label for="name">Vacaturetitel</label>
<input type="text" name="title" id="title" required>

            <label for="desc">Beschrijving</label>
            <textarea name="desc" id="desc" rows="4" required></textarea>

            <label for="type">Contracttype</label>
            <select name="type" id="type">
                <option value="Stage">Stage</option>
                <option value="Werknemer">Werknemer</option>
            </select>

            <label for="color">Kleur (hex)</label>
            <input type="color" name="color" id="color" value="#ffffff">

            <button type="submit">Vacature toevoegen</button>
        </form>
    </div>

</body>
</html>
