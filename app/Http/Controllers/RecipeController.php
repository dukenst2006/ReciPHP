<?php

namespace App\Http\Controllers;

use App\Recipe;
use App\RecipeIngredient;
use App\RecipeIngredientList;
use App\RecipeStep;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recipes = Recipe::with([
            "ingredientLists.ingredients",
            "ratings",
            "steps",
            "favorites",
            "tags",
            "user",
        ])->get();
        return response()->json($recipes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = \DB::transaction(function() use($request) {
            $recipe = new Recipe($request->all());
            $recipe->user_id = \Auth::id();
            $recipe->save();

            $ingredientLists = $request->get("ingredientLists");
            foreach($ingredientLists as $list) {
                if($list["name"] === null) {
                    $list["name"] = "";
                }
                $ingredientList = new RecipeIngredientList($list);
                $ingredientList->recipe_id = $recipe->id;
                $ingredientList->save();

                foreach($list["ingredients"] as $ingredient) {
                    $ingr = new RecipeIngredient($ingredient);
                    $ingr->recipe_ingredient_list_id = $ingredientList->id;
                    $ingr->save();
                }
            }

            $steps = $request->get("steps");
            foreach($steps as $step) {
                if($step["title"] === null) {
                    $step["title"] = "";
                }
                $recipeStep = new RecipeStep($step);
                $recipeStep->recipe_id = $recipe->id;
                $recipeStep->save();
            }

            return $recipe->id;
        });

        return response()->json($id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function show(Recipe $recipe)
    {
        $recipe = Recipe::with([
            "ingredientLists.ingredients",
            "ratings",
            "steps",
            "favorites",
            "tags",
            "user",
        ])->find($recipe->id);
        return response()->json($recipe);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function edit(Recipe $recipe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recipe $recipe)
    {
        \Log::info(json_encode($request));

        \DB::transaction(function() use($request) {
            $steps = $request->get("steps");
        });

        return response()->json();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     * @throws AuthorizationException
     */
    public function destroy(Recipe $recipe)
    {
        if(!\Auth::user()->admin && \Auth::user()->id !== $recipe->user->id) {
            throw new AuthorizationException();
        }

        $recipe->delete();

        return response()->json();
    }

    public function newest() {
        $recipe = Recipe::orderBy("updated_at", "desc")->first();
        return $recipe->updated_at;
    }
}
