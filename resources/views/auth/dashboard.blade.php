
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
    <h1>Bienvenue, {{ Auth::user()->name }}</h1>
    <p>Vous êtes connecté sur la plateforme de vote.</p>
    <a href="{{ route('logout') }}" class="btn btn-danger">Se déconnecter</a>
</body>
</html>
