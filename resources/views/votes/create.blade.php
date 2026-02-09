<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voter | E-Vote</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/votes/create.css') }}">
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
        <!-- Voting Header -->
        <div class="voting-header">
            <h1 class="mb-3">
                <i class="bi bi-hand-index"></i> Votez maintenant !
            </h1>
            <h3 class="mb-0">{{ $scrutin->titre ?? $scrutin->nom }}</h3>
            <p class="text-white-50 mt-2">Filière : {{ $scrutin->filiere->nom ?? 'N/A' }}</p>
        </div>

        <!-- Info Alert -->
        <div class="alert alert-info alert-dismissible fade show">
            <i class="bi bi-info-circle"></i> <strong>Instructions :</strong> Sélectionnez le candidat de votre choix et confirmez votre vote.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>

        <!-- Voting Form -->
        <form action="{{ route('votes.store', $scrutin->id) }}" method="POST" id="votingForm">
            @csrf

            <!-- Candidates Grid -->
            <div class="row g-4 mb-4">
                @foreach($scrutin->candidats as $candidat)
                    <div class="col-md-6 col-lg-4">
                        <label for="candidat{{ $candidat->id }}" style="cursor: pointer;">
                            <div class="card vote-card shadow-sm" id="card-{{ $candidat->id }}">
                                @if($candidat->photo)
                                    <img src="{{ asset('storage/' . $candidat->photo) }}" class="vote-img" alt="{{ $candidat->nom }}">
                                @else
                                    <div style="height: 250px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; border-radius: 10px 10px 0 0;">
                                        <i class="bi bi-person-circle" style="font-size: 5rem; color: rgba(255,255,255,0.3);"></i>
                                    </div>
                                @endif
                                <div class="vote-card-body">
                                    <h5 class="card-title">{{ $candidat->nom }} {{ $candidat->prenom ?? '' }}</h5>
                                    <p class="card-text text-muted">
                                        <small><i class="bi bi-bookmark"></i> {{ $candidat->filiere->nom ?? 'N/A' }}</small>
                                    </p>
                                    <div class="form-check form-check-lg mt-3">
                                        <input class="form-check-input vote-radio" type="radio" name="candidat_id" value="{{ $candidat->id }}" id="candidat{{ $candidat->id }}">
                                        <label class="form-check-label fw-semibold" for="candidat{{ $candidat->id }}">
                                            Sélectionner
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </label>
                    </div>
                @endforeach
            </div>

            <!-- Submit Button -->
            <div class="row">
                <div class="col-12">
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg btn-submit" id="submitBtn" disabled>
                            <i class="bi bi-check-circle"></i> Confirmer mon vote
                        </button>
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary btn-lg">
                            <i class="bi bi-arrow-left"></i> Annuler
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Footer -->
    <footer style="background-color: #1f2937; color: white; text-align: center; padding: 2rem; margin-top: 4rem;">
        <p>&copy; 2025 E-Vote - Système de Vote Électronique.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/votes/create.js') }}"></script>
</body>
</html>
