<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\BookResource;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Validator;
 
class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Book::get();
        return response([
            'status' => 200,
            'message' => 'data terload',
            'data' => $data,
        ],200);
        // $books = Book::paginate(20);
        // return BookResource::collection($books);
    }
 
 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    // title, description. author. publisher. date_of_issue
    {
        $data = Book::create([
            'title' => $request->title,
            'description' => $request->description,
            'author' => $request->author,
            'publisher' => $request->publisher,
            'date_of_issue' => $request->date_of_issue
        ]);
        return response([
            'status' => 200,
            'message' => 'Data successfully added',
            'data' => $data,
        ],200);
    }
 
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Book::find($id);
        if ($data == null) {
            return response([
                'status' => 404,
                'message' => "Tidak ada data dengan id $id",
            ],404);
        } else {
            return response([
                'status' => 200,
                'message' => 'Data terload',
                'data' => $data,
            ],200);
        }
    }
    public function search($title)
    {
        $data = Book::where('title', 'LIKE', "%$title%")->get();
        if (count($data) > 0) {
            return response([
                'status' => 200,
                'message' => 'Data successful loaded',
                'data' => $data,
            ],200);
        } else {
            return response([
                'status' => 404,
                'message' => "Tidak ada data dengan title $title",
            ],404);
        }
    }
 
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
 
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Book::find($id);
        if ($data == null) {
            return response([
                'status' => 404,
                'message' => "Tidak ada data dengan id $id",
            ], 404);
        } else {
            $data->update($request->all());
            return response(
                [
                    'message' => 'Update successfully',
                    'status' => 200,
                    'data' => new BookResource($data)
                ],
                200
            );
        }
    }
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $book = Book::find($id);
        if ($book == null) {
            return response([
                'status' => 404,
                'message' => "Tidak ada data dengan id $id",
            ], 404);
        } else {
            $book->delete();
            return response(
                [
                    'data' => new BookResource($book),
                    'message' => 'Delete successfully',
                    'status' => 204
                ],
                204
            );
        }
    }
}