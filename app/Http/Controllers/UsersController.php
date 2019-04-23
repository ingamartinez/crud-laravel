<?php

namespace App\Http\Controllers;

use App\Traits\AppHelpers;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    use AppHelpers;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $user = User::create($request->except('id_user'));
        }catch (\Exception $ex){
            return $this->returnErrors("No se puede crear el Usuario $request->first_name $request->last_name",$ex->getMessage());
        }
        return $this->returnSuccess("Usuario $request->first_name $request->last_name creado correctamente",$user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $user = User::findOrFail($id);
        }catch (\Exception $ex){
            return $this->returnErrors("Error al buscar rol",$ex->getMessage());
        }
        return $this->returnSuccess('Success',$user);
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
        try{
            $user = User::findOrFail($id);
            $user->cedula = $request->cedula;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->save();
        }catch (\Exception $ex){
            return $this->returnErrors("No se puede actualizar el usuario $request->first_name $request->last_name",$ex->getMessage());
        }

        return $this->returnSuccess("Usuario $request->first_name $request->last_name editado correctamente",$user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $user = User::findOrFail($id);
            $user->delete();
        }catch (\Exception $ex){
            return $this->returnErrors("No se puede eliminar el usuario",$ex->getMessage());
        }
        return $this->returnSuccess("Usuario $user->first_name $user->last_name eliminado correctamente",$user);
    }

    public function datatable(){
        $users = \DataTables::of(User::all())->toJson();
        return $users;
    }
}
