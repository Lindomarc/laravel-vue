<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

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
	 * @param Request $request
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
	    $user = User::create($data);
	
	    $token = $user->createToken($request->email)->plainTextToken;
	
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
	 * @return \Illuminate\Http\Response
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
	 * @return array
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
			'message' => __('User removed successfully.'),
			'variant' => 'success'
		];
	}
	
	/**
	 * @throws ValidationException
	 */
	public function login(Request $request)
	{
		$request->validate([
			'email' => 'required|email',
			'password' => 'required',
		]);
		$user = User::where('email', $request->email)->first();
		
		if (!$user || !Hash::check($request->password, $user->password)) {
			throw ValidationException::withMessages([
				'email' => ['The provided credentials are incorrect.'],
			]);
		}
		
		$token = $user->createToken($request->email)->plainTextToken;
		
		$response = [
			'user' => $user,
			'token' => $token
		];
		return response($response, 201);
	}
}
