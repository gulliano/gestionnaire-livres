@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">{{ $book->titre }}</h3>
                    @if ($book->favori)
                        <span class="badge bg-warning fs-6">⭐ Favori</span>
                    @endif
                </div>

                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-3"><strong>Auteur :</strong></div>
                        <div class="col-sm-9">{{ $book->auteur }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-3"><strong>Année :</strong></div>
                        <div class="col-sm-9">{{ $book->annee }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-3"><strong>Statut :</strong></div>
                        <div class="col-sm-9">
                            <span class="badge
                                @if ($book->statut === 'lu') bg-success
                                @elseif ($book->statut === 'en cours') bg-warning
                                @else bg-secondary
                                @endif">
                                {{ $book->statut }}
                            </span>
                        </div>
                    </div>

                    @if ($book->note)
                        <div class="row mb-3">
                            <div class="col-sm-3"><strong>Note :</strong></div>
                            <div class="col-sm-9"> {{ $book->note }}</div>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-sm-3"><strong>Ajouté le :</strong></div>
                        <div class="col-sm-9">{{ $book->created_at->format('d/m/Y à H:i') }}</div>
                    </div>
                </div>

                <div class="card-footer d-flex justify-content-between">
                    <a href="{{ route('books.index') }}" class="btn btn-secondary"> ← Retour à la liste</a>
                    <div>
                        <a href="{{ route('books.edit', $book) }}" class="btn btn-warning">Modifier</a>
                        <form action="{{ route('books.destroy', $book) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            
                            <button type="submit" class="btn btn-danger" 
                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce livre ?')">
                                Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection