<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | E-Vote</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
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
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('scrutins.index') }}">
                            <i class="bi bi-list-check"></i> Scrutins
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('candidats.index') }}">
                            <i class="bi bi-people"></i> Candidats
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('filieres.index') }}">
                            <i class="bi bi-bookmark"></i> Filières
                        </a>
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

    <div class="container-fluid p-4">
        <!-- Header -->
        <div class="dashboard-header">
            <h1><i class="bi bi-speedometer2"></i> Dashboard E-Vote</h1>
            <p class="text-white-50 m-0">Bienvenue sur votre tableau de bord</p>
        </div>

        <!-- Stats -->
        <div class="row">
            <div class="col-md-6 col-lg-3">
                <div class="stat-card">
                    <div class="stat-icon"><i class="bi bi-list-check"></i></div>
                    <div class="stat-number">{{ isset($scrutins) ? $scrutins->count() : 0 }}</div>
                    <div class="stat-label">Scrutins</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="stat-card">
                    <div class="stat-icon"><i class="bi bi-people"></i></div>
                    <div class="stat-number">{{ isset($candidats) ? $candidats->count() : 0 }}</div>
                    <div class="stat-label">Candidats</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="stat-card">
                    <div class="stat-icon"><i class="bi bi-bookmark"></i></div>
                    <div class="stat-number">{{ isset($filieres) ? $filieres->count() : 0 }}</div>
                    <div class="stat-label">Filières</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="stat-card">
                    <div class="stat-icon"><i class="bi bi-hand-index"></i></div>
                    <div class="stat-number">{{ isset($scrutins) && $scrutins->count() > 0 ? $scrutins[0]->votes->count() : 0 }}</div>
                    <div class="stat-label">Votes</div>
                </div>
            </div>
        </div>

        <div class="section-divider"></div>

        <!-- Scrutins -->
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="section-title">
                        <i class="bi bi-list-check"></i> Scrutins en cours
                    </h2>
                    <a href="{{ route('scrutins.create') }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-circle"></i> Nouveau scrutin
                    </a>
                </div>
            </div>
        </div>

        @if(isset($scrutins) && $scrutins->count() > 0)
            <div class="row mb-5">
                @foreach($scrutins as $scrutin)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100">
                            <div class="card-header text-white">
                                <h5 class="card-title text-white mb-0">{{ $scrutin->titre }}</h5>
                            </div>
                            <div class="card-body">
                                <p class="card-text">
                                    <strong><i class="bi bi-bookmark"></i> Filière :</strong> {{ $scrutin->filiere->nom ?? 'N/A' }}
                                </p>
                                <p class="card-text">
                                    <strong><i class="bi bi-calendar"></i> Dates :</strong>
                                    <br>{{ $scrutin->date_debut }} → {{ $scrutin->date_fin }}
                                </p>
                                <p class="card-text">
                                    <strong><i class="bi bi-hand-index"></i> Votes :</strong>
                                    <span class="badge badge-primary">{{ $scrutin->votes->count() }}</span>
                                </p>
                            </div>
                            <div class="card-footer bg-light d-grid gap-2">
                                <a href="{{ route('votes.create', $scrutin->id) }}" class="btn btn-primary btn-sm">
                                    <i class="bi bi-check-lg"></i> Voter
                                </a>
                                <a href="{{ route('scrutins.show', $scrutin->id) }}" class="btn btn-secondary btn-sm">
                                    <i class="bi bi-bar-chart"></i> Résultats
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info mb-5">
                <i class="bi bi-info-circle"></i> Aucun scrutin en cours. <a href="{{ route('scrutins.create') }}">Créer un nouveau scrutin</a>
            </div>
        @endif

        <!-- Candidats -->
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="section-title">
                        <i class="bi bi-people"></i> Candidats
                    </h2>
                    <a href="{{ route('candidats.create') }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-circle"></i> Nouveau candidat
                    </a>
                </div>
            </div>
        </div>

        @if(isset($candidats) && $candidats->count() > 0)
            <div class="row">
                @foreach($candidats as $candidat)
                    <div class="col-md-6 col-lg-3 mb-4">
                        <div class="card h-100 text-center">
                            @if($candidat->photo)
                                <img src="{{ asset('storage/'.$candidat->photo) }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="{{ $candidat->nom }}">
                            @else
                                <div style="height: 200px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-person" style="font-size: 4rem; color: white;"></i>
                                </div>
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $candidat->nom }}</h5>
                                <p class="card-text text-muted">
                                    <small><i class="bi bi-bookmark"></i> {{ $candidat->filiere->nom ?? 'N/A' }}</small>
                                </p>
                                <p class="card-text text-muted">
                                    <small><i class="bi bi-list-check"></i> {{ $candidat->scrutin->titre ?? 'N/A' }}</small>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info">
                <i class="bi bi-info-circle"></i> Aucun candidat enregistré. <a href="{{ route('candidats.create') }}">Ajouter un candidat</a>
            </div>
        @endif
    </div>

    <!-- Footer -->
    <footer style="background-color: #1f2937; color: white; text-align: center; padding: 2rem; margin-top: 4rem;">
        <p>&copy; 2025 E-Vote - Système de Vote Électronique. Tous droits réservés.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
