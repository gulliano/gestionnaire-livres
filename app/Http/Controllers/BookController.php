<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    //
    public function index() {
        $books = Book::all() ;
        return view('books.index', compact('books')) ;
    }

    //Methode create et store
    public function create() {
        return view('books.create');
    }

    public function store(Request $request){
        $request->validate([
            'titre' => 'required|string|max:255',
            'auteur' => 'required|string|max:255',
            'annee' => 'required|integer|min:1000|max:' . date('Y'),
            'statut' => 'required|in:lu,à lire, en cours',
            'note' => 'nullable|string'
        ]);
        
        Book::create([
            'titre' => $request->titre,
            'auteur' => $request->auteur,
            'annee' => $request->annee,
            'statut' => $request->statut,
            'favori' => $request->has('favori'),
            'note' => $request->note,
        ]);

        // Redirection
        return redirect()->route('books.index')
            ->with('success', 'Livre ajouté avec succès !');
    }

    public function show(Book $book){
        return view('books.show', compact('book'));
    }

    public function edit(Book $book){
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, Book $book){
        $request->validate([
            'titre' => 'required|string|max:255',
            'auteur' => 'required|string|max:255',
            'annee' => 'required|integer|min:1000|max:' . date('Y'),
            'statut' => 'required|in:lu,à lire,en cours',
            'note' => 'nullable|string'

        ]);

        $book->update([
            'titre' => $request->titre,
            'auteur' => $request->auteur,
            'annee' => $request->annee,
            'statut' => $request->statut,
            'favori' => $request->has('favori'),
            'note' => $request->note
        ]);

        return redirect()->route('books.index')
            ->with('success', 'Livre modifié avec succès !');
    }

    public function destroy(Book $book){
        $book->delete();
    
        return redirect()->route('books.index')
            ->with('success', 'Livre supprimé avec succès !');
    }   
}


