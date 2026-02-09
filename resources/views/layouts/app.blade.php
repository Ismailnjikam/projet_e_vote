<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | E-Vote</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('extra-css')
    <link rel="stylesheet" href="{{ asset('css/layouts/app.css') }}">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('welcome') }}">
                <i class="bi bi-check-circle"></i> E-Vote
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('welcome') }}">
                            <i class="bi bi-house"></i> Accueil
                        </a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">
                                <i class="bi bi-speedometer2"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-gear"></i> Admin
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark">
                                <li><a class="dropdown-item" href="{{ route('scrutins.index') }}"><i class="bi bi-list-check"></i> Scrutins</a></li>
                                <li><a class="dropdown-item" href="{{ route('candidats.index') }}"><i class="bi bi-people"></i> Candidats</a></li>
                                <li><a class="dropdown-item" href="{{ route('filieres.index') }}"><i class="bi bi-bookmark"></i> Filières</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                                        @csrf
                                        <button type="submit" class="dropdown-item" style="width: 100%; text-align: left; background: none; border: none; cursor: pointer; padding: inherit;"><i class="bi bi-box-arrow-right"></i> Déconnexion</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="bi bi-box-arrow-in-right"></i> Connexion
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">
                                <i class="bi bi-person-plus"></i> Inscription
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4 text-center">
                    <h6><i class="bi bi-shield-check"></i> Sécurisé</h6>
                    <p>Vos données sont protégées avec les meilleures mesures de sécurité.</p>
                </div>
                <div class="col-md-4 text-center">
                    <h6><i class="bi bi-lightning-fill"></i> Rapide</h6>
                    <p>Interface optimisée pour une expérience de vote fluide et intuitive.</p>
                </div>
                <div class="col-md-4 text-center">
                    <h6><i class="bi bi-eye"></i> Transparent</h6>
                    <p>Résultats en temps réel et accessible à tous.</p>
                </div>
            </div>
            <hr style="opacity: 0.5;">
            <p>&copy; 2025 E-Vote - Système de Vote Électronique. Tous droits réservés.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @yield('extra-js')
</body>
</html>
