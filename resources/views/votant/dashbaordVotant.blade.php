<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Votant | E-Vote</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/votant/dashbaordVotant.css') }}">

        .scrutin-footer {
            display: flex;
            gap: 1rem;
        }

        .btn-vote {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
            flex: 1;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-vote:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(102, 126, 234, 0.4);
            color: white;
        }

        .btn-results {
            background: white;
            color: #667eea;
            border: 2px solid #667eea;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
            flex: 1;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-results:hover {
            background: #667eea;
            color: white;
        }

        .badge-status {
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-left: 1rem;
        }

        .badge-active {
            background: rgba(16, 185, 129, 0.2);
            color: #10b981;
        }

        .badge-ended {
            background: rgba(107, 114, 128, 0.2);
            color: #6b7280;
        }

        .badge-pending {
            background: rgba(245, 158, 11, 0.2);
            color: #f59e0b;
        }

        .navbar {
            background-color: #1f2937 !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 1rem 2rem;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
            color: #fff !important;
            letter-spacing: 1px;
        }

        .navbar-brand i {
            margin-right: 0.5rem;
            color: #3b82f6;
        }

        .nav-link {
            margin-left: 1rem;
            transition: color 0.3s;
        }

        .nav-link:hover {
            color: #3b82f6 !important;
        }

        .empty-state {
            text-align: center;
            padding: 3rem 2rem;
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .empty-state i {
            font-size: 3rem;
            color: #d1d5db;
            margin-bottom: 1rem;
        }

        .empty-state h4 {
            color: #6b7280;
            margin-bottom: 0.5rem;
        }

        .empty-state p {
            color: #9ca3af;
        }

        footer {
            background-color: #1f2937;
            color: white;
            text-align: center;
            padding: 2rem;
            margin-top: 4rem;
        }

        .user-profile {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .user-profile h5 {
            color: #1f2937;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            font-weight: 700;
        }

        .user-details h6 {
            color: #1f2937;
            margin-bottom: 0.25rem;
            font-weight: 600;
        }

        .user-details small {
            color: #6b7280;
        }

        @media (max-width: 768px) {
            .dashboard-header {
                padding: 2rem 1rem;
            }

            .dashboard-header h1 {
                font-size: 1.75rem;
            }

            .scrutin-stats {
                gap: 1rem;
            }

            .scrutin-footer {
                flex-direction: column;
            }

            .btn-vote, .btn-results {
                width: 100%;
            }
        }
    </style>
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
                    @auth
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                                @csrf
                                <button type="submit" class="nav-link" style="background: none; border: none; cursor: pointer; padding: 0; color: inherit;">Déconnexion</button>
                            </form>
                            <!-- Ancien lien:
                                <i class="bi bi-box-arrow-right"></i> Déconnexion
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-lg py-5">
        <!-- Dashboard Header -->
        <div class="dashboard-header">
            <h1>
                <i class="bi bi-speedometer2"></i> Tableau de Bord Votant
            </h1>
            <p>Bienvenue {{ Auth::user()->name }}, participez aux scrutins de votre filière</p>
        </div>

        <!-- User Profile -->
        <div class="user-profile">
            <h5><i class="bi bi-person-circle"></i> Mon Profil</h5>
            <div class="user-info">
                <div class="user-avatar">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div class="user-details">
                    <h6>{{ Auth::user()->name }}</h6>
                    <small>Identifiant: <strong>{{ Auth::user()->login }}</strong></small>
                    <br>
                    <small>Filière: <strong>{{ Auth::user()->filiere->nom ?? 'Non assignée' }}</strong></small>
                </div>
            </div>
        </div>

        <!-- Statistics -->
        <div class="row mb-4">
            <div class="col-md-6 col-lg-3">
                <div class="stat-card">
                    <div class="stat-icon"><i class="bi bi-list-check"></i></div>
                    <div class="stat-number">{{ isset($scrutinsTotal) ? $scrutinsTotal : 0 }}</div>
                    <div class="stat-label">Scrutins Actifs</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="stat-card">
                    <div class="stat-icon"><i class="bi bi-hand-index"></i></div>
                    <div class="stat-number">{{ isset($votesCount) ? $votesCount : 0 }}</div>
                    <div class="stat-label">Votes Effectués</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="stat-card">
                    <div class="stat-icon"><i class="bi bi-check-circle"></i></div>
                    <div class="stat-number">{{ isset($scrutinsRemaining) ? $scrutinsRemaining : 0 }}</div>
                    <div class="stat-label">Scrutins à Voter</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="stat-card">
                    <div class="stat-icon"><i class="bi bi-graph-up"></i></div>
                    <div class="stat-number">{{ isset($filiereParticipation) ? round($filiereParticipation) : 0 }}%</div>
                    <div class="stat-label">Taux Participation</div>
                </div>
            </div>
        </div>

        <!-- Scrutins en Cours -->
        <div class="row mt-5">
            <div class="col-12">
                <h2 class="section-title">
                    <i class="bi bi-list-check"></i> Scrutins en Cours
                </h2>
            </div>
        </div>

        @if(isset($scrutins) && $scrutins->count() > 0)
            <div class="row">
                @foreach($scrutins as $scrutin)
                    <div class="col-lg-6 mb-4">
                        <div class="scrutin-card">
                            <div class="scrutin-header">
                                <h4>{{ $scrutin->titre ?? 'Scrutin' }}</h4>
                                <div class="scrutin-filiere">
                                    <i class="bi bi-bookmark"></i> {{ $scrutin->filiere->nom ?? 'Générale' }}
                                    @if($scrutin->date_fin > now())
                                        <span class="badge-status badge-active">Actif</span>
                                    @else
                                        <span class="badge-status badge-ended">Terminé</span>
                                    @endif
                                </div>
                            </div>
                            <div class="scrutin-body">
                                <div class="scrutin-dates">
                                    <i class="bi bi-calendar-event"></i>
                                    Du {{ \Carbon\Carbon::parse($scrutin->date_debut)->format('d/m/Y H:i') }}
                                    au {{ \Carbon\Carbon::parse($scrutin->date_fin)->format('d/m/Y H:i') }}
                                </div>

                                @if($scrutin->description)
                                    <div class="scrutin-description">
                                        {{ $scrutin->description }}
                                    </div>
                                @endif

                                <div class="scrutin-stats">
                                    <div class="scrutin-stat">
                                        <div class="scrutin-stat-number">{{ $scrutin->candidats->count() }}</div>
                                        <div class="scrutin-stat-label">Candidats</div>
                                    </div>
                                    <div class="scrutin-stat">
                                        <div class="scrutin-stat-number">{{ $scrutin->votes->count() }}</div>
                                        <div class="scrutin-stat-label">Votes</div>
                                    </div>
                                    <div class="scrutin-stat">
                                        <div class="scrutin-stat-number">
                                            @php
                                                $userVote = $scrutin->votes()
                                                    ->where('user_id', Auth::id())
                                                    ->exists();
                                            @endphp
                                            {{ $userVote ? '✓' : '-' }}
                                        </div>
                                        <div class="scrutin-stat-label">Mon Vote</div>
                                    </div>
                                </div>

                                <div class="scrutin-footer">
                                    @php
                                        $userHasVoted = $scrutin->votes()
                                            ->where('user_id', Auth::id())
                                            ->exists();
                                    @endphp
                                    @if(!$userHasVoted && $scrutin->date_fin > now())
                                        <a href="{{ route('votes.create', $scrutin->id) }}" class="btn-vote">
                                            <i class="bi bi-check-lg"></i> Voter Maintenant
                                        </a>
                                    @else
                                        <button class="btn-vote" disabled style="opacity: 0.6; cursor: not-allowed;">
                                            <i class="bi bi-check-circle"></i> 
                                            {{ $userHasVoted ? 'Vous avez voté' : 'Scrutin fermé' }}
                                        </button>
                                    @endif
                                    <a href="{{ route('scrutins.show', $scrutin->id) }}" class="btn-results">
                                        <i class="bi bi-bar-chart"></i> Voir Résultats
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="row">
                <div class="col-12">
                    <div class="empty-state">
                        <i class="bi bi-inbox"></i>
                        <h4>Aucun scrutin actif</h4>
                        <p>Il n'y a actuellement aucun scrutin disponible. Les nouveaux scrutins apparaîtront ici.</p>
                        <a href="{{ route('welcome') }}" class="btn btn-primary mt-3">
                            <i class="bi bi-arrow-left"></i> Retour à l'accueil
                        </a>
                    </div>
                </div>
            </div>
        @endif

        <!-- Scrutins Terminés -->
        @if(isset($scrutinsTermines) && $scrutinsTermines->count() > 0)
            <div class="row mt-5">
                <div class="col-12">
                    <h2 class="section-title">
                        <i class="bi bi-archive"></i> Scrutins Terminés
                    </h2>
                </div>
            </div>

            <div class="row">
                @foreach($scrutinsTermines as $scrutin)
                    <div class="col-lg-6 mb-4">
                        <div class="scrutin-card" style="opacity: 0.85;">
                            <div class="scrutin-header" style="background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);">
                                <h4>{{ $scrutin->titre ?? 'Scrutin' }}</h4>
                                <div class="scrutin-filiere">
                                    <i class="bi bi-bookmark"></i> {{ $scrutin->filiere->nom ?? 'Générale' }}
                                    <span class="badge-status badge-ended">Terminé</span>
                                </div>
                            </div>
                            <div class="scrutin-body">
                                <div class="scrutin-dates">
                                    <i class="bi bi-calendar-event"></i>
                                    Du {{ \Carbon\Carbon::parse($scrutin->date_debut)->format('d/m/Y H:i') }}
                                    au {{ \Carbon\Carbon::parse($scrutin->date_fin)->format('d/m/Y H:i') }}
                                </div>

                                <div class="scrutin-stats">
                                    <div class="scrutin-stat">
                                        <div class="scrutin-stat-number">{{ $scrutin->candidats->count() }}</div>
                                        <div class="scrutin-stat-label">Candidats</div>
                                    </div>
                                    <div class="scrutin-stat">
                                        <div class="scrutin-stat-number">{{ $scrutin->votes->count() }}</div>
                                        <div class="scrutin-stat-label">Votes Total</div>
                                    </div>
                                </div>

                                <div class="scrutin-footer">
                                    <a href="{{ route('scrutins.show', $scrutin->id) }}" class="btn-results" style="flex: 1;">
                                        <i class="bi bi-bar-chart"></i> Voir les Résultats
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 E-Vote - Système de Vote Électronique. Tous droits réservés.</p>
        <p style="margin-top: 0.5rem; opacity: 0.8;">Fait avec <i class="bi bi-heart-fill" style="color: #ef4444;"></i> pour la démocratie</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
