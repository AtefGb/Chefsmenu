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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'description' => 'string|max:255',
            'restaurant_id' => 'required|numeric'
        ]);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        $produit = new Produit();
        $produit->nom = $validated['nom'];
        $produit->categorie = $validated['categorie'];
        $produit->prix_HT = $validated['prix_HT'];
        $produit->prix_TTC = $validated['prix_TTC'];
        $produit->tva = $validated['tva'];
        $produit->image = $imageName;
        $produit->restaurant_id = $validated['restaurant_id'];
        $produit->description = $validated['description'];
        $produit->save();
       
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'description' => 'nullable|string|max:255',
            'restaurant_id' => 'required|numeric'
        ]);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        $produit->nom = $validated['nom'];
        $produit->categorie = $validated['categorie'];
        $produit->prix_HT = $validated['prix_HT'];
        $produit->prix_TTC = $validated['prix_TTC'];
        $produit->tva = $validated['tva'];
        $produit->image = $imageName;
        $produit->restaurant_id = $validated['restaurant_id'];
        $produit->description = $validated['description'];
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
