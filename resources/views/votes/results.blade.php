<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats - {{ $scrutin->titre }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f7fa;
            font-family: 'Segoe UI', sans-serif;
        }
        .results-card {
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            padding: 30px;
            background-color: #fff;
            margin-top: 50px;
        }
        .candidat-bar {
            height: 30px;
            border-radius: 20px;
            transition: width 0.5s;
        }
        .candidat-card {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="results-card mx-auto col-md-8">
        <h2 class="text-center mb-4">Résultats du scrutin : {{ $scrutin->titre }}</h2>
        <p class="text-center mb-4"><strong>Filière :</strong> {{ $scrutin->filiere->nom }}</p>

        @foreach($scrutin->candidats as $candidat)
            @php
                $votes = $candidat->votes()->count();
                $totalVotes = $scrutin->votes()->count();
                $percentage = $totalVotes > 0 ? round(($votes / $totalVotes) * 100) : 0;
            @endphp
            <div class="candidat-card">
                <h5>{{ $candidat->nom }} ({{ $votes }} votes)</h5>
                <div class="progress">
                    <div class="progress-bar candidat-bar bg-primary" role="progressbar" style="width: {{ $percentage }}%;" aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100">
                        {{ $percentage }}%
                    </div>
                </div>
            </div>
        @endforeach

        <a href="{{ route('dashboard') }}" class="btn btn-secondary w-100 mt-4">Retour au Dashboard</a>
    </div>
</div>
</body>
</html>
