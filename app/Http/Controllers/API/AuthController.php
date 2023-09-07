<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request) {
        $user = Siswa::where('nisn', $request->nisn)->where('nama', $request->nama)->with('kelas')->first();

        // if(!$user){
        //     if ($guru = User::where('nisn', $request->nisn)->where('name', $request->nama)->first()){
        //         $success = [
        //             'status'=> true,
        //             'message' => 'Berhasil Login Guru',
        //             'data' => $guru
        //         ];
        //         return response()->json($success,200);
        //     } else{
        //         return response()->json('ID CARD number incorrect', 401);
        //     }
        // }
        if(!$user){
            $data = [
                'message' => 'Nisn atau Nama terdapat kesalahan',
                'status' => 0
            ];
                return response()->json($data, 401);
        }

        $token = md5($user->nisn);
        $user->update(['login_tokens' => $token]);
        $success = [
            'status'=> true,
            'message' => 'Berhasil Login Siswa',
            'data' => $user
        ];

        return response()->json($success, 200);
    }

    public function logout(Request $request){

        $user = Siswa::where('login_tokens', $request->token)->first();

        if(!$user){
            if ($guru = User::where('login_tokens', $request->token)->first()){ //guru
                $guru->update(['login_tokens' => NULL]);

                return response()->json(['message' => 'Berhasil Logout'],200);
            } else{
                return response()->json('Invalid Token', 200);
            }
        }

        $user->update(['login_tokens' => NULL]);

        return response()->json(['message' => 'Berhasil Logout'],200);
    }
    public function detail(){
        $oke = Siswa::all();
        return response()->json($oke,200);
    }

}
