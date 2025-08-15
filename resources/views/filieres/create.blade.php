<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Filière</title>
    <style>
        body { font-family: Arial; background: #f4f6f8; margin:0; padding:0; }
        .container {
            max-width: 500px;
            margin: 50px auto;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        input[type="text"], button {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            background-color: #3b82f6;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: 0.2s;
        }
        button:hover {
            background-color: #2563eb;
        }
        a { text-decoration: none; color: #3b82f6; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Ajouter une Filière</h2>
        <form action="{{ route('filieres.store') }}" method="POST">
            @csrf
            <input type="text" name="nom" placeholder="Nom de la filière" required>
            <button type="submit">Ajouter</button>
        </form>
        <a href="{{ route('filieres.index') }}">← Retour à la liste</a>
    </div>
</body>
</html>
