<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Ajouter un Scrutin</title>
<style>
body{font-family:Arial;background:#f4f6f8;margin:0;padding:0;}
.container{max-width:500px;margin:50px auto;background:#fff;padding:30px;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,0.1);}
input,select,button{width:100%;padding:12px;margin:10px 0;border-radius:5px;border:1px solid #ccc;}
button{background:#3b82f6;color:#fff;border:none;cursor:pointer;transition:0.2s;} button:hover{background:#2563eb;}
a{text-decoration:none;color:#3b82f6;display:block;margin-top:10px;}
</style>
</head>
<body>
<div class="container">
<h2>Ajouter un Scrutin</h2>
<form action="{{ route('scrutins.store') }}" method="POST">
@csrf
<input type="text" name="nom" placeholder="Nom du scrutin" required>
<select name="filiere_id" required>
<option value="">Sélectionnez une filière</option>
@foreach($filieres as $filiere)
<option value="{{ $filiere->id }}">{{ $filiere->nom }}</option>
@endforeach
</select>
<input type="date" name="date_debut" required>
<input type="date" name="date_fin" required>
<button type="submit">Ajouter</button>
</form>
<a href="{{ route('scrutins.index') }}">← Retour à la liste</a>
</div>
</body>
</html>
