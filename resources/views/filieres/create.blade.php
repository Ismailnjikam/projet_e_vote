<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Filière | E-Vote</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/filieres/create.css') }}">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top" style="background-color: #1f2937;">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('welcome') }}">
                <i class="bi bi-check-circle"></i> E-Vote
            </a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('filieres.index') }}">Retour</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="form-container">
            <div class="form-header">
                <h2 style="margin: 0;">
                    <i class="bi bi-plus-circle"></i> Ajouter une Filière
                </h2>
            </div>

            @if($errors->any())
                <div class="alert alert-danger">
                    <i class="bi bi-exclamation-circle"></i> Erreur lors de la création
                </div>
            @endif

            <form action="{{ route('filieres.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="nom" class="form-label">
                        <i class="bi bi-bookmark"></i> Nom de la filière
                    </label>
                    <input type="text" class="form-control" id="nom" name="nom" placeholder="Ex: Informatique" value="{{ old('nom') }}" required>
                </div>

                <div class="d-grid gap-2 pt-3">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="bi bi-check-circle"></i> Créer la filière
                    </button>
                    <a href="{{ route('filieres.index') }}" class="btn btn-secondary btn-lg">
                        <i class="bi bi-arrow-left"></i> Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
