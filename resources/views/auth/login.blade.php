<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #6C63FF, #00BFA6); height: 100vh; display: flex; align-items: center; justify-content: center; }
        .card { padding: 30px; border-radius: 10px; box-shadow: 0 4px 20px rgba(0,0,0,0.1); }
    </style>
</head>
<body>
    <div class="card bg-white" style="width: 400px;">
        <h3 class="text-center mb-4">Connexion au site E-Vote IN3</h3>
        @if($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif
        <form method="POST" action="{{ route('login.post') }}">
            @csrf
            <div class="mb-3">
                <label>Login</label>
                <input type="text" name="login" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Mot de passe</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Se connecter</button>
        </form>
        <p class="text-center mt-3">Pas encore inscrit ? <a href="{{ route('register') }}">Créer un compte</a></p>
    </div>
</body>
</html>
