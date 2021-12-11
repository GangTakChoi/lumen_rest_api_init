<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    public function getUserInfo(Request $request) {
      // $this->info('The command was successful!');

      $return['name'] = 'choikt';
      $return['age'] = 27;

      return response()->json(['name' => 'Abigail', 'state' => 'CA']);
    }

    public function addUser(Request $request, $id) {
      // $this->info('The command was successful!');

      $name = $request->input('name');
      $role = $request->input('role');

      return response()->json(['id' => $id, 'name' => $name, 'role' => $role]);
    }

    //
}
