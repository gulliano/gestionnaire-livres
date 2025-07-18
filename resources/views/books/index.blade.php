@extends('layouts.book')

@section('title', 'Mes Livres')

@section('content')
    <div class="d-flex justify-content-betwen align-items-center mb-4">
        <h1>Mes Livres</h1>
        <a href="{{ route('books.create')}}" class="btn btn-primary">Ajouter un livre</a>
    </div>

    @if ($books->isEmpty())
        <div class="alert alert-info">
            <h4>Aucun livre dans votre bibliothèque</h4>
            <p>Commencez par ajouter votre premier livre !</p>
        </div>
        
    @else
        <div class="row">
            @foreach ($books as $book)
                <div class="col-md-4 mb-4">
                  

<div class="card shadow-sm rounded-3 mb-3">
    <div class="card-body">
        @if ($book->image)
            <img src="{{ $book->image_url }}" alt="{{ $book->titre }}" class="card-img-top mb-3 rounded">
        @else
            <div class="mb-3 text-center text-muted">
                <i class="bi bi-image" style="font-size: 2rem;"></i>
                <div>Pas d'image</div>
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-2">
            <h5 class="card-title mb-0">{{ $book->titre }}</h5>
            <form action="{{ route('books.show', $book) }}" method="POST">
                @csrf
                <button type="submit" class="icon-button" title="Favori">
                    <i class="bi {{ $book->favori ? 'bi-star-fill text-warning' : 'bi-star text-secondary' }}"></i>
                </button>
            </form>
        </div>

        <p class="card-text">
            <strong>Auteur :</strong> {{ $book->author->name }}<br>
            <strong>Année :</strong> {{ $book->annee }}<br>
            <strong>Statut :</strong> {{ $book->statut->state }}
        </p>

        @if ($book->note)
            <p class="card-text">
                <small class="text-muted">{{ Str::limit($book->note, 100) }}</small>
            </p>
        @endif

        <div class="d-flex gap-3 mt-2">
            <a href="{{ route('books.show', $book) }}" class="icon-button" title="Voir">
                <i class="bi bi-eye text-primary"></i>
            </a>
            <a href="{{ route('books.edit', $book) }}" class="icon-button" title="Modifier">
                <i class="bi bi-pencil text-warning"></i>
            </a>
            <form action="{{ route('books.destroy', $book) }}" method="POST" onsubmit="return confirm('Supprimer ce livre ?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="icon-button" title="Supprimer">
                    <i class="bi bi-trash text-danger"></i>
                </button>
            </form>
        </div>
    </div>
</div>

                    
                   
                </div>
            @endforeach
        </div>
    @endif
@endsection