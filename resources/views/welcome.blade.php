<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Vote - Système de Vote Électronique</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/css/welcome.css', 'resources/js/app.js'])
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('welcome') }}">
                <i class="bi bi-check-circle"></i>E-Vote
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('welcome') }}">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('scrutins.index') }}">Scrutins</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('candidats.index') }}">Candidats</a>
                    </li>
                    @auth
                            @if(Auth::user()->role === 'admin')
                                <li class="nav-item">
                                   <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
                                </li>
                                <li class="nav-item">
                                  <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                                      @csrf
                                      <button type="submit" class="nav-link" style="background: none; border: none; cursor: pointer; padding: 0; color: inherit; font-size: inherit;">Déconnexion</button>
                                  </form>
                                </li>
                                </li>
                            @endif
                    @else           
                                <li class="nav-item">
                                 <a class="nav-link" href="{{ route('login') }}">Connexion</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" href="{{ route('register') }}">Inscription</a>
                                </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Bienvenue sur E-Vote</h1>
            <p>Un système de vote électronique simple, transparent et sécurisé</p>
            <div>
                @auth
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="btn-primary-custom">
                            <i class="bi bi-speedometer2"></i> Dashboard Admin
                        </a>
                    @else
                        <a href="{{ route('votant.dashboard') }}" class="btn-primary-custom">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn-secondary-custom" style="border: none; background: none; cursor: pointer;">Déconnexion</button>
                    </form>
                    <!-- Ancien lien:
                        <i class="bi bi-box-arrow-right"></i> Déconnexion
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn-primary-custom">
                        <i class="bi bi-box-arrow-in-right"></i> Se Connecter
                    </a>
                    <a href="{{ route('register') }}" class="btn-secondary-custom">
                        <i class="bi bi-person-plus"></i> S'Inscrire
                    </a>
                @endauth
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <div class="container">
            <h2>Pourquoi E-Vote ?</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h3>Sécurisé</h3>
                        <p>Vos données sont protégées avec les meilleures mesures de sécurité. Chaque vote est enregistré de manière confidentielle.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-lightning-fill"></i>
                        </div>
                        <h3>Rapide</h3>
                        <p>Votez en quelques secondes depuis n'importe où. Pas de files d'attente, pas de complications.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-eye"></i>
                        </div>
                        <h3>Transparent</h3>
                        <p>Consultez les résultats en temps réel. Visualisez les statistiques et tendances de chaque scrutin.</p>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-graph-up"></i>
                        </div>
                        <h3>Résultats Instantanés</h3>
                        <p>Obtenez les résultats immédiatement après la clôture du scrutin, aucune attente.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-person-check"></i>
                        </div>
                        <h3>Accessibilité</h3>
                        <p>Interface simple et intuitive adaptée à tous, même pour les utilisateurs moins expérimentés.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-gear"></i>
                        </div>
                        <h3>Gestion Complète</h3>
                        <p>Gestion intégrale des scrutins, candidats et résultats depuis une interface administrative.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Active Scrutins Section -->
    <section class="scrutins-section">
        <div class="container">
            <h2>Scrutins Actifs</h2>
            @if(isset($scrutins) && $scrutins->count() > 0)
                @foreach($scrutins as $scrutin)
                    <div class="scrutin-item">
                        <div class="scrutin-header">
                            <h3>{{ $scrutin->titre ?? 'Scrutin' }}</h3>
                            <span class="badge-status">
                                <i class="bi bi-check-circle"></i> Actif
                            </span>
                        </div>
                        <div class="scrutin-info">
                            <p><strong>Filière :</strong> {{ $scrutin->filiere->nom ?? 'N/A' }}</p>
                            <p><strong>Période :</strong> {{ $scrutin->date_debut ?? 'N/A' }} au {{ $scrutin->date_fin ?? 'N/A' }}</p>
                            @if($scrutin->description)
                                <p><strong>Description :</strong> {{ $scrutin->description }}</p>
                            @endif
                        </div>
                        <div class="scrutin-footer">
                            <a href="{{ route('votes.create', $scrutin->id) }}" class="btn-vote">
                                <i class="bi bi-check-lg"></i> Voter Maintenant
                            </a>
                            <a href="{{ route('scrutins.show', $scrutin->id) }}" class="btn-info">
                                <i class="bi bi-info-circle"></i> Plus d'infos
                            </a>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="alert alert-info" style="margin-top: 2rem;">
                    <i class="bi bi-info-circle"></i> Aucun scrutin actif pour le moment. Revenez bientôt !
                </div>
            @endif
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <h2>Prêt à voter ?</h2>
            <p>Participez à la démocratie en votant dès maintenant</p>
            @auth
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="btn-primary-custom">
                        <i class="bi bi-arrow-right"></i> Dashboard Admin
                    </a>
                @else
                    <a href="{{ route('votant.dashboard') }}" class="btn-primary-custom">
                        <i class="bi bi-arrow-right"></i> Dashboard
                    </a>
                @endif
            @else
                <a href="{{ route('login') }}" class="btn-primary-custom">
                    <i class="bi bi-box-arrow-in-right"></i> Se Connecter
                </a>
            @endauth
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 E-Vote - Système de Vote Électronique. Tous droits réservés.</p>
        <p>Fait avec <i class="bi bi-heart-fill heart-icon"></i> pour la démocratie</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
