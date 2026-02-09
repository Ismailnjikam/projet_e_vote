<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord | E-Vote</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/auth/dashboard.css') }}">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top" style="background-color: #1f2937;">
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
                        <a class="nav-link active" href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                            @csrf
                            <button type="submit" class="nav-link" style="background: none; border: none; cursor: pointer; padding: 0; color: inherit;">Déconnexion</button>
                        </form>
                        <!-- Ancien lien:
                            <i class="bi bi-box-arrow-right"></i> Déconnexion
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <!-- Welcome Card -->
        <div class="welcome-card mb-4">
            <h1 class="mb-2">
                <i class="bi bi-hand-thumbs-up"></i> Bienvenue, {{ Auth::user()->name }}!
            </h1>
            <p class="mb-0">Vous êtes connecté sur la plateforme E-Vote</p>
            <div class="action-buttons">
                <a href="{{ route('dashboard') }}" class="btn btn-light btn-lg me-2">
                    <i class="bi bi-speedometer2"></i> Visiter le Dashboard
                </a>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-lg" style="border: none;">Déconnexion</button>
                </form>
                <!-- Ancien lien:
                    <i class="bi bi-box-arrow-right"></i> Se déconnecter
                </a>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <i class="bi bi-list-check" style="font-size: 3rem; color: #667eea;"></i>
                        <h5 class="card-title mt-3">Scrutins</h5>
                        <p class="card-text text-muted">Consultez et participez aux scrutins</p>
                        <a href="{{ route('dashboard') }}" class="btn btn-primary btn-sm">Voir plus</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <i class="bi bi-people" style="font-size: 3rem; color: #667eea;"></i>
                        <h5 class="card-title mt-3">Candidats</h5>
                        <p class="card-text text-muted">Découvrez les candidats</p>
                        <a href="{{ route('dashboard') }}" class="btn btn-primary btn-sm">Voir plus</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <i class="bi bi-graph-up" style="font-size: 3rem; color: #667eea;"></i>
                        <h5 class="card-title mt-3">Résultats</h5>
                        <p class="card-text text-muted">Consultez les résultats en temps réel</p>
                        <a href="{{ route('dashboard') }}" class="btn btn-primary btn-sm">Voir plus</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer style="background-color: #1f2937; color: white; text-align: center; padding: 2rem; margin-top: 4rem;">
        <p>&copy; 2025 E-Vote - Système de Vote Électronique.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
