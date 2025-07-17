<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Statut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    //
    public function index() {
        $books = Book::all() ;
        return view('books.index', compact('books')) ;
    }

    //Methode create et store
    public function create() {

        $authors = Author::all() ; // récupération de tout les Auteurs
        $statuts = Statut::all() ; 
       

        return view('books.create',compact(['authors', 'statuts']));
    }

    public function store(Request $request){
       $validated =  $request->validate([
            'titre' => 'required|string|max:255',
            'author_id' => 'required',
            'annee' => 'required|integer|min:1000|max:' . date('Y'),
            'statut_id' => 'required',
            'note' => 'nullable|string'
        ]);

        $dataSave = $request->all() ;

        // Début de la gestion de l'upload du l'image


       
        // vérification l'existance du fichier
        if ($request->hasFile('image')) {
           
            $image = $request->file('image') ; // préparation de l'image
             
            $imageName = time() .'_'. $image->getClientOriginalName() ; // changer le nom de l'image
           
            $image->storeAs('books' , $imageName) ; // enregistrement sur le serveur
        //dd($image->storeAs('books' , $imageName)) ; 
            $dataSave['image'] = $imageName ;
        }


        Book::create( $dataSave) ;
        
       

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
            'statut_id' => 'required',
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


