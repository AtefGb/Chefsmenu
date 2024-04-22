<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    protected $fillable = [
        'nom', 'categorie', 'prix_HT', 'tva', 'prix_TTC', 'restaurant_id'
    ];
}

