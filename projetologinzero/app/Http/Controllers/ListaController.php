<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ListaController extends Controller
{
    //

    /*public function index () {

        return "oi";

    } */

    //request armazena todas informações enviadas para o metodo
    public function create(Request $request)
    {
        $name = $request->input('name');
        $phone = $request->input('phone');
        $email = $request->input('email');
        $password = $request->input('password');
        $papel = $request->input('papel');

        if (
            $request->hasFile('image'))
            {
             // Define um aleatório para o arquivo baseado no timestamps atual
                $nameimg = uniqid(date('HisYmd'));

                // Recupera a extensão do arquivo
                $extension = $request->image->extension();

                // Define finalmente o nome
                $nameFile = "{$nameimg}.{$extension}";

                // Faz o upload:
                $upload = $request->image->storeAs('usuariosimg', $nameFile);

            }


        $user = User::create(['name' => $name, 'phone' => $phone, 'email' => $email, 'password' => $password, 'papel' => $papel, 'image' => $nameFile]);

        if ($papel === 'admin') {
            $user->givePermissionTo('admin');
        } else if ($papel === 'gestor') {
            $user->givePermissionTo('gestor');
        }




        // Retorna o nome original do arquivo


        //
        //parecido com inset into, na real é bem aquilo!



        return $user->id;
    }

    public function getData()
{
    //aqui não sei qual seria o caminho para ir ao banco de dados
    $users = User::all();
    return $users;



}

}
