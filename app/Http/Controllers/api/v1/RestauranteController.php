<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurante;
use App\Http\Requests\Restaurante\RestauranteCreateRequest;

class RestauranteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Restaurante::paginate(30); 
        // Solos los eliminados 
        // return Restaurante::onlyTrashed()->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RestauranteCreateRequest $request)

    {
        $restaurante = new Restaurante($request->all());
        return $this->saveObject($restaurante);
       

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $restaurante = Restaurante::findOrFail($id);
        return $this->showResponse($restaurante);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $restaurante = Restaurante::findOrFail($id);
        return $this->updateObject($restaurante, $request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $res = Restaurante::findOrFail($id);
        // return [
        //     'data' => $res,
        //     'eliminado' => $res->delete()
        // ];
        $restaurante = Restaurante::findOrFail($id);
        return $this->deleteObject($restaurante);
    }
}
