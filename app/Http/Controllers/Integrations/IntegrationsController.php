<?php

namespace App\Http\Controllers;

use App\Models\Integrations\Integrations;
use Illuminate\Http\Request;

class IntegrationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Integrations::select()->get()->all();
        $integrations = json_decode($data, TRUE);

        return view('integrations.integrations', compact('integrations'));
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

    public function saveIntegration($name){
        $post = Integrations::create(['name' => $name, 'status' => 1]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Integrations\Integrations  $integrations
     * @return \Illuminate\Http\Response
     */
    public function show(Integrations $integrations)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Integrations\Integrations  $integrations
     * @return \Illuminate\Http\Response
     */
    public function edit(Integrations $integrations)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Integrations\Integrations  $integrations
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Integrations $integrations)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Integrations\Integrations  $integrations
     * @return \Illuminate\Http\Response
     */
    public function destroy(Integrations $integrations)
    {
        //
    }
}
