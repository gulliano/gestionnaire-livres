@extends('layouts.app')

@section('title', 'Ajouter un Livre')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0">Ajouter un nouveau livre</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="titre" class="form-label">Titre *</label>
                        <input type="text" class="form-control @error('titre') is-invalid @enderror" 
                               id="titre" name="titre" value="{{ old('titre') }}" required>
                        @error('titre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image *</label>
                        <input type="file" class="form-control  is-invalid " name="image" >
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="mb-3">
                        <label for="auteur" class="form-label">Auteur *</label>
                      <select name="author_id" >
                            <option value="">--- Selectionnez un Auteur ---</option>
                            @foreach ($authors as $author )
                                <option value="{{$author['id']}}">{{$author['name']}}</option>
                            @endforeach
                            

                      </select>
                        @error('author_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="annee" class="form-label">Année de publication *</label>
                        <input type="number" class="form-control @error('annee') is-invalid @enderror" 
                               id="annee" name="annee" value="{{ old('annee') }}" min="1000" max="{{ date('Y') }}" required>
                        @error('annee')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="statut" class="form-label">Statut *</label>
                        <select class="form-select @error('statut_id') is-invalid @enderror"  name="statut_id" required>
                            <option value="">Choisir un statut</option>
                            @foreach ($statuts as $statut )
                                <option value="{{$statut['id']}}">{{$statut['state']}}</option>
                            @endforeach
                         
                           
                        </select>
                        @error('statut_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="favori" name="favori" value="1" {{ old('favori') ? 'checked' : '' }}>
                        <label class="form-check-label" for="favori">
                            Marquer comme favori
                        </label>
                    </div>

                    <div class="mb-3">
                        <label for="note" class="form-label">Note personnelle</label>
                        <textarea class="form-control @error('note') is-invalid @enderror" 
                                  id="note" name="note" rows="3" placeholder="Vos impressions sur ce livre...">{{ old('note') }}</textarea>
                        @error('note')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('books.index') }}" class="btn btn-secondary me-md-2">Annuler</a>
                        <button type="submit" class="btn btn-primary">Ajouter le livre</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection