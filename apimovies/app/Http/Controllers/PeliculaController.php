<?php

namespace App\Http\Controllers;
use App\Models\Peliculas;
use App\Models\Turnos;
use App\Models\AsignaTurno;

use Illuminate\Http\Request;

class PeliculaController extends Controller
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
           'peliculas'=> Peliculas::orderBy('id')->get()
           ]) ;
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
        $name = $request->input('name');
        $fecha = $request->input('fec_pub');
        $image = $request->file('image');
       
        if(!$image){ //Validamos imagen
            return ['success' => false, 'msg' => 'Debe cargar la imagen'];
        }
        //Se Obtiene el nombre de la imagen
        $name_image = trim($image->getClientOriginalName());
        \DB::beginTransaction();

        try {
             //indicamos que queremos guardar una nueva imagen en el disco local
             \Storage::putFileAs('/public/' . '/' , $image, $name_image);

             $peli = Peliculas::create([
                'nombre' => $name,
                'fecha_publicacion' => $fecha,
                'estado' => true,
                'imagen' => $name_image,
            ]);

            \DB::commit();
            $response = ['success' => true, 'msg' => 'Se guardó correctamente.'];

        } catch (\Throwable $th) {
            \DB::rollback();
            $response = ['success' => false, 'msg' => 'Ocurrio un error'];
        }
        return $response;
        
    }
    
    public function estado($id)
    {
        $pelicula = Peliculas::find($id);
        $estado = $pelicula->estado;
        if( $estado == true ) {
            $estado = false;
        }else{
            $estado = true;
        }

        \DB::beginTransaction();
        
        try {
            $pelicula->estado = $estado;
            $pelicula->save(); 
            
            \DB::commit();

            $response = ['success' => true, 'msg' => 'Se Actualizo Correctamente.'];

        } catch (\Throwable $th) {
            \DB::rollback();
            $response = ['success' => false, 'msg' => 'Ocurrio un error '];
        }
        return $response;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Peliculas $pelicula)
    {
        return response()->json($pelicula);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Peliculas $pelicula)
    {      
        $actualiza = Peliculas::find($pelicula->id);
        $image = $request->file('image');
        $name_image = $actualiza->imagen;
        
        if($image){ //Validamos imagen
            \Storage::putFileAs('/public/' . '/' , $image, $name_image);
            $name_image = trim($image->getClientOriginalName());
        }

        \DB::beginTransaction();
        
        try {
            $actualiza->nombre = $request->name;
            $actualiza->fecha_publicacion = $request->fec_pub;
            $actualiza->imagen = $name_image;
            $actualiza->save();
            
            \DB::commit();

            $response = ['success' => true, 'msg' => 'Se Actualizo Correctamente.'];

        } catch (\Throwable $th) {
            \DB::rollback();
            $response = ['success' => false, 'msg' => 'Ocurrio un error '];
        }
        return $response;
       
    }

    public function asigna($id){
        $turnos = Turnos::orderBy('id')->where('estado', true)->get();
        $pelicula = Peliculas::find($id);

        return response()->json(
            array(
                'turnos' => $turnos,
                'pelicula' => $pelicula
            ));
    }


    public function actualiza_turno($id_pelicula,  $id_turno){
            

        \DB::beginTransaction();
        
        try {
            $turno = AsignaTurno::updateOrCreate(
                ['id_pelicula' => $id_pelicula, 'id_turno' => $id_turno]
            );
            
            \DB::commit();

            $response = ['success' => true, 'msg' => 'Se Actualizo Correctamente.'];

        } catch (\Throwable $th) {
            \DB::rollback();
            $response = ['success' => false, 'msg' => 'Ocurrio un error '. $th];
        }
        return $response;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $elimina = Peliculas::find($id);
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
