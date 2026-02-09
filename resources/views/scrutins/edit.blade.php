<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Scrutin | E-Vote</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/scrutins/edit.css') }}">
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
                        <a class="nav-link" href="{{ route('scrutins.index') }}">Retour</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="form-container">
            <div class="form-header">
                <h2 style="margin: 0;">
                    <i class="bi bi-pencil-square"></i> Modifier Scrutin
                </h2>
            </div>

            <form action="{{ route('scrutins.update', $scrutin->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nom" class="form-label">
                        <i class="bi bi-list-check"></i> Nom du scrutin
                    </label>
                    <input type="text" class="form-control" id="nom" name="nom" value="{{ $scrutin->nom }}" required>
                </div>

                <div class="form-group">
                    <label for="titre" class="form-label">
                        <i class="bi bi-pencil"></i> Titre du scrutin
                    </label>
                    <input type="text" class="form-control" id="titre" name="titre" value="{{ $scrutin->titre ?? '' }}">
                </div>

                <div class="form-group">
                    <label for="filiere_id" class="form-label">
                        <i class="bi bi-bookmark"></i> Filière
                    </label>
                    <select class="form-select" id="filiere_id" name="filiere_id" required>
                        @foreach($filieres as $filiere)
                            <option value="{{ $filiere->id }}" @if($scrutin->filiere_id == $filiere->id) selected @endif>
                                {{ $filiere->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="date_debut" class="form-label">
                                <i class="bi bi-calendar-event"></i> Date de début
                            </label>
                            <input type="date" class="form-control" id="date_debut" name="date_debut" value="{{ $scrutin->date_debut }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="date_fin" class="form-label">
                                <i class="bi bi-calendar-check"></i> Date de fin
                            </label>
                            <input type="date" class="form-control" id="date_fin" name="date_fin" value="{{ $scrutin->date_fin }}" required>
                        </div>
                    </div>
                </div>

                <div class="d-grid gap-2 pt-3">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="bi bi-check-circle"></i> Mettre à jour
                    </button>
                    <a href="{{ route('scrutins.index') }}" class="btn btn-secondary btn-lg">
                        <i class="bi bi-arrow-left"></i> Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
