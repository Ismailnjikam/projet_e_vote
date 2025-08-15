<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Liste des Candidats</title>
<style>
body { font-family: Arial, sans-serif; background: #f9f9fb; margin:0; padding:20px; }
h1 { color: #333; }
a.button { text-decoration: none; padding: 8px 16px; background: #007BFF; color: white; border-radius: 5px; margin-bottom: 15px; display:inline-block; }
a.button:hover { background: #0056b3; }
table { width: 100%; border-collapse: collapse; background:white; border-radius:8px; overflow:hidden; }
th, td { padding: 12px; text-align:left; border-bottom:1px solid #eee; }
th { background:#007BFF; color:white; }
img { width: 50px; height:50px; border-radius:50%; object-fit:cover; }
form { display:inline; }
button.delete { background:#dc3545; color:white; padding:5px 10px; border:none; border-radius:5px; cursor:pointer; }
button.delete:hover { background:#a71d2a; }
</style>
</head>
<body>

<h1>Liste des Candidats</h1>
<a href="{{ route('candidats.create') }}" class="button">Ajouter un Candidat</a>

@if(session('success'))
<p style="color:green;">{{ session('success') }}</p>
@endif

<table>
<thead>
<tr>
<th>Photo</th>
<th>Nom</th>
<th>Prénom</th>
<th>Filière</th>
<th>Scrutin</th>
<th>Actions</th>
</tr>
</thead>
<tbody>
@foreach($candidats as $candidat)
<tr>
<td>
@if($candidat->photo)
<img src="{{ asset('storage/'.$candidat->photo) }}" alt="Photo">
@else
<img src="https://via.placeholder.com/50" alt="Photo">
@endif
</td>
<td>{{ $candidat->nom }}</td>
<td>{{ $candidat->prenom }}</td>
<td>{{ $candidat->filiere->nom ?? '' }}</td>
<td>{{ $candidat->scrutin->nom ?? '' }}</td>
<td>
<a href="{{ route('candidats.edit', $candidat->id) }}" class="button">Modifier</a>
<form action="{{ route('candidats.destroy', $candidat->id) }}" method="POST">
@csrf
@method('DELETE')
<button type="submit" class="delete">Supprimer</button>
</form>
</td>
</tr>
@endforeach
</tbody>
</table>

</body>
</html>
