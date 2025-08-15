<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Liste des Scrutins</title>
<style>
body{font-family:Arial;background:#f4f6f8;margin:0;padding:0;}
header{background:#1f2937;color:#fff;padding:15px 30px;text-align:center;}
.container{max-width:900px;margin:30px auto;background:#fff;padding:20px;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,0.1);}
table{width:100%;border-collapse:collapse;}
th,td{padding:12px 15px;border-bottom:1px solid #ddd;text-align:left;}
th{background:#f3f4f6;}
tr:hover{background:#f1f5f9;}
a.button{display:inline-block;margin:10px 0;padding:10px 15px;background:#3b82f6;color:#fff;text-decoration:none;border-radius:5px;transition:0.2s;}
a.button:hover{background:#2563eb;}
form{display:inline-block;}
button{padding:10px 15px;border-radius:5px;border:none;color:#fff;cursor:pointer;}
.btn-edit{background:#f59e0b;} .btn-edit:hover{background:#d97706;}
.btn-delete{background:#ef4444;} .btn-delete:hover{background:#dc2626;}
</style>
</head>
<body>
<header><h1>Liste des Scrutins</h1></header>
<div class="container">
<a href="{{ route('scrutins.create') }}" class="button">Ajouter un scrutin</a>
<table>
<thead>
<tr>
<th>Nom</th>
<th>Filière</th>
<th>Date début</th>
<th>Date fin</th>
<th>Actions</th>
</tr>
</thead>
<tbody>
@foreach($scrutins as $scrutin)
<tr>
<td>{{ $scrutin->id }}</td>
<td>{{ $scrutin->nom }}</td>
<td>{{ $scrutin->filiere->nom ?? '-' }}</td>
<td>{{ $scrutin->date_debut }}</td>
<td>{{ $scrutin->date_fin }}</td>
<td>
<a href="{{ route('scrutins.edit', $scrutin->id) }}" class="btn-edit">Modifier</a>
<form action="{{ route('scrutins.destroy', $scrutin->id) }}" method="POST">
@csrf
@method('DELETE')
<button type="submit" class="btn-delete">Supprimer</button>
</form>
</td>
</tr>
@endforeach
@if($scrutins->isEmpty())
<tr><td colspan="6" style="text-align:center;">Aucun scrutin trouvé.</td></tr>
@endif
</tbody>
</table>
</div>
</body>
</html>
