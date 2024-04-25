<?php

namespace App\Http\Controllers;
use App\Models\Produit;
use App\Models\Restaurant;

use Illuminate\Http\Request;

class ProduitController extends Controller
{
    public function index()
    {
        $produits = Produit::all();
        $restaurant = Restaurant::all();

        return response()->json(['produits' => $produits, 'restaurant' => $restaurant]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|min:1|max:155',
            'categorie' => 'required|in:entrée,plat,dessert,boisson',
            'prix_HT' => 'required|numeric',
            'tva' => 'required|numeric',
            'prix_TTC' => 'required|numeric',
            'restaurant_id' => 'required|numeric'
        ]);

        $produit = Produit::create([
            'nom' => $validated['nom'],
            'categorie' => $validated['categorie'],
            'prix_HT' => $validated['prix_HT'],
            'tva' => $validated['tva'],
            'prix_TTC' => $validated['prix_TTC'],
            'restaurant_id' => $validated['restaurant_id'],
        ]);
        if ($produit) {
            return response()->json(['message' => 'Votre produit sous le nom de '. $produit->nom . ' a bien été crée.'], 201);
        }else {
            return response()->json(['message' => 'Une erreur est survenue lors de la création du produit.'], 500);
        }
    }

    public function show(Produit $produit)
    {
        return  $produit;
    }

    public function update(Request $request, Produit $produit)
    {
       

        $validated = $request->validate([
            'nom' => 'required|string|min:1|max:155',
            'categorie' => 'required|in:entrée,plat,dessert,boisson',
            'prix_HT' => 'required|numeric',
            'tva' => 'required|numeric',
            'prix_TTC' => 'required|numeric',
            'restaurant_id' => 'required|numeric'
        ]);

        $produit->nom = $request->nom;
        $produit->categorie = $request->categorie;
        $produit->prix_HT = $request->prix_HT;
        $produit->tva = $request->tva;
        $produit->prix_TTC = $request->prix_TTC;
        $produit->restaurant_id = $request->restaurant_id;
        $produit->save();


        $produit->update($validated);

        return response()->json(['message' => 'Votre produit sous le nom de '. $produit->nom . ' a bien été modifié.', 'produit' => $produit]);
    }

    public function destroy(produit $produit)
    {
        if (!$produit)
        return response()->json(['message' => 'produit not found'], 404);

        $produit->delete();

        return response()->json(['message' => 'produit supprimé'], 200);
    
    }
}
