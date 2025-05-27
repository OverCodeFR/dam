<?php

namespace App\Http\Controllers;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::all();
        return view('dashboard.index',compact(['items']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreItemRequest $request)
    {
        $item = new Item();
        $item->text = $request->validated('text');
        $item->save();
        return redirect()->route('dashboard');
    }

    /**
     *
     */
    public function check(UpdateItemRequest $request, $id)
    {
        $item = Item::findOrFail($id);
        $item->done = $request->has('done');
        $item->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateItemRequest $request, Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();
        return redirect()->back();
    }
}
