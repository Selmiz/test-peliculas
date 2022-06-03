<?php

namespace App\Http\Controllers;

use App\Models\Turnos;
use Illuminate\Http\Request;

class TurnosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(
            [
           'turnos'=> Turnos::orderBy('id')->get()
           ]) ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $turno = $request->input('turno');
        $estado = $request->input('estado');

        \DB::beginTransaction();

        try {
            $actualiza = Turnos::create([
                'turno' => $turno,              
                'estado' => $estado
            ]);

            \DB::commit();
            $response = ['success' => true, 'msg' => 'Se guardó correctamente.'];

        } catch (\Throwable $th) {

            \DB::rollback();
            $response = ['success' => false, 'msg' => 'Ocurrio un error'];
        }

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Turnos  $turnos
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $turnos = Turnos::find($id);
        return response()->json($turnos);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Turnos  $turnos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $actualiza = Turnos::find($id);
        \DB::beginTransaction();
        try {
            
            $actualiza->turno = $request->turno;
            $actualiza->update();

            \DB::commit();
            $response = ['success' => true, 'msg' => 'Se Actualizo Correctamente.'];
        } catch (\Throwable $th) {
            \DB::rollback();
            $response = ['success' => false, 'msg' => 'Ocurrio un error '];
        }

        return $response;
    }

    public function estado($id)
    {
        $turno = Turnos::find($id);
        $estado = $turno->estado;
        if( $estado == true ) {
            $estado = false;
        }else{
            $estado = true;
        }
        
        \DB::beginTransaction();
        
        try {
            $turno->estado = $estado;
            $turno->save(); 
            
            \DB::commit();

            $response = ['success' => true, 'msg' => 'Se Actualizo Correctamente.'];

        } catch (\Throwable $th) {
            \DB::rollback();
            $response = ['success' => false, 'msg' => 'Ocurrio un error '];
        }
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Turnos  $turnos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $elimina = Turnos::find($id);
        \DB::beginTransaction();
        
        try {
            
            $elimina->delete();
            \DB::commit();

            $response = ['success' => true, 'msg' => 'Se elimino correctamente.'];

        } catch (\Throwable $th) {
            \DB::rollback();
            $response = ['success' => false, 'msg' => 'Ocurrio un error'];
        }
        return $response;
    }
}
