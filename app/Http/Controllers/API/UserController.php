<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return User::latest()->paginate(10);
    }
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Application|Response|ResponseFactory
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
	    $user = User::create($data);
	
	    $token = $user->createToken($request['email'])->plainTextToken;
	
	    $response = [
		    'message' => __('User created with successfully.'),
		    'variant' => 'success',
		    'user' => $user,
		    'token' => $token
	    ];
	
	    return response($response);
    }
	
	/**
	 * Display the specified resource.
	 *
	 * @param int $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param User $user
	 * @param Request $request
	 * @return Application|ResponseFactory|Response
	 */
	public function update(User $user, Request $request)
	{
		$request->validate([
			'name' => 'required|min:3',
			'email' => 'email:rfc,dns|unique:users,email,' . $user['id'],
			'type' => 'required',
			'password' => 'sometimes|required|min:8|confirmed'
		]);
		
		$user->fill($request->all());
	    $user->save();
		
		$response = [
		    'message'=> __('User edited with successfully.'),
		    'variant' => 'success'
	    ];
	    return  response($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Application|Response|ResponseFactory
     */
	public function destroy($id)
	{
		$user = User::findOrFail($id);
		$user->delete();
		$response =  [
			'message' => __('User removed successfully.'),
			'variant' => 'success'
		];
		return  response($response);
		
	}
}
