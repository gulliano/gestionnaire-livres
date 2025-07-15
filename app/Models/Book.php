<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    //
    use HasFactory ; 

    protected $fillable = [
        'titre',
        'auteur',
        'annee',
        'statut',
        'favori',
        'note'
    ];

    protected $casts =[
        'favori' => 'boolean',
    ];
}
