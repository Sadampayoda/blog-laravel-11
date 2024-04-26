<?php

namespace App\Http\Controllers;

use App\Models\Love;
use App\Repositories\LoveRepositories;
use Illuminate\Http\Request;

class LoveController extends Controller
{
    protected $loveRepositories;
    public function __construct(LoveRepositories $loveRepositories){
        $this->loveRepositories = $loveRepositories;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('notification',[
            'data' => $this->loveRepositories->
        ])
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
        $this->loveRepositories->create([
            'blog_id' => $request->blog_id,
            'user_id' => auth()->user()->id
        ]);

        return response()->json([
            'message' => 'Sukses love'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Love $love)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Love $love)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Love $love)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $this->loveRepositories->delete($request->love_id);
        return response()->json([
            'message' => 'Sukses Hapus',

        ]);
    }
}
