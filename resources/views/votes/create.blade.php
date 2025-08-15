@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h2 class="text-center mb-5 fw-bold">Votez pour le scrutin : <span class="text-primary">{{ $scrutin->titre }}</span></h2>

    <form action="{{ route('votes.store', $scrutin->id) }}" method="POST">
        @csrf
        <div class="row g-4">
            @foreach($scrutin->candidats as $candidat)
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 vote-card h-100">
                        <img src="{{ asset('storage/' . $candidat->photo) }}" class="card-img-top vote-img" alt="{{ $candidat->nom }}">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-semibold">{{ $candidat->nom }}</h5>
                            <p class="card-text text-muted"><strong>Filière :</strong> {{ $candidat->filiere->nom }}</p>
                            <div class="form-check mt-auto">
                                <input class="form-check-input" type="radio" name="candidat_id" value="{{ $candidat->id }}" id="candidat{{ $candidat->id }}">
                                <label class="form-check-label fw-medium" for="candidat{{ $candidat->id }}">
                                    Sélectionner
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-5">
            <button type="submit" class="btn btn-primary btn-lg px-5 shadow-sm">Valider mon vote</button>
        </div>
    </form>
</div>

<style>
.vote-card {
    transition: transform 0.3s, box-shadow 0.3s;
    border-radius: 15px;
    overflow: hidden;
}

.vote-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}

.vote-img {
    height: 220px;
    object-fit: cover;
}

h2 span.text-primary {
    color: #0d6efd;
}

.btn-primary {
    background-color: #0d6efd;
    border: none;
    font-weight: 600;
    transition: background-color 0.3s, transform 0.2s;
}

.btn-primary:hover {
    background-color: #0b5ed7;
    transform: translateY(-2px);
}
</style>
@endsection
