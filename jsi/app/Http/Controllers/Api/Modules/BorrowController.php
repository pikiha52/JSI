<?php

namespace App\Http\Controllers\Api\Modules;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class BorrowController extends Controller
{
    public function index(Request $request)
    {
        $book_name = $request->book_name;
        $user_name = $request->user_name;

        $borrows = Peminjaman::query();
        $borrows = $borrows->with(['user', 'book']);
        if ($book_name != null) {
            $borrows = $borrows->whereRelation('book', 'name', 'LIKE', '%' . $book_name . '%');
        }

        if ($user_name != null) {
            $borrows = $borrows->whereRelation('user', 'name', 'LIKE', '%' . $user_name . '%');
        }

        $borrows = $borrows->get();

        if (count($borrows) < 1) {
            return response()->json([
                'code' => 422,
                'results' => null,
                'message' => 'Data is not found'
            ]);
        }

        $data = [];
        foreach ($borrows as $value) {
            $data[] = [
                'borrow_id' => $value->id,
                'user_id' => $value->user->id,
                'name' => $value->user->name,
                'book_id' => $value->book->id,
                'book_name' => $value->book->name,
                'borrow_date' => $value->borrow_date,
            ];
        }

        return response()->json([
            'code' => 200,
            'results' => $data,
            'message' => 'Success'
        ]);
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'user_id' => 'required|numeric',
                'book_id' => 'required|numeric',
                'borrow_date' => 'required|date'
            ]);

            $borrow = new Peminjaman();
            $borrow->user_id = $request->user_id;
            $borrow->book_id = $request->book_id;
            $borrow->borrow_date = Carbon::parse($request->borrow_date);
            $borrow->save();

            return response()->json([
                'code' => 201,
                'results' => [
                    'peminjaman_id' => $borrow->id,
                ],
                'message' => 'Success'
            ]);
        } catch (Exception $err) {
            return response()->json([
                'code' => $err->getCode(),
                'message' => "Failed to save",
            ]);
        }
    }

    public function show($id)
    {
        $borrow = Peminjaman::with(['user', 'book'])->find($id);
        if ($borrow == null) {
            return response()->json([
                'code' => 404,
                'results' => null,
                'message' => 'Not found'
            ]);
        }

        return response()->json([
            'code' => 200,
            'results' => $borrow,
            'message' => 'Success'
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'user_id' => 'required|numeric',
                'book_id' => 'required|numeric',
                'borrow_date' => 'required|date'
            ]);

            $borrow = Peminjaman::find($id);
            if ($borrow == null) {
                return response()->json([
                    'code' => 404,
                    'results' => null,
                    'message' => 'Not found'
                ]);
            }

            $borrow->user_id = $request->user_id;
            $borrow->book_id = $request->book_id;
            $borrow->borrow_date = Carbon::parse($request->borrow_date);
            $borrow->save();

            return response()->json([
                'code' => 200,
                'results' => [
                    'peminjaman_id' => $borrow->id,
                ],
                'message' => 'Success'
            ]);

        } catch (Exception $err) {
            return response()->json([
                'code' => 500,
                'message' => 'Error',
            ]);
        }
    }

    public function delete($id)
    {
        $borrow = Peminjaman::find($id);
        if ($borrow == null) {
            return response()->json([
                'code' => 404,
                'results' => null,
                'message' => 'Not found'
            ]);
        }

        $borrow->delete();
        return response()->json([
            'code' => 200,
            'message' => 'Success'
        ]);
    }
}
