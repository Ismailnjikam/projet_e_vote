<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/emails/login-notification.css') }}">
</head>
<body>
    <div class="email-wrapper">
        <div class="email-header">
            <h1>Bienvenu !</h1>
        </div>
        <div class="email-content">
            <p class="greeting">Bonjour <strong>{{ $user->name }}</strong>,</p>
            <p>Votre compte a été créé avec succès sur la plateforme de vote electronique. Vous pouvez maintenant vous connecter à votre compte en utilisant vos identifiants ci-dessous.</p>

            <div class="credentials-box">
                <p><strong>Votre Login(Identifiant) : </strong><span class="login-value">{{$login}}</span></p>
                <p><strong>Votre Mot de passe : </strong><span>Celui que vous avez choisi lors de votre inscription</span></p>
            </div>

            <p>Nous vous recommandons de changer votre mot de passe après votre première connexion pour assurer la sécurité de votre compte.</p>

            <div class="important-box">
                <strong>Important : </strong> Conservez votre login en securite. Ne pas le partager avec personne.
            </div>
            <p>veuillez cliquez sur le lien ci-dessous pour vous connecter à votre compte :</p>
            <div class="button-box">
                <a href="{{ route('login') }}" class="cta-btn">Se connecter à votre compte sur  E-Vote</a>
            </div>
            <p>Si vous avez des questions ou besoin d'assistance, n'hésitez pas à contacter l'administrateur du système.</p>
        </div> 
        <div class="email-footer-content">
            <p>Cordialement,</p>
            <p>L'équipe de E-Vote</p>
        </div>
        <div class="email-footer">
            <p>&copy; {{ date('Y') }} Plateforme de vote electronique. Tous droits réservés.</p>
        </div>
    </div>
</body>
</html>