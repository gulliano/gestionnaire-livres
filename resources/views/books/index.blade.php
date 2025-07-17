@extends('layouts.app')

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
                    <x-book-card :book="$book" />
                    <div class="card">
                        <div class="card-body">
                            @if ($book->image)
                               <img src="{{$book->image_url}}" alt="{{$book->titre}}"> 
                            @else
                                <div><span>Pas d'image</span></div>
                            @endif
                            <h5 class="card-title"> {{ $book->titre }}
                                @if ($book->favori)
                                    <span class="badge bg-warning"> ⭐ Favori</span>
                                @endif
                            </h5>

                            <p class="card-text">
                                <strong>Auteur :</strong> {{ $book->author->name}} <br>
                                <strong>Année :</strong> {{ $book->annee}} <br>
                                <strong>Statut :</strong> {{ $book->statut->state }}
                                
                            </p>
                            @if ($book->note)
                                <p class="card-text"><small class="text-muted">{{ Str::limit ($book->note, 100) }}</small></p>
                            @endif
                            <div class="btn-group" role="group">
                                <a href="{{ route('books.show', $book) }}" class="btn btn-outline-primary btn-sm">Voir</a>
                                <a href="{{ route('books.edit', $book) }}" class="btn btn-outline-warning btn-sm">Modifier</a>
                                
                                <form action="{{ route('books.destroy', $book) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm" 
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce livre ?')">
                                        Supprimer
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