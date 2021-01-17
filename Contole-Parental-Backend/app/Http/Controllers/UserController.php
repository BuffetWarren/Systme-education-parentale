<?php

namespace App\Http\Controllers;

use App\APIError;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $data = $request->except('files');

        $data['avatar'] = '';
        //upload image
        if ($file = $request->file('avatar')) {
            $filePaths = $this->saveSingleImage($this, $request, 'avatar', 'users');
            $data['avatar'] = $filePaths;
        }
        
        $user = new User();
        $user->login = $data['login'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->avatar = $data['avatar'];
        $user->name = $data['name'];
        $user->region = $data['region'];
        $user->birth_date = $data['birth_date'];
        $user->roles = $data['roles'];
        $user->parent_id = $data['parent_id'] ?? null;
        $user->save();
        
        return response()->json($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$user = User::find($id)) {
            $apiError = new APIError;
            $apiError->setStatus("404");
            $apiError->setCode("USER_NOT_FOUND");
            return response()->json($apiError, 404);
        }
        $user->avatar = url($user->avatar);

        return response()->json($user);
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
        //
    }
}
