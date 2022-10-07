<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
// use App\Models\Type;
use Illuminate\Http\Request;
use App\Models\User;
use Adldap\Laravel\Facades\Adldap;


class PassportAuthController extends Controller
{
    /**
     * Registration Req
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $success = [
            'token' =>  $user->createToken('PerpusAccess')->accessToken,
            'username' => $user->name
          ];

          return response()->json([$success], 200);
    }

    /**
     * Login Req
     */
    public function login(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];
        $username = $request->email;
        $password = $request->password;

        if (Adldap::connect("default")) {
            if (Adldap::auth()->attempt($username, $password, $bindAsUser = true)) {
                // return response()->json([], 200);
                $ldap = Adldap::search()->users()->findBy('samaccountname', $username);
                // return response()->json(['users' => $ldap],200);

                $databaseMail = User::where('email', $ldap->mail[0])->where('is_ldap', 1)->where('is_active', 1);


                if (count($databaseMail->get()) > 0) {

                        $token = $databaseMail->first()->createToken('PerpusAccess', ['admin'])->accessToken;
                        return response()->json(['token' => $token, "user" => $data], 200);

                } else {
                    return response()->json(['gagal'], 401);
                }
            } else if (auth()->attempt($data)) {
                if (auth()->user()->is_ldap == 0) {
                    $token = auth()->user()->createToken('PerpusAccess', ['admin'])->accessToken;
                    $data = auth()->user();
                    return response()->json(['token' => $token, "user" => $data], 200);
                } else {
                    return response()->json(['error' => 'Unauthorised'], 401);
                }
            } else {
                return response()->json(['error' => 'Unauthorised'], 401);
            }
        }
    }

    public function userInfo()
    {

     $user = auth()->user();

     return response()->json(['user' => $user], 200);

    }
    public function logout()
    {
        // $accessToken = auth()->user()->token();
     $user = auth()->user();
     $user->token()->revoke();
     return response()->json(['logout'], 200);

    }

}
