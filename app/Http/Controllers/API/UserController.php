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

         try {
             $response = User::where('status', '1')
               // ->where('id','!=',auth('user'))
                ->paginate(getenv('PAGINATE'));
            $minus30days = minusDays();
            $date = date('d/m/Y');

        } catch (\Exception $exception) {
            $response = $exception;
        }
        return  response($response);
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
		    'role'=>'required',
		    'password' => 'required|min:8|confirmed'
	    ]);

	    $data = [
		    'name' => $request['name'],
		    'email' => $request['email'],
		    'role' => $request['role'],
		    'password' => Hash::make($request['password'])
	    ];
	    $user = User::create($data);

	    $token = $user->createToken($request['email'])->plainTextToken;

	   return [
		    'message' => __('User created with successfully.'),
		    'variant' => 'success',
		    'user' => $user,
		    'token' => $token
	    ];

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
}
