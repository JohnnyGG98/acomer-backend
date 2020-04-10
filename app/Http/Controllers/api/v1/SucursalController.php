<?php

namespace App\Http\Controllers\api\v1;

use App\Models\Sucursal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Sucursal\SucursalCollection;
use App\Http\Requests\Sucursal\SucursalCreateRequest;

class SucursalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new SucursalCollection(
            Sucursal::select([
                'id_restaurante',
                'horario_atencion',
                'numero',
                'direccion',
            ])->with('restaurante:nombre_comercial')
            ->paginate()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SucursalCreateRequest $request)
    {
        $suc = new Sucursal($request->all());
        return $this->saveObject($suc);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $suc = Sucursal::findOrFail($id);
        return $this->showResponse($suc);
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
        $suc = Sucursal::findOrFail($id);
        return $this->updateObject($suc, $request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $suc = Sucursal::findOrFail($id);
        return $this->deleteObject($suc);
    }
}
