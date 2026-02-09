<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion | E-Vote</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    @vite(['resources/css/app.css','resources/css/auth/login.css','resources/js/app.js'])
</head>
<body class="auth-page">
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <i class="bi bi-box-arrow-in-right"></i>
                <h3>Connexion</h3>
                <p>Bienvenue sur E-Vote</p>
            </div>

            @if($errors->any())
                <div class="alert alert-danger">
                    <i class="bi bi-exclamation-circle"></i>
                    <strong>Erreur :</strong> {{ $errors->first() }}
                </div>
            @endif

            @if(session('message'))
                <div class="alert alert-success">
                    <i class="bi bi-check-circle"></i>
                    {{ session('message') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.post') }}">
                @csrf
                
                <div class="form-group">
                    <label for="login" class="form-label">
                        <i class="bi bi-person"></i> Identifiant
                    </label>
                    <input type="text" class="form-control" id="login" name="login" placeholder="Votre identifiant" required autofocus>
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">
                        <i class="bi bi-lock"></i> Mot de passe
                    </label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Votre mot de passe" required>
                </div>

                <button type="submit" class="btn-login">
                    <i class="bi bi-box-arrow-in-right"></i> Se connecter
                </button>
            </form>

            <div class="auth-footer">
                <p>Pas encore de compte ? <a href="{{ route('register') }}">S'inscrire ici</a></p>
                <a href="{{ route('welcome') }}" class="btn btn-outline-secondary btn-sm mt-3 w-100">
                    <i class="bi bi-house"></i> Retour à l'Accueil
                </a>
            </div>
        </div>
    </div>
</body>
</html>
