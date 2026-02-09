<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin | E-Vote</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    @vite(['resources/css/admin/dashboard.css', 'resources/js/admin/dashboard.js'])
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <a class="sidebar-brand" href="{{ route('welcome') }}">
            <i class="bi bi-check-circle"></i>
            <span>E-Vote</span>
        </a>

        <ul class="sidebar-menu" id="sidebarMenu">
            <li>
                <a href="{{ route('admin.dashboard') }}" class="active">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('scrutins.index') }}">
                    <i class="bi bi-list-check"></i>
                    <span>Scrutins</span>
                </a>
            </li>
            <li>
                <a href="{{ route('candidats.index') }}">
                    <i class="bi bi-people"></i>
                    <span>Candidats</span>
                </a>
            </li>
            <li>
                <a href="{{ route('filieres.index') }}">
                    <i class="bi bi-bookmark"></i>
                    <span>Filières</span>
                </a>
            </li>

            <div class="sidebar-divider"></div>

            <li>
                <a href="{{ route('welcome') }}" target="_blank">
                    <i class="bi bi-globe"></i>
                    <span>Voir le site</span>
                </a>
            </li>

            <li>
                <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Déconnexion</span>
                    </button>
                </form>
            </li>
        </ul>
    </aside>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <!-- Top Bar -->
        <div class="topbar">
            <div class="topbar-left">
                <button class="toggle-btn" id="toggleBtn">
                    <i class="bi bi-list"></i>
                </button>
                <h2 class="topbar-title">
                    <i class="bi bi-speedometer2"></i> Dashboard Admin
                </h2>
            </div>

            <div class="topbar-right">
                <div class="user-info">
                    <div class="user-avatar">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div class="user-details">
                        <h6>{{ Auth::user()->name }}</h6>
                        <small>Administrateur</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="content">
            <!-- Header -->
            <div class="dashboard-header">
                <h1><i class="bi bi-speedometer2"></i> Bienvenue Admin</h1>
                <p>Gérez l'ensemble du système de vote électronique</p>
            </div>

            <!-- Quick Actions -->
            <div class="row mb-4">
                <div class="col-12">
                    <h3 class="section-title">
                        <i class="bi bi-lightning"></i> Actions Rapides
                    </h3>
                </div>
                <div class="col-md-6 col-lg-3">
                    <a href="{{ route('scrutins.create') }}" class="btn btn-action btn-primary-custom w-100 mb-2">
                        <i class="bi bi-plus-circle"></i> Nouveau Scrutin
                    </a>
                </div>
                <div class="col-md-6 col-lg-3">
                    <a href="{{ route('candidats.create') }}" class="btn btn-action btn-primary-custom w-100 mb-2">
                        <i class="bi bi-plus-circle"></i> Nouveau Candidat
                    </a>
                </div>
                <div class="col-md-6 col-lg-3">
                    <a href="{{ route('filieres.create') }}" class="btn btn-action btn-primary-custom w-100 mb-2">
                        <i class="bi bi-plus-circle"></i> Nouvelle Filière
                    </a>
                </div>
                <div class="col-md-6 col-lg-3">
                    <a href="{{ route('scrutins.index') }}" class="btn btn-action btn-primary-custom w-100 mb-2">
                        <i class="bi bi-eye"></i> Voir Tous
                    </a>
                </div>
            </div>

            <div class="section-divider"></div>

            <!-- Stats -->
            <div class="row mb-4">
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
