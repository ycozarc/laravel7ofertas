<?php

namespace App\Http\Controllers;

use App\Chollo;
use Illuminate\Http\Request;

class LikesController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
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
     * @param  \App\Chollo  $chollo
     * @return \Illuminate\Http\Response
     */
    public function show(Chollo $chollo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Chollo  $chollo
     * @return \Illuminate\Http\Response
     */
    public function edit(Chollo $chollo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Chollo  $chollo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chollo $chollo)
    {
        return auth()->user()->likes()->toggle($chollo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Chollo  $chollo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chollo $chollo)
    {
        //
    }
}
