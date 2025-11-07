<?php

namespace App\Http\Controllers;

use App\Models\item;
use App\Http\Requests\StoreitemRequest;
use App\Http\Requests\UpdateitemRequest;
use App\Http\Resources\ItemResource;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = item::with('category')->get();
        return ItemResource::collection($items);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreitemRequest $request)
    {
        $items = new Item();
        $items->name = $request->name;
         $items->save();

         return response()->json([
        'message' => ' New item is added',
    ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateitemRequest $request, item $item)
    {
        $item->name = $request->name;
        $item->update();

          return response()->json([
            'message' => 'New item is updated',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(item $item)
    {

     if ($item) {
             $item->delete();
        }
        return response()->json([
            'message' => 'Category is deleted',
        ]);
    }
}
