<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Formule;

class FormuleController extends Controller
{
    public function index()
    {
        $formules = Formule::all();
        $restaurant = Restaurant::all();

        return response()->json(['formules' => $formules]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|min:1|max:155',
            'prix_HT' => 'required|numeric',
            'tva' => 'required|numeric',
            'prix_TTC' => 'required|numeric',
            'restaurant_id' => 'required|numeric'
        ]);

        $formule = Formule::create([
            'nom' => $validated['nom'],
            'prix_HT' => $validated['prix_HT'],
            'tva' => $validated['tva'],
            'prix_TTC' => $validated['prix_TTC'],
            'restaurant_id' => $validated['restaurant_id'],
        ]);
        if ($formule) {
            return response()->json(['message' => 'Votre formule sous le nom de '. $formule->nom . ' a bien été crée.'], 201);
        }else {
            return response()->json(['message' => 'Une erreur est survenue lors de la création du formule.'], 500);
        }
    }

    public function show(Formule $formule)
    {
        return  $formule;
    }

    public function update(Request $request, Formule $formule)
    {
       

        $validated = $request->validate([
            'nom' => 'required|string|min:1|max:155',
            'prix_HT' => 'required|numeric',
            'tva' => 'required|numeric',
            'prix_TTC' => 'required|numeric',
            'restaurant_id' => 'required|numeric'
        ]);

        $formule->nom = $request->nom();
        $formule->prix_HT = $request->prix_HT();
        $formule->tva = $request->tva();
        $formule->prix_TTC = $request->prix_TTC();
        $formule->restaurant_id = $request->restaurant_id();
        $formule->save();


        $formule->update($validated);

        return response()->json(['message' => 'Votre formule sous le nom de '. $formule->nom . ' a bien été modifié.', 'formule' => $formule]);
    }

    public function destroy(Formule $formule)
    {
        // $deletedproduits = produit::all();
        // return response()->json($deletedproduits);
    
    }
}
