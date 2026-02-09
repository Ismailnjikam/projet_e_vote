<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription | E-Vote</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    @vite(['resources/css/auth/register.css', 'resources/js/app.js'])
</head>
<body class="auth-page">
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <i class="bi bi-person-plus"></i>
                <h3>Inscription</h3>
                <p>Créer un compte E-Vote</p>
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

            <form method="POST" action="{{ route('register.post') }}">
                @csrf
                
                <div class="form-group">
                    <label for="name" class="form-label">
                        <i class="bi bi-person"></i> Nom complet
                    </label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Votre nom complet" required>
                </div>

                <div class="form-group">
                    <label for="login" class="form-label">
                        <i class="bi bi-person-badge"></i> Adresse Email
                    </label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Votre adresse email" required>
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">
                        <i class="bi bi-lock"></i> Mot de passe
                    </label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Au moins 8 caractères" required>
                    <div class="password-strength" id="passwordStrength"></div>
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="form-label">
                        <i class="bi bi-lock-check"></i> Confirmer le mot de passe
                    </label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirmez votre mot de passe" required>
                </div>

                <button type="submit" class="btn-login">
                    <i class="bi bi-person-plus"></i> S'inscrire
                </button>
            </form>

            <div class="auth-footer">
                <p>Déjà inscrit ? <a href="{{ route('login') }}">Se connecter ici</a></p>
                <a href="{{ route('welcome') }}" class="btn btn-outline-secondary btn-sm mt-3 w-100">
                    <i class="bi bi-house"></i> Retour à l'Accueil
                </a>
            </div>
        </div>
    </div>

</body>
</html>
