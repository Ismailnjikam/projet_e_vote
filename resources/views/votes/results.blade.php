<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats - {{ $scrutin->titre }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="{{ asset('css/votes/results.css') }}">
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
                        <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                            @csrf
                            <button type="submit" class="nav-link" style="background: none; border: none; cursor: pointer; padding: 0; color: inherit;">Déconnexion</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <!-- Results Header -->
        <div class="results-header">
            <h1 class="mb-3">
                <i class="bi bi-graph-up"></i> Résultats du scrutin
            </h1>
            <h3 class="mb-0">{{ $scrutin->titre ?? $scrutin->nom }}</h3>
            <p class="text-white-50 mt-2">Filière : {{ $scrutin->filiere->nom ?? 'N/A' }}</p>
        </div>

        <!-- Statistics -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="stat-badge">
                    <div class="text-muted small">Total des votes</div>
                    <div class="vote-count">{{ $scrutin->votes->count() }}</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-badge">
                    <div class="text-muted small">Candidats</div>
                    <div class="vote-count">{{ $scrutin->candidats->count() }}</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-badge">
                    <div class="text-muted small">Participations</div>
                    <div class="vote-count">{{ $scrutin->votes->count() }}%</div>
                </div>
            </div>
        </div>

        <!-- Chart -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h5 class="card-title mb-4">
                    <i class="bi bi-bar-chart"></i> Graphique des résultats
                </h5>
                <div class="chart-container">
                    <canvas id="resultsChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Results Table -->
        <div class="card shadow-sm">
            <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                <h5 class="mb-0">
                    <i class="bi bi-list"></i> Classement détaillé
                </h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr style="background-color: #f8f9fa;">
                                <th><i class="bi bi-award"></i> Rang</th>
                                <th><i class="bi bi-person"></i> Candidat</th>
                                <th><i class="bi bi-hand-index"></i> Votes</th>
                                <th><i class="bi bi-percent"></i> Pourcentage</th>
                                <th style="width: 200px;">Graphique</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $candidates = [];
                                foreach($scrutin->candidats as $candidat) {
                                    $votes = $candidat->votes()->count();
                                    $candidates[] = ['candidat' => $candidat, 'votes' => $votes];
                                }
                                usort($candidates, function($a, $b) {
                                    return $b['votes'] <=> $a['votes'];
                                });
                            @endphp
                            @foreach($candidates as $index => $item)
                                @php
                                    $candidat = $item['candidat'];
                                    $votes = $item['votes'];
                                    $totalVotes = $scrutin->votes()->count();
                                    $percentage = $totalVotes > 0 ? round(($votes / $totalVotes) * 100, 2) : 0;
                                @endphp
                                <tr>
                                    <td>
                                        @if($index == 0)
                                            <span class="badge bg-warning text-dark" style="font-size: 1rem;">
                                                <i class="bi bi-trophy"></i> 1er
                                            </span>
                                        @elseif($index == 1)
                                            <span class="badge bg-secondary" style="font-size: 1rem;">
                                                <i class="bi bi-medal"></i> 2e
                                            </span>
                                        @elseif($index == 2)
                                            <span class="badge" style="background-color: #cd7f32; font-size: 1rem;">
                                                <i class="bi bi-medal"></i> 3e
                                            </span>
                                        @else
                                            <span style="color: #999;">{{ $index + 1 }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <strong>{{ $candidat->nom }} {{ $candidat->prenom ?? '' }}</strong>
                                        <br>
                                        <small class="text-muted">{{ $candidat->filiere->nom ?? 'N/A' }}</small>
                                    </td>
                                    <td>
                                        <span class="badge badge-primary">{{ $votes }}</span>
                                    </td>
                                    <td>
                                        <strong>{{ $percentage }}%</strong>
                                    </td>
                                    <td>
                                        <div style="background-color: #f8f9fa; border-radius: 6px; padding: 5px;">
                                            <div class="progress-bar-custom" style="width: {{ $percentage }}%;">
                                                @if($percentage > 10)
                                                    {{ $percentage }}%
                                                @endif
                                            </div>
                                            @if($percentage <= 10)
                                                <span style="color: #667eea; font-size: 0.8rem; margin-left: 5px;">{{ $percentage }}%</span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Back Button -->
        <div class="mt-4">
            <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg">
                <i class="bi bi-arrow-left"></i> Retour au Dashboard
            </a>
        </div>
    </div>

    <!-- Footer -->
    <footer style="background-color: #1f2937; color: white; text-align: center; padding: 2rem; margin-top: 4rem;">
        <p>&copy; 2025 E-Vote - Système de Vote Électronique.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/votes/results.js') }}"></script>
</body>
</html>
