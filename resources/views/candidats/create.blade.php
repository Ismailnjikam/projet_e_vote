<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Ajouter un Candidat Au E-vote IN3</title>
<style>
body { font-family: Arial, sans-serif; background: #f9f9fb; padding:20px; }
h1 { color: #333; }
form { background:white; padding:20px; border-radius:8px; max-width:500px; }
label { display:block; margin-top:10px; }
input, select { width:100%; padding:8px; margin-top:5px; border-radius:5px; border:1px solid #ccc; }
button { margin-top:15px; padding:10px 20px; background:#007BFF; color:white; border:none; border-radius:5px; cursor:pointer; }
button:hover { background:#0056b3; }
</style>
</head>
<body>

<h1>Ajouter un Candidat</h1>

@if ($errors->any())
<div style="color:red;">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif

<form action="{{ route('candidats.store') }}" method="POST" enctype="multipart/form-data">
@csrf
<label for="nom">Nom :</label>
<input type="text" name="nom" id="nom" required>

<label for="prenom">Prénom :</label>
<input type="text" name="prenom" id="prenom" required>

<label for="filiere_id">Filière :</label>
<select name="filiere_id" id="filiere_id" required>
<option value="">Sélectionner une filière</option>
@foreach($filieres as $filiere)
<option value="{{ $filiere->id }}">{{ $filiere->nom }}</option>
@endforeach
</select>

<label for="scrutin_id">Scrutin :</label>
<select name="scrutin_id" id="scrutin_id" required>
<option value="">Sélectionner un scrutin</option>
@foreach($scrutins as $scrutin)
<option value="{{ $scrutin->id }}">{{ $scrutin->nom }}</option>
@endforeach
</select>

<label for="photo">Photo :</label>
<input type="file" name="photo" id="photo" accept="image/*">

<button type="submit">Ajouter</button>
</form>

</body>
</html>
