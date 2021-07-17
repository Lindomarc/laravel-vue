<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::latest()->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function store(Request $request)
    {
	    $request->validate([
		    'name'=> 'required|min:3',
		    'email' => 'email:rfc,dns|unique:users,email',
		    'type'=>'required',
		    'password' => 'required|min:8|confirmed'
	    ]);
	    
    	$data = [
		    'name' => $request['name'],
		    'email' => $request['email'],
		    'type' => $request['type'],
		    'bio' => $request['bio'],
		    'photo' => $request['photo'],
		    'password' => Hash::make($request['password'])
	    ];
	    User::create($data);
	    return [
		    'message'=> __('User created with successfully.'),
		    'variant' => 'success'
	    ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return array
     */
    public function update(User $user, Request $request)
    {
	    $request->validate([
		    'name'=> 'required|min:3',
		    'email' => 'email:rfc,dns|unique:users,email,'.$user['id'],
		    'type'=>'required'
	    ]);
	    
    	$user->fill($request->all());
	    $user->save();
	
	    return [
		    'message'=> __('User edited with successfully.'),
		    'variant' => 'success'
	    ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return array
     */
    public function destroy($id)
    {
    	$user = User::findOrFail($id);
    	$user->delete();
    	return [
    		'message'=> __('User removed successfully.'),
		    'variant' => 'success'		    
	    ];
    }
}
