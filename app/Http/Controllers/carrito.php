<?php

namespace TiendaUniformes\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
class carrito extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        if(Auth::check())
      {
        $user= Auth::id();
        $carritos=   DB::table('carritos')
            ->join( 'productos','carritos.id_producto', '=', 'productos.id')
            ->where('carritos.id_user', $user)
            ->select('carritos.cantidad', 'carritos.id','productos.precio','productos.path')->get();
            $pago=0;
            foreach ($carritos as $carrito) {
             $pago=$pago+($carrito->cantidad*$carrito->precio);
            }
        return view('carrito.index',compact(['carritos','pago']));

      }
      else return redirect('tienda');
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
          if(Auth::check())
      {
       \TiendaUniformes\Carrito::create([
         'id_user' => Auth::user()->id,
         'id_producto' => $request['producto'],
         'cantidad' =>  $request['cantidad']
       ]);
        return redirect('tienda');
        }
        else return redirect('tienda');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       \TiendaUniformes\Carrito::destroy($id);
       return redirect('/carrito');
        //
    }
}
