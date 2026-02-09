<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scrutins - config{{'app.name'}}</title>
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
                    @if(Auth::user()->role === 'admin')
                     <li class="nav-item">
                        <a class="nav-link" href="{{route('admin.dashboard')}}">Dashboard</a>
                     </li>
                    @elseif(Auth::user()->role === 'votant')
                      <li class="nav-item">
                        <a class="nav-link" href="{{route('votant.dashboard')}}">Dashboard</a>
                      </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('scrutins.index') }}">Scrutins</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('candidats.index') }}">Candidats</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('filieres.index') }}">Filières</a>
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
                        <i class="bi bi-list-check"></i> Scrutins
                    </h1>
                    <a href="{{ route('scrutins.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Ajouter un scrutin
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

        <!-- Table -->
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th><i class="bi bi-hash"></i> ID</th>
                                <th><i class="bi bi-bookmark"></i> Nom</th>
                                <th><i class="bi bi-diagram-3"></i> Filière</th>
                                <th><i class="bi bi-calendar"></i> Début</th>
                                <th><i class="bi bi-calendar"></i> Fin</th>
                                <th><i class="bi bi-hand-index"></i> Votes</th>
                                <th style="width: 150px;"><i class="bi bi-gear"></i> Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($scrutins as $scrutin)
                                <tr>
                                    <td><span class="badge badge-primary">{{ $scrutin->id }}</span></td>
                                    <td><strong>{{ $scrutin->nom ?? 'N/A' }}</strong></td>
                                    <td>{{ $scrutin->filiere->nom ?? 'N/A' }}</td>
                                    <td>{{ $scrutin->date_debut ?? '-' }}</td>
                                    <td>{{ $scrutin->date_fin ?? '-' }}</td>
                                    <td>
                                        <span class="badge badge-success">{{ $scrutin->votes->count() ?? 0 }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('scrutins.edit', $scrutin->id) }}" class="btn btn-warning btn-sm" title="Modifier">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('scrutins.destroy', $scrutin->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Supprimer" onclick="return confirm('Êtes-vous sûr ?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">
                                        <i class="bi bi-inbox" style="font-size: 2rem;"></i>
                                        <p>Aucun scrutin trouvé.</p>
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
