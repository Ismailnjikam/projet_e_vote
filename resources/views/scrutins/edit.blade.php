<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Modifier le Scrutin</title>
<style>
body{font-family:Arial;background:#f4f6f8;margin:0;padding:0;}
.container{max-width:500px;margin:50px auto;background:#fff;padding:30px;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,0.1);}
input,select,button{width:100%;padding:12px;margin:10px 0;border-radius:5px;border:1px solid #ccc;}
button{background:#f59e0b;color:#fff;border:none;cursor:pointer;transition:0.2s;} button:hover{background:#d97706;}
a{text-decoration:none;color:#3b82f6;display:block;margin-top:10px;}
</style>
</head>
<body>
<div class="container">
<h2>Modifier le Scrutin</h2>
<form action="{{ route('scrutins.update', $scrutin->id) }}" method="POST">
@csrf
@method('PUT')
<input type="text" name="nom" value="{{ $scrutin->nom }}" required>
<select name="filiere_id" required>
<option value="">Sélectionnez une filière</option>
@foreach($filieres as $filiere)
<option value="{{ $filiere->id }}" @if($scrutin->filiere_id == $filiere->id) selected @endif>{{ $filiere->nom }}</option>
@endforeach
</select>
<input type="date" name="date_debut" value="{{ $scrutin->date_debut }}" required>
<input type="date" name="date_fin" value="{{ $scrutin->date_fin }}" required>
<button type="submit">Modifier</button>
</form>
<a href="{{ route('scrutins.index') }}">← Retour à la liste</a>
</div>
</body>
</html>
