<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Repositories\CommentRepositories;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected $commentRepositories;

    public function __construct(CommentRepositories $commentRepositories)
    {
        $this->commentRepositories = $commentRepositories;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->commentRepositories->create([
            'blog_id' => $request->blog_id,
            'user_id' => auth()->user()->id,
            'comment' => $request->comment
        ]);

        return response()->json([
            'message' => 'Success',
            'data' => $request->comment
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $this->commentRepositories->delete($request->comment_id);

        return response()->json([
            'message' => 'Sukses delete'
        ]);
    }
}
