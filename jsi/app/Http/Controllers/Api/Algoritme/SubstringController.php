<?php

namespace App\Http\Controllers\Api\Algoritme;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class SubstringController extends Controller
{
    public function index(Request $request)
    {
        try {
            $this->validate($request, [
                'character' => 'required'
            ]);

            $character = $request->character;
            $n = strlen($character);
            $maxLength = 0;
            $start = 0;
            $charMap = array();

            for ($i = 0; $i < $n; $i++) {
                $currentChar = $character[$i];
                if (array_key_exists($currentChar, $charMap) && $charMap[$currentChar] >= $start) {
                    $start = $charMap[$currentChar] + 1;
                }
                $charMap[$currentChar] = $i;
                $length = $i - $start + 1;
                $maxLength = max($maxLength, $length);
            }

            return response()->json([
                'code' => 200,
                'results' => $maxLength
            ]);
        } catch (Exception $err) {
            return response()->json([
                'code' => $err->getCode(),
                'message' => $err->getMessage()
            ]);
        }
    }
}
