<div class="card" style="width: 18rem;">
    <img src="{{ $book->image_url ?? 'https://via.placeholder.com/150' }}" class="card-img-top" alt="Couverture du livre">
    <div class="card-body">
        <h5 class="card-title">{{ $book->title }}</h5>
        <p class="card-text">
            <strong>Auteur :</strong> {{ $book->author }}<br>
            <strong>Année :</strong> {{ $book->year }}<br>
            <strong>Description :</strong> {{ $book->description }}
        </p>
        <a href="{{ route('books.show', $book->id) }}" class="btn btn-primary">Voir plus</a>
    </div>
</div>