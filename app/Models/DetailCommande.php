<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailCommande extends Model
{
    protected $fillable = [
         'prix_HT', 'tva', 'prix_TTC', 'quantité', 'formule_id'
    ];
}
