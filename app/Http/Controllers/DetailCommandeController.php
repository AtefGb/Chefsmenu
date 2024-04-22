<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailCommande;
use App\Models\Produit;
use App\Models\Formule;

class DetailCommandeController extends Controller
{
    public function index()
    {
        $detailCommandes = DetailCommande::all();
        $formules = Formule::all();
        $produits = Produit::all();

        return response()->json(['DetailCommandes' => $detailCommandes]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'prix_HT' => 'required|numeric',
            'tva' => 'required|numeric',
            'prix_TTC' => 'required|numeric',
            'quantité' => 'required|numeric',
            'produit_id' => 'required|numeric',
            'formule_id' => 'numeric'
        ]);

        $detailCommande = DetailCommande::create([
            'prix_HT' => $validated['prix_HT'],
            'tva' => $validated['tva'],
            'prix_TTC' => $validated['prix_TTC'],
            'quantité' => $validated['table_id'],
            'produit_id' => $validated['detailCommande_id'],
            'formule_id' => $validated['formule_id'],
        ]);
        if ($detailCommande) {
            return response()->json(['message' => ' Vorte commande a bien été crée.'], 201);
        }else {
            return response()->json(['message' => 'Une erreur est survenue lors de la création de votre commande.'], 500);
        }
    }

    public function show(detailCommande $detailCommande)
    {
        return  $detailCommande;
    }

    public function update(Request $request, DetailCommande $detailCommande)
    {
       

        $validated = $request->validate([
            'prix_HT' => 'required|numeric',
            'tva' => 'required|numeric',
            'prix_TTC' => 'required|numeric',
            'quantité' => 'required|numeric',
            'produit_id' => 'required|numeric',
            'formule_id' => 'numeric'
        ]);

        $detailCommande->prix_HT = $request->prix_HT();
        $detailCommande->tva = $request->tva();
        $detailCommande->prix_TTC = $request->prix_TTC();
        $detailCommande->quantité = $request->quantité ();
        $detailCommande->produit_id = $request->produit_id();
        $detailCommande->formule_id = $request->formule_id();
        $detailCommande->save();


        $detailCommande->update($validated);

        return response()->json(['message' => 'Votre commande a bien été modifié.', 'detailCommande' => $detailCommande]);
    }

    public function destroy(DetailCommande $detailCommande)
    {
        // $deletedDetailCommandes = DetailCommande::all();
        // return response()->json($deletedDetailCommandes);
    
    }
}
