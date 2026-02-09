<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filières | E-Vote</title>
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
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('scrutins.index') }}">Scrutins</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('candidats.index') }}">Candidats</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('filieres.index') }}">Filières</a>
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
                        <i class="bi bi-bookmark"></i> Filières
                    </h1>
                    <a href="{{ route('filieres.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Ajouter une filière
                    </a>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th><i class="bi bi-hash"></i> ID</th>
                                <th><i class="bi bi-bookmark"></i> Nom</th>
                                <th style="width: 150px;"><i class="bi bi-gear"></i> Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($filieres as $filiere)
                                <tr>
                                    <td><span class="badge badge-primary">{{ $filiere->id }}</span></td>
                                    <td><strong>{{ $filiere->nom }}</strong></td>
                                    <td>
                                        <a href="{{ route('filieres.edit', $filiere->id) }}" class="btn btn-warning btn-sm">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('filieres.destroy', $filiere->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr ?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-4">
                                        <i class="bi bi-inbox" style="font-size: 2rem;"></i>
                                        <p>Aucune filière trouvée.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
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
