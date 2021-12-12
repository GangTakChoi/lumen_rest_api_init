<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Auth;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function getAllUsers(Request $request) {
      $userList = User::all();
      return response()->json(['userList' => $userList]);
    }

    public function login(Request $request) {

        $this->validate($request, [
            'account_id' => 'required',
            'password' => 'required',
        ]);

        $accountId = $request->input('account_id');
        $password = $request->input('password');

        $user = User::where('account_id', $accountId)->first();

        if(!empty($user) && Hash::check($password, $user->password)) {
            $apiToken = $user->id.'.'.base64_encode(Str::random(40));
            User::where('id', $user->id)->update(['api_token' => "$apiToken"]);

            return response()->json(['access_token' => $apiToken]);
        } else {
            throw new AuthorizationException;
        }
    }

    public function create(Request $request) {
        $this->validate($request, [
            'account_id' => 'required',
            'password' => 'required',
            'name' => 'required',
            'birth_year' => 'required',
        ]);

        $accountId = $request->input('account_id');
        $password = $request->input('password');
        $name = $request->input('name');
        $birthYear = $request->input('birth_year');

        $passwordHash = Hash::make($password);

        $createUserInfo = [
            'account_id' => $accountId,
            'password' => $passwordHash,
            'name' => $name,
            'birth_year' => $birthYear,
        ];

        $user = User::create($createUserInfo);

        return response()->json($user);
    }

    //
}
