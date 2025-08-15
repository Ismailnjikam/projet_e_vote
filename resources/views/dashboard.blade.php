<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | E-Vote</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .scrutin-card, .candidat-card {
            border-radius: 10px;
            transition: transform 0.2s;
        }
        .scrutin-card:hover, .candidat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }
        .card-title {
            font-weight: bold;
        }
        .section-title {
            border-bottom: 2px solid #0d6efd;
            display: inline-block;
            margin-bottom: 20px;
        }
        .candidat-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px 10px 0 0;
        }
    </style>
</head>
<body>
<div class="container my-5">

    <h1 class="mb-4 text-center">Dashboard E-Vote</h1>

    <!-- Scrutins -->
    <h2 class="section-title">Scrutins en cours</h2>
    <div class="row">
        @forelse($scrutins as $scrutin)
            <div class="col-md-4 mb-4">
                <div class="card scrutin-card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ $scrutin->titre }}</h5>
                        <p class="card-text"><strong>Filière :</strong> {{ $scrutin->filiere->nom }}</p>
                        <p class="card-text"><strong>Dates :</strong> {{ $scrutin->date_debut }} → {{ $scrutin->date_fin }}</p>
                        @auth
                            <a href="{{ route('votes.create', $scrutin->id) }}" class="btn btn-primary w-100">Voter</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-secondary w-100">Se connecter</a>
                        @endauth
                    </div>
                </div>
            </div>
        @empty
            <p>Aucun scrutin en cours.</p>
        @endforelse
    </div>

    <!-- Candidats -->
    <h2 class="section-title mt-5">Candidats</h2>
    <div class="row">
        @forelse($candidats as $candidat)
            <div class="col-md-3 mb-4">
                <div class="card candidat-card shadow-sm">
                    <img src="{{ asset('storage/candidats/' . $candidat->photo) }}" alt="{{ $candidat->nom }}" class="candidat-img">
                    <div class="card-body">
                        <h5 class="card-title">{{ $candidat->nom }}</h5>
                        <p class="card-text"><strong>Filière :</strong> {{ $candidat->filiere->nom }}</p>
                        <p class="card-text"><strong>Scrutin :</strong> {{ $candidat->scrutin->titre }}</p>
                    </div>
                </div>
            </div>
        @empty
            <p>Aucun candidat enregistré.</p>
        @endforelse
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
