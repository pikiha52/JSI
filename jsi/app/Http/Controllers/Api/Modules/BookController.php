<?php

namespace App\Http\Controllers\Api\Modules;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Exception;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $book_name = $request->name;
        $book = Book::query();
        if ($book_name != null) {
            $book = $book->where('name', 'LIKE', '%' . $book_name . '%');
        }
        $book = $book->select('id', 'name')->get();

        if (count($book) < 1) {
            return response()->json([
                'code' => 422,
                'results' => null,
                'message' => 'Data is not found'
            ]);
        }

        return response()->json([
            'code' => 200,
            'results' => $book,
            'message' => 'Success'
        ]);
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required'
            ]);


            $book = new Book();
            $book->name = $request->name;
            $book->save();

            return response()->json([
                'code' => 201,
                'results' => [
                    'book_id' => $book->id,
                ],
                'message' => 'Book created successfully'
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
        $book = Book::find($id);
        if ($book == null) {
            return response()->json([
                'code' => 404,
                'results' => null,
                'message' => 'Book not found'
            ]);
        }

        return response()->json([
            'code' => 200,
            'results' => $book,
            'message' => 'Success'
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'name' => 'required',
            ]);

            $book = Book::find($id);
            if ($book == null) {
                return response()->json([
                    'code' => 404,
                    'results' => null,
                    'message' => 'Book not found'
                ]);
            }

            $book->name = $request->name;
            $book->save();

            return response()->json([
                'code' => 200,
                'results' => [
                    'book_id' => $book->id,
                ],
                'message' => 'Book saved successfully',
            ]);
        } catch (Exception $err) {
            return response()->json([
                'code' => $err->getCode(),
                'message' => $err->getMessage()
            ]);
        }
    }

    public function delete($id)
    {
        $book = Book::find($id);
        if ($book == null) {
            return response()->json([
                'code' => 404,
                'results' => null,
                'message' => 'Book not found'
            ]);
        }

        $book->delete();
        return response()->json([
            'code' => 200,
            'message' => 'Book deleted successfully'
        ]);
    }
}
