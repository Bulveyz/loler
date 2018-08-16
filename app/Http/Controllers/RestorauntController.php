<?php

namespace App\Http\Controllers;

use App\Restoraunt;
use Illuminate\Http\Request;

class RestorauntController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Restoraunt  $restoraunt
     * @return \Illuminate\Http\Response
     */
    public function show(Restoraunt $restoraunt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Restoraunt  $restoraunt
     * @return \Illuminate\Http\Response
     */
    public function edit(Restoraunt $restoraunt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Restoraunt  $restoraunt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Restoraunt $restoraunt)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Restoraunt  $restoraunt
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restoraunt $restoraunt)
    {
        //
    }

    public function getRestoraunts()
    {
      return Restoraunt::select('id', 'brand')->get();
    }
}
