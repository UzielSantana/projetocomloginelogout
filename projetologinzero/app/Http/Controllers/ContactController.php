<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ContactController extends Controller
{
    public function contacts () {

        $contacts = User::all();
        return response() -> json(

            [

                    'contacts' => $contacts,
                    'message' => 'Contacts'
            ]
            );


        }

        public function delete($id) {

            $contacts = User::find($id);
            if($contacts) {
                $contacts-> delete ();
                return response() -> json( [
                    'message' => 'Apaguei aqui',
                    'code' => 200

                ]);
            }else {
                return response() -> json( [
                'message' => 'Nao apagou mesmo',
                'code ' => 200

            ]);

            }

    }

    }
