<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MenuDia;
use App\Http\Requests\MenuDia\MenuDiaCreateRequest;
use App\Http\Requests\MenuDia\MenuDiaUpdateRequest;
use App\Http\Resources\MenuDia\MenuDiaCollection;

class MenuDiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new MenuDiaCollection(
            MenuDia::select([
                'id',
                'descripcion',
                'precio',
                'id_restaurante'

            ])->with('restaurante:id,nombre_comercial')
                ->paginate()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuDiaCreateRequest $request)
    {
        $menudia = new MenuDia($request->all());
        return $this->saveObject($menudia);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $menudia = MenuDia::findOrFail($id);
        return $this->showResponse($menudia);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MenuDiaUpdateRequest $request, $id)
    {
        $menudia = MenuDia::findOrFail($id);
        return $this->updateObject($menudia, $request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menudia = MenuDia::findOrFail($id);
        return $this->deleteObject($menudia);
    }

    public function restaurante($id)
    {
        $res = MenuDia::select([
            'id',
            'descripcion',
            'precio',
            'menu_dia',
            'fechas'
        ])->where('id_restaurante', '=', $id)
        ->get();
        return $this->showQuery($res);
    }

    public function getFirstRestaurante($id) 
    {
        $res = MenuDia::select([
            'id',
            'descripcion',
            'precio',
            'menu_dia',
            'fechas'
        ])->where('id_restaurante', '=', $id)
        ->orderBy('created_at', 'DESC')
        ->first();
        return $this->showQuery($res);
    }

}
