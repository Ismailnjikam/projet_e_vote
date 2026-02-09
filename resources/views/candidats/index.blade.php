<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candidats | E-Vote</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
                        <a class="nav-link" href="{{ route('scrutins.index') }}">Scrutins</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('candidats.index') }}">Candidats</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('filieres.index') }}">Filières</a>
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

    <div class="container py-4">
        <!-- Page Title -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="section-title">
                        <i class="bi bi-people"></i> Candidats
                    </h1>
                    <a href="{{ route('candidats.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Ajouter un candidat
                    </a>
                </div>
            </div>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="bi bi-check-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Candidats Grid -->
        <div class="row">
            @forelse($candidats as $candidat)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card shadow-sm h-100">
                        @if($candidat->photo)
                            <img src="{{ asset('storage/'.$candidat->photo) }}" class="card-img-top" style="height: 250px; object-fit: cover;" alt="{{ $candidat->nom }}">
                        @else
                            <div style="height: 250px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-person-circle" style="font-size: 5rem; color: rgba(255,255,255,0.3);"></i>
                            </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $candidat->nom }} {{ $candidat->prenom ?? '' }}</h5>
                            <p class="card-text text-muted">
                                <small>
                                    <i class="bi bi-bookmark"></i> {{ $candidat->filiere->nom ?? 'N/A' }}<br>
                                    <i class="bi bi-list-check"></i> {{ $candidat->scrutin->titre ?? 'N/A' }}
                                </small>
                            </p>
                        </div>
                        <div class="card-footer bg-light">
                            <div class="d-grid gap-2">
                                <a href="{{ route('candidats.edit', $candidat->id) }}" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil"></i> Modifier
                                </a>
                                <form action="{{ route('candidats.destroy', $candidat->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm w-100" onclick="return confirm('Êtes-vous sûr ?')">
                                        <i class="bi bi-trash"></i> Supprimer
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="bi bi-inbox" style="font-size: 3rem; color: #ccc;"></i>
                        <p class="text-muted mt-3">Aucun candidat enregistré.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Footer -->
    <footer style="background-color: #1f2937; color: white; text-align: center; padding: 2rem; margin-top: 4rem;">
        <p>&copy; 2025 E-Vote - Système de Vote Électronique.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
