<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\User;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;



class RestaurantController extends Controller
{
    
    public function index()

    {
        $user = Auth::user();
        $restaurants = Restaurant::all();

        return response()->json(['restaurants' => $restaurants, 'user' => $user]);
    
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|min:1|max:50',
            'adresse' => 'required|string|min:2|max:255',
            'horaire' => 'required|date_format:H:i',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            if ($image->isValid()) {
                $imageName = time() . '.' . $image->extension();
                $image->move(public_path('images'), $imageName);
            } else {
                return response()->json(['message' => 'Une erreur est survenue lors du téléchargement de l\'image.'], 500);
            }
        } else {
            $imageName = null;
        }

        // Récupérer l'ID de l'utilisateur connecté
        $userId = Auth::id();

        $restaurant = new Restaurant();
        $restaurant->nom = $validated['nom'];
        $restaurant->adresse = $validated['adresse'];
        $restaurant->horaire = $validated['horaire'];
        $restaurant->image = $imageName;
        $restaurant->user_id = $userId;

        // Associer le restaurant à l'utilisateur connecté
        $restaurant->user_id = $userId;

        $restaurant->save();

        if ($restaurant) {
            return response()->json(['message' => 'Votre restaurant sous le nom de '. $restaurant->nom . ' a bien été crée.'], 201);
        }else {
            return response()->json(['message' => 'Une erreur est survenue lors de la création du restaurant.'], 500);
        } 
        
    }

    public function show(Restaurant $restaurant)
    {
        return  $restaurant;
    }

    public function update(Restaurant $restaurant, Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|min:1|max:50',
            'adresse' => 'required|string|min:2|max:255',
            'horaire' => 'required|date_format:H:i',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $userId = Auth::id();

         $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        $restaurant->nom = $validated['nom'];
        $restaurant->adresse = $request->adresse;
        $restaurant->horaire = $request->horaire;
        $restaurant->image = $request->image;
        $restaurant->user_id = $userId;
        $restaurant->save();

        $restaurant->update($validated);

        return response()->json(['message' => 'Votre restaurant sous le nom de '. $restaurant->nom . ' a bien été modifié.', 'restaurant' => $restaurant]);
    }

    public function destroy(Restaurant $restaurant)
    {
        if (!$restaurant)
        return response()->json(['message' => 'restaurant not found'], 404);

        $restaurant->delete();

        return response()->json(['message' => 'restaurant supprimé'], 200);
    
    }
}
