<?php

namespace App\Http\Controllers;

use App\Models\Artigo;
use App\Http\Resources\Artigo as ArtigoResource;
use Illuminate\Http\Request;

class ArtigoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $artigos = Artigo::paginate();
        return ArtigoResource::collection($artigos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $artigo = new Artigo;
        $artigo->titulo = $request->input('titulo');
        $artigo->conteudo = $request->input('conteudo');
    
        if($artigo->save()){
          return new ArtigoResource($artigo);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Artigo  $artigo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $artigo = Artigo::findOrFail($id);
        return new ArtigoResource($artigo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Artigo  $artigo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Artigo $artigo)
    {
        $artigoAtualizado = Artigo::findOrFail($artigo->id);

        $artigoAtualizado->titulo = $request->titulo;
        $artigoAtualizado->conteudo = $request->conteudo;
    
        if( $artigoAtualizado->save() ){
          return new ArtigoResource( $artigoAtualizado );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Artigo  $artigo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Artigo $artigo)
    {
        $artigo = Artigo::findOrFail($artigo->id);
        if($artigo->delete()){
          return new ArtigoResource($artigo);
        }
    }
}
