<?php

namespace App\Http\Controllers\Api\Algoritme;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class FibonacciController extends Controller
{
    public function index(Request $request)
    {
        try {
            $this->validate($request, [
                'x' => 'required|numeric'
            ]);

            $inputX = $request->x;
            if ($inputX <= 0) {
                return response()->json([
                    'code' => 400,
                    'message' => 'Invalid input. x should be a positive integer.'
                ]);
            }

            if ($inputX == 1) {
                return response()->json([
                    'code' => 200,
                    'results' => '0'
                ]);
            }

            if ($inputX == 2) {
                return response()->json([
                    'code' => 200,
                    'results' => '0, 1'
                ]);
            }

            $fibonacci = [0, 1];
            for ($i = 2; $i < $inputX; $i++) {
                $nextNumber = $fibonacci[$i - 1] + $fibonacci[$i - 2];
                $fibonacci[] = $nextNumber;
            }

            $result = '';
            foreach ($fibonacci as $num) {
                $result .= $num . ', ';
            }

            return response()->json([
                'code' => 200,
                'results' => $result
            ]);
        } catch (Exception $err) {
            return response()->json([
                'code' => $err->getCode(),
                'message' => $err->getMessage()
            ]);
        }
    }
}
