<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Modifier un Candidat</title>
<style>
body { font-family: Arial, sans-serif; background: #f9f9fb; padding:20px; }
h1 { color: #333; }
form { background:white; padding:20px; border-radius:8px; max-width:500px; }
label { display:block; margin-top:10px; }
input, select { width:100%; padding:8px; margin-top:5px; border-radius:5px; border:1px solid #ccc; }
button { margin-top:15px; padding:10px 20px; background:#007BFF; color:white; border:none; border-radius:5px; cursor:pointer; }
button:hover { background:#0056b3; }
img { width:80px; height:80px; border-radius:50%; object-fit:cover; margin-top:10px; }
</style>
</head>
<body>

<h1>Modifier un Candidat</h1>

@if ($errors->any())
<div style="color:red;">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif

<form action="{{ route('candidats.update', $candidat->id) }}" method="POST" enctype="multipart/form-data">
@csrf
@method('PUT')

<label for="nom">Nom :</label>
<input type="text" name="nom" id="nom" value="{{ $candidat->nom }}" required>

<label for="prenom">Prénom :</label>
<input type="text" name="prenom" id="prenom" value="{{ $candidat->prenom }}" required>

<label for="filiere_id">Filière :</label>
<select name="filiere_id" id="filiere_id" required>
@foreach($filieres as $filiere)
<option value="{{ $filiere->id }}" {{ $filiere->id == $candidat->filiere_id ? 'selected' : '' }}>{{ $filiere->nom }}</option>
@endforeach
</select>

<label for="scrutin_id">Scrutin :</label>
<select name="scrutin_id" id="scrutin_id" required>
@foreach($scrutins as $scrutin)
<option value="{{ $scrutin->id }}" {{ $scrutin->id == $candidat->scrutin_id ? 'selected' : '' }}>{{ $scrutin->nom }}</option>
@endforeach
</select>

<label for="photo">Photo :</label>
<input type="file" name="photo" id="photo" accept="image/*">
@if($candidat->photo)
<img src="{{ asset('storage/'.$candidat->photo) }}" alt="Photo actuelle">
@endif

<button type="submit">Mettre à jour</button>
</form>

</body>
</html>
