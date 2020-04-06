<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;
use App\Models\Administrador;
use App\Http\Controllers\Controller;
use App\Http\Resources\Administrador\AdministradorCollection;
use App\Http\Requests\Administrador\AdministradorCreateRequest;

class AdministradorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new AdministradorCollection(
            Administrador::select([
                'id',
                'id_usuario'
            ])->with('usuario:id,nombre,correo')
            ->paginate()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdministradorCreateRequest $request)
    {
        $adm = new Administrador($request->all());
        return $this->saveObject($adm);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $adm = Administrador::findOrFail($id);
        return $this->showReponse($adm);
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
        $adm = Administrador::findOrFail($id);
        return $this->updateObject($adm, $request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $adm = Administrador::findOrFail($id);
        return $this->deleteObject($adm);
    }
}
