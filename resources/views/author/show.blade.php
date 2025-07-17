@extends('layouts.app')

@section('titre', 'Livres de ' . $author->nom)

@section('content')
<div class="row">
    <div class="col-12">
        <!-- En-tête de la page -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h2 mb-1">
                    👤 {{ $author->nom }}
                </h1>
                <p class="text-muted mb-0">
                    {{ $author->books->count() }} livre(s) dans votre bibliothèque
                </p>
            </div>
            <div>
                <a href="{{ route('books.index') }}" class="btn btn-outline-secondary">
                    ← Retour à la bibliothèque
                </a>
            </div>
        </div>

        <!-- Liste des livres -->
        @if($author->books->isEmpty())
            <div class="text-center py-5">
                <div class="mb-4">
                    📚 <span class="display-1 text-muted">📖</span>
                </div>
                <h3 class="text-muted">Aucun livre trouvé</h3>
                <p class="text-muted">Cet auteur n'a encore aucun livre dans votre bibliothèque.</p>
                <a href="{{ route('books.create') }}" class="btn btn-primary">
                    ➕ Ajouter un livre
                </a>
            </div>
        @else
            <div class="row">
                @foreach($author->books as $book)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100 shadow-sm">
                            <!-- Badge statut et favori -->
                            <div class="card-header bg-transparent border-0 pb-0">
                                <div class="d-flex justify-content-between align-items-start">
                                    <span class="badge 
                                        @if($book->statut === 'lu') bg-success
                                        @elseif($book->statut === 'en cours') bg-warning text-dark
                                        @else bg-info
                                        @endif">
                                        @if($book->statut === 'lu') 
                                            ✅ Lu
                                        @elseif($book->statut === 'en cours') 
                                            📖 En cours
                                        @else 
                                            📚 À lire
                                        @endif
                                    </span>
                                    @if($book->favori)
                                        <span class="text-warning fs-5">⭐</span>
                                    @endif
                                </div>
                            </div>

                            <div class="card-body pt-2">
                                <h5 class="card-title">{{ $book->titre }}</h5>
                                <p class="card-text text-muted mb-2">
                                    📅 {{ $book->annee }}
                                </p>
                                
                                @if($book->note)
                                    <p class="card-text">
                                        <small class="text-muted">
                                            {{ Str::limit($book->note, 100) }}
                                        </small>
                                    </p>
                                @endif
                            </div>

                            <div class="card-footer bg-transparent border-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('books.show', $book) }}" 
                                           class="btn btn-outline-primary"
                                           title="Voir les détails">
                                            👁️ Voir
                                        </a>
                                        <a href="{{ route('books.edit', $book) }}" 
                                           class="btn btn-outline-secondary"
                                           title="Modifier">
                                            ✏️ Modifier
                                        </a>
                                    </div>
                                    
                                    <form action="{{ route('books.destroy', $book) }}" 
                                          method="POST" 
                                          style="display: inline;"
                                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce livre ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-outline-danger btn-sm"
                                                title="Supprimer">
                                            🗑️
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination si nécessaire -->
            @if($author->books instanceof \Illuminate\Pagination\LengthAwarePaginator)
                <div class="d-flex justify-content-center mt-4">
                    {{ $author->books->links() }}
                </div>
            @endif
        @endif

        <!-- Bouton d'action flottant pour ajouter un livre -->
        <div class="position-fixed bottom-0 end-0 m-4">
            <a href="{{ route('books.create') }}" 
               class="btn btn-primary btn-lg rounded-circle shadow"
               title="Ajouter un nouveau livre"
               style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                ➕
            </a>
        </div>
    </div>
</div>
@endsection