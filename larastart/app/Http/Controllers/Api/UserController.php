<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Image;

class UserController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $users = User::latest()->get();
        return response([
            'users' => $users
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|min:2|max:20',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'type' => 'required|string|max:15',
            'bio' => 'nullable|string|max:60',
            'photo' => 'nullable|string|max:60'
        ]);

        $user = new User;
        $user->name = ucwords($request->name);
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->type = $request->type;
        $user->bio = ucfirst($request->bio);
        $request->photo ? $request->photo : false;
        $user->save();

        return response([]);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return response([]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'id' => 'required|exists:users,id',
            'name' => 'required|string|min:2|max:20',
            'email' => 'required|email|unique:users,email,'.$request->id,
            'password' => 'sometimes|string|min:8',
            'type' => 'required|string|max:15',
            'bio' => 'nullable|string|max:60',
            'photo' => 'nullable|string|max:60'
        ]);

        $user =  User::findOrFail($id);
        $user->name = ucwords($request->name);
        $user->email = strtolower($request->email);
        $user->password = Hash::make($request->password);
        $user->type = $request->type;
        $user->bio = $request->bio;
        $request->photo ? $request->photo : false;
        $user->update();

        return response([]);
    }

    public function profile()
    {
        $user = auth('api')->user();
        return response(['user' => $user]);
    }

    public function profileUpdate(Request $request)
    {
        $user = auth('api')->user()->id;

        if($request->photo)
        {
            $image = $request->photo;
    
            // Get extension
            $extension = explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
    
            // Create new filename
            $filenameToStore =time() . '.' . $extension;
    
            // Storage image and Create path and Upload image

            Image::make($image)->resize(1200, 1200)->save(public_path('img/profile/') . $filenameToStore);

        }

        return response([]);
    }
}
