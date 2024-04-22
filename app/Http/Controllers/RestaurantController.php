<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::all();

        return response()->json(['restaurants' => $restaurants]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|min:1|max:50',
            'adresse' => 'required|string|min:2|max:255',
            'horaire' => 'required|date_format:H:i',
            'image' => 'required|image|mimes:jpeg,jpg,png,gif'
        ]);
        
        $imageFile = $request->file('image');

        $imagePath = $imageFile->store('public/images');
        $imagePath = str_replace('public/', 'storage/', $imagePath);


        $restaurant = Restaurant::create([
            'nom' => $validated['nom'],
            'adresse' => $validated['adresse'],
            'horaire' => $validated['horaire'],
            'image' => $validated['image'],
            // 'image_path' => $imagePath
        ]);
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

    public function update(Request $request, Restaurant $restaurant)
    {
       

        $validated = $request->validate([
            'nom' => 'required|string|min:1|max:50',
            'adresse' => 'required|string|min:2|max:255',
            'horaire' => 'required|date_format:H:i',
            'image' => 'required|image|mimes:jpeg,jpg,png,gif'
        ]);

        $restaurant->nom = $request->nom();
        $restaurant->adresse = $request->adresse();
        $restaurant->horaire = $request->horaire();
        $restaurant->image = $request->image();
        $restaurant->save();
        
        // $imageFile = $request->file('image');

        // $imagePath = $imageFile->store('public/images');
        // $imagePath = str_replace('public/', 'storage/', $imagePath);

        $restaurant->update($validated);

        return response()->json(['message' => 'Votre restaurant sous le nom de '. $restaurant->nom . ' a bien été modifié.', 'restaurant' => $restaurant]);
    }

    public function destroy(Restaurant $restaurant)
    {
        // $deletedRestaurants = Restaurant::all();
        // return response()->json($deletedRestaurants);
    
    }
}
