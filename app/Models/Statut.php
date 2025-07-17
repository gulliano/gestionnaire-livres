<?php

namespace App\Models;

use App\Models\Book;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Statut extends Model
{
    // ajouter le fillable pour le champ 'state
    protected $fillable = ['state'];

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
