<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\AuthorizationException;

class LogoutController extends Controller
{
    public function __construct()
{
    $this->middleware('auth:sanctum');
}

            public function logout(Request $request)
            {
                try {
                    $user = Auth::user();
                    if ($user) {
                        $user->tokens->each(function ($token) {
                            $token->delete();
                        });
                        return response()->json(['success' => true], 200);
                    } else {
                        return response()->json(['success' => false, 'error' => 'usuario Não autenticado'], 401);
                    }
                } catch (Exception $e) {
                    return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
                }
            }

}
