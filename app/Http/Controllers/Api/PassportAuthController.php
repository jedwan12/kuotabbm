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

        try {
            $getUser = User::with(['role'])->where('email', $request->id)->orwhere('username', $request->id)->select('username', 'is_ldap');
            // return $getUser->get();
            $id  = (count($getUser->get())>0) ?$getUser->first()->username :explode('@',$request->id)[0];
            $data = [
                'username' => $id,
                'password' => $request->password
            ];
            if (auth()->once($data)) {
                return $this->login_local();
            }
            // return var_dump($id);
            $username = $id;
            $password = $request->password;
            // return var_dump(Adldap::connect("default"));
            if (Adldap::connect("default")) {
                if (Adldap::auth()->attempt($username, $password, $bindAsUser = true)) {
                    return $this->login_ldap($username);
                } else if (auth()->once($data)) {
                    return $this->login_local();
                } else {
                    return response()->json(['Error' => 'Username Or Password incorrect'], 403);
                }
            }
        // if (auth()->once($data)) {
        //     return $this->login_local();
        // }
        } catch (Exception $e) {
            return response()->json(['Error' => $e->getMessage()], 403);
        }
    }
    private function login_ldap($username)
    {
        $ldap = Adldap::search()->users()->findBy('samaccountname', $username);
        // return response()->json(['token' => $ldap], 200);

        $databaseMail = User::with(['role'])->where('email', $ldap->mail[0])->where('is_ldap', 1);
        if (count($databaseMail->get()) > 0 && $databaseMail->first()->is_active == 1) {
            $token = $databaseMail->first()->createToken('PerpusAccess', [$databaseMail->first()->role->role_name])->accessToken;
            return response()->json(['token' => $token, "user" => $databaseMail->first()], 200);
        } else if (count($databaseMail->get()) > 0 && $databaseMail->first()->is_active == 0) {
            return response()->json(['Error' => 'Account inactive please contact admin'], 403);
        }else{
            $role = Role::where('role_name','guest')->first();
            $user = User::create([
                'name' => $ldap->givenname[0],
                'username' => $ldap->samaccountname[0],
                'email' => $ldap->mail[0],
                'password' => bcrypt(12345678),
                'is_active' => 1,
                'is_ldap' => 1,
                'role_id' => $role->id
            ]);
            $token = $user->createToken('PerpusAccess', [$role->role_name])->accessToken;
            return response()->json(['token' => $token, "user" => $user], 200);
        }
    }
    private function login_local()
    {
        try {
            if (auth()->user()->is_active == 1) {
                $token = auth()->user()->createToken('PerpusAccess', ['admin'])->accessToken;
                $data = auth()->user();
                return response()->json(['token' => $token, "user" => $data], 200);
            } else if (auth()->user()->is_active == 0) {
                return response()->json(['Error' => 'Account inactive please contact admin'], 403);
            } else {
                return response()->json(['Error' => 'Account Not Registered'], 403);
            }
        } catch (Exception $e) {
            return response()->json(['Error' => 'Unknown Error'], 403);
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
