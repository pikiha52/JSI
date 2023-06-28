<?php

namespace App\Http\Controllers\Api\Modules;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::query();
        $name = $request->name;
        if ($name != null) {
            $users = $users->where('name', 'LIKE', '%' . $name . '%');
        }

        $users = $users->select('id','name')->get();

        if (count($users) < 1) {
            return response()->json([
                'code' => 422,
                'results' => null,
                'message' => 'Data is not found'
            ]);
        }

        return response()->json([
            'code' => 200,
            'results' => $users,
            'message' => 'Success'
        ]);
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required'
            ]);

            $user = new User();
            $user->name = $request->name;
            $user->save();

            return response()->json([
                'code' => 201,
                'results' => [
                    'user_id' => $user->id,
                ],
                'message' => 'Success'
            ]);
        } catch (Exception $err) {
            return response()->json([
                'code' => $err->getCode(),
                'message' => $err->getMessage()
            ]);
        }
    }

    public function show($id)
    {
        $user = User::find($id);
        if ($user == null) {
            return response()->json([
                'code' => 404,
                'results' => null,
                'message' => 'User not found',
            ]);
        }

        return response()->json([
            'code' => 200,
            'results' => $user,
            'message' => 'Success',
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'name' => 'required',
            ]);

            $user = User::find($id);
            if ($user == null) {
                return response()->json([
                    'code' => 404,
                    'results' => null,
                    'message' => 'User not found'
                ]);
            }

            $user->name = $request->name;
            $user->save();
            return response()->json([
                'code' => 200,
                'results' => [
                    'user_id' => $user->id,
                ],
                'message' => 'Success'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function delete($id)
    {
        $user = User::find($id);
        if ($user == null) {
            return response()->json([
                'code' => 404,
                'results' => null,
                'message' => 'User not found'
             ]);
        }

        $user->delete();
        return response()->json([
            'code' => 200,
            'message' => 'User deleted successfully',
        ]);
    }
}
