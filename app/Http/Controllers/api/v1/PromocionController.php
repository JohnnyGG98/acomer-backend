<?php

namespace App\Http\Controllers\api\v1;

use App\Models\Promocion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Promocion\PromocionCollection;
use App\Http\Requests\Promocion\PromocionCreateRequest;

class PromocionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new PromocionCollection(
            Promocion::select([
                'fecha_inicio',
                'fecha_fin',
                'precio',
                'descuento',
                'extra'
            ])->paginate()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PromocionCreateRequest $request)
    {
        $prom = new Promocion($request->all());
        return $this->saveObject($prom);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prom = Promocion::findOrFail($id);
        return $this->showResponse($prom);
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
        $prom = Promocion::findOrFail($id);
        return $this->updateObject($prom, $request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prom = Promocion::findOrFail($id);
        return $this->deleteObject($prom);
    }
}
