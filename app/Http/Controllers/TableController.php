<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Table;
use App\Models\Restaurant;

class TableController extends Controller
{
    public function index()
    {
        $tables = Table::all();
        $restaurant = Restaurant::all();

        return response()->json(['tables' => $tables]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'num_table' => 'required|string|min:1|max:155',
            'restaurant_id' => 'required|numeric'
        ]);

        $table = Table::create([
            'num_table' => $validated['num_table'],
            'restaurant_id' => $validated['restaurant_id'],
        ]);
        if ($table) {
            return response()->json(['message' => 'Votre table sous le nom de '. $table->num_table . ' a bien été crée.'], 201);
        }else {
            return response()->json(['message' => 'Une erreur est survenue lors de la création de la table.'], 500);
        }
    }

    public function show(Table $table)
    {
        return  $table;
    }

    public function update(Request $request, Table $table)
    {
       

        $validated = $request->validate([
            'num_table' => 'required|string|min:1|max:155',
            'restaurant_id' => 'required|numeric'
        ]);

        $table->num_table = $request->num_table;
        $table->restaurant_id = $request->restaurant_id;
        $table->save();


        $table->update($validated);

        return response()->json(['message' => 'Votre table n° '. $table->num_table . ' a bien été modifié.', 'table' => $table]);
    }

    public function destroy(Table $table)
    {
        if (!$table)
        return response()->json(['message' => 'table not found'], 404);

        $table->delete();

        return response()->json(['message' => 'table supprimé'], 200);
    
    }
}
