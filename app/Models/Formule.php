<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formule extends Model
{
    protected $fillable = [
        'nom', 'prix_HT', 'tva', 'prix_TTC', 'restaurant_id'
    ];
}
