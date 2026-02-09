<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Candidat | E-Vote</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/candidats/edit.css') }}">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top" style="background-color: #1f2937;">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('welcome') }}">
                <i class="bi bi-check-circle"></i> E-Vote
            </a>
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
                    <i class="bi bi-pencil-square"></i> Modifier Candidat
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

            <form action="{{ route('candidats.update', $candidat->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nom" class="form-label">
                        <i class="bi bi-person"></i> Nom
                    </label>
                    <input type="text" class="form-control" id="nom" name="nom" value="{{ $candidat->nom }}" required>
                </div>

                <div class="form-group">
                    <label for="prenom" class="form-label">
                        <i class="bi bi-person"></i> Prénom
                    </label>
                    <input type="text" class="form-control" id="prenom" name="prenom" value="{{ $candidat->prenom }}" required>
                </div>

                <div class="form-group">
                    <label for="filiere_id" class="form-label">
                        <i class="bi bi-bookmark"></i> Filière
                    </label>
                    <select class="form-select" id="filiere_id" name="filiere_id" required>
                        @foreach($filieres as $filiere)
                            <option value="{{ $filiere->id }}" {{ $filiere->id == $candidat->filiere_id ? 'selected' : '' }}>
                                {{ $filiere->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="scrutin_id" class="form-label">
                        <i class="bi bi-list-check"></i> Scrutin
                    </label>
                    <select class="form-select" id="scrutin_id" name="scrutin_id" required>
                        @foreach($scrutins as $scrutin)
                            <option value="{{ $scrutin->id }}" {{ $scrutin->id == $candidat->scrutin_id ? 'selected' : '' }}>
                                {{ $scrutin->titre ?? $scrutin->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="photo" class="form-label">
                        <i class="bi bi-image"></i> Photo
                    </label>
                    @if($candidat->photo)
                        <div>
                            <img src="{{ asset('storage/' . $candidat->photo) }}" class="photo-preview" alt="Photo">
                        </div>
                    @endif
                    <input type="file" class="form-control mt-2" id="photo" name="photo" accept="image/*">
                    <small class="form-text text-muted">Format : JPG, PNG, GIF (Max 2MB)</small>
                </div>

                <div class="d-grid gap-2 pt-3">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="bi bi-check-circle"></i> Mettre à jour
                    </button>
                    <a href="{{ route('candidats.index') }}" class="btn btn-secondary btn-lg">
                        <i class="bi bi-arrow-left"></i> Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@foreach($scrutins as $scrutin)
<option value="{{ $scrutin->id }}" {{ $scrutin->id == $candidat->scrutin_id ? 'selected' : '' }}>{{ $scrutin->nom }}</option>
@endforeach
</select>

<label for="photo">Photo :</label>
<input type="file" name="photo" id="photo" accept="image/*">
@if($candidat->photo)
<img src="{{ asset('storage/'.$candidat->photo) }}" alt="Photo actuelle">
@endif

<button type="submit">Mettre à jour</button>
</form>

</body>
</html>
