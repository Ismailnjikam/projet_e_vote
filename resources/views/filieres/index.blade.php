<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Filières</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #1f2937;
            color: #fff;
            padding: 15px 30px;
            text-align: center;
        }
        .container {
            max-width: 900px;
            margin: 30px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f3f4f6;
        }
        tr:hover {
            background-color: #f1f5f9;
        }
        a.button {
            display: inline-block;
            margin: 10px 0;
            padding: 10px 15px;
            background-color: #3b82f6;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: 0.2s;
        }
        a.button:hover {
            background-color: #2563eb;
        }
    </style>
</head>
<body>
    <header>
        <h1>Liste des Filières</h1>
    </header>

    <div class="container">
        <a href="{{ route('filieres.create') }}" class="button">Ajouter une filière</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($filieres as $filiere)
                    <tr>
                        <td>{{ $filiere->id }}</td>
                        <td>{{ $filiere->nom }}</td>
                        <td>
                            <a href="{{ route('filieres.edit', $filiere->id) }}" class="button" style="background-color: #f59e0b;">Modifier</a>
                            <form action="{{ route('filieres.destroy', $filiere->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="button" style="background-color: #ef4444;">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                @if($filieres->isEmpty())
                    <tr>
                        <td colspan="3" style="text-align:center;">Aucune filière trouvée.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</body>
</html>
