<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailCommande;
use App\Models\Commande;
use App\Models\Table;


class CommandeController extends Controller
{
    public function index()
    {
        $commandes = Commande::all();
        $Detailscommandes = DetailCommande::all();
        $tables = Table::all();

        return response()->json(['commandes' => $commandes]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'prix_HT' => 'required|numeric',
            'tva' => 'required|numeric',
            'prix_TTC' => 'required|numeric',
            'table_id' => 'required|numeric',
            'detail_commande_id' => 'required|numeric'
        ]);

        $commande = Commande::create([
            'prix_HT' => $validated['prix_HT'],
            'tva' => $validated['tva'],
            'prix_TTC' => $validated['prix_TTC'],
            'table_id' => $validated['table_id'],
            'detail_commande_id' => $validated['detail_commande_id'],
        ]);
        if ($commande) {
            return response()->json(['message' => 'Votre commande n° '. $commande->id . ' a bien été crée.'], 201);
        }else {
            return response()->json(['message' => 'Une erreur est survenue lors de la création de votre commande.'], 500);
        }
    }

    public function show(Commande $commande)
    {
        return  $commande;
    }

    public function update(Request $request, Commande $commande)
    {
       
        $validated = $request->validate([
            'prix_HT' => 'required|numeric',
            'tva' => 'required|numeric',
            'prix_TTC' => 'required|numeric',
            'table_id' => 'required|numeric',
            'detail_commande_id' => 'required|numeric'
        ]);

        $commande->prix_HT = $request->prix_HT;
        $commande->tva = $request->tva;
        $commande->prix_TTC = $request->prix_TTC;
        $commande->table_id = $request->table_id;
        $commande->detail_commande_id = $request->detail_commande_id;
        $commande->save();


        $commande->update($validated);

        return response()->json(['message' => 'La commande n° '. $commande->id . ' a bien été modifié.', 'commande' => $commande]);
    }

    public function destroy(Commande $commande)
    {
        if (!$commande)
        return response()->json(['message' => 'La commande est introuvable'], 404);

        $commande->delete();

        return response()->json(['message' => 'La commande a bien été supprimé'], 200);
    
    }
}
