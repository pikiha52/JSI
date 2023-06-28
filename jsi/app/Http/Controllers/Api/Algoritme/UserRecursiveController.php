<?php

namespace App\Http\Controllers\Api\Algoritme;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class UserRecursiveController extends Controller
{
    private $items = [
        ['code' => 'A001', 'name' => 'Wati', 'parent' => ''],
        ['code' => 'A002', 'name' => 'Wira', 'parent' => 'A001'],
        ['code' => 'A003', 'name' => 'Andi', 'parent' => 'A002'],
        ['code' => 'A004', 'name' => 'Bagus', 'parent' => 'A002'],
        ['code' => 'A005', 'name' => 'Siti', 'parent' => 'A001'],
        ['code' => 'A006', 'name' => 'Hasan', 'parent' => 'A005'],
        ['code' => 'A007', 'name' => 'Abdul', 'parent' => 'A006'],
    ];

    public function index(Request $request)
    {
        try {
            $this->validate($request, [
                'code' => 'required'
            ]);

            $user = $this->userRecursive($request->code);
            return response()->json($user);
        } catch (Exception $err) {
            return response()->json([
                'code' => $err->getCode(),
                'message' => $err->getMessage()
            ]);
        }
    }

    private function userRecursive($code)
    {
        $users = [];

        foreach ($this->items as $item) {
            if ($item['parent'] === $code) {
                $users[] = $item['name'];
                $users = array_merge($users, $this->userRecursive($item['code']));
            }
        }

        return $users;
    }
}
