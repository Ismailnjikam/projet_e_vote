<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Candidat | E-Vote</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/candidats/create.css') }}">
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
                        <a class="nav-link" href="{{ route('candidats.index') }}">Retour</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="form-container">
            <div class="form-header">
                <h2 style="margin: 0;">
                    <i class="bi bi-person-plus"></i> Ajouter un Candidat
                </h2>
            </div>

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show">
                    <i class="bi bi-exclamation-circle"></i> <strong>Erreur :</strong>
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('candidats.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="nom" class="form-label">
                        <i class="bi bi-person"></i> Nom
                    </label>
                    <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom" name="nom" value="{{ old('nom') }}" required>
                    @error('nom')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="prenom" class="form-label">
                        <i class="bi bi-person"></i> Prénom
                    </label>
                    <input type="text" class="form-control @error('prenom') is-invalid @enderror" id="prenom" name="prenom" value="{{ old('prenom') }}" required>
                    @error('prenom')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="filiere_id" class="form-label">
                        <i class="bi bi-bookmark"></i> Filière
                    </label>
                    <select class="form-select @error('filiere_id') is-invalid @enderror" id="filiere_id" name="filiere_id" required>
                        <option value="">-- Sélectionner une filière --</option>
                        @foreach($filieres as $filiere)
                            <option value="{{ $filiere->id }}" {{ old('filiere_id') == $filiere->id ? 'selected' : '' }}>
                                {{ $filiere->nom }}
                            </option>
                        @endforeach
                    </select>
                    @error('filiere_id')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="scrutin_id" class="form-label">
                        <i class="bi bi-list-check"></i> Scrutin
                    </label>
                    <select class="form-select @error('scrutin_id') is-invalid @enderror" id="scrutin_id" name="scrutin_id" required>
                        <option value="">-- Sélectionner un scrutin --</option>
                        @foreach($scrutins as $scrutin)
                            <option value="{{ $scrutin->id }}" {{ old('scrutin_id') == $scrutin->id ? 'selected' : '' }}>
                                {{ $scrutin->titre ?? $scrutin->nom }}
                            </option>
                        @endforeach
                    </select>
                    @error('scrutin_id')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="photo" class="form-label">
                        <i class="bi bi-image"></i> Photo
                    </label>
                    <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" name="photo" accept="image/*">
                    <small class="form-text text-muted">Format : JPG, PNG, GIF (Max 2MB)</small>
                    @error('photo')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid gap-2 pt-3">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="bi bi-check-circle"></i> Ajouter le candidat
                    </button>
                    <a href="{{ route('candidats.index') }}" class="btn btn-secondary btn-lg">
                        <i class="bi bi-arrow-left"></i> Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer style="background-color: #1f2937; color: white; text-align: center; padding: 2rem; margin-top: 4rem;">
        <p>&copy; 2025 E-Vote - Système de Vote Électronique.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
