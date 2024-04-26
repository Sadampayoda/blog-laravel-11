<?php

namespace App\Http\Controllers;

use App\Models\Love;
use App\Repositories\BlogRepositories;
use App\Repositories\LoveRepositories;
use Illuminate\Http\Request;

class LoveController extends Controller
{
    protected $loveRepositories,$blogRepositories;
    public function __construct(LoveRepositories $loveRepositories,BlogRepositories $blogRepositories){
        $this->loveRepositories = $loveRepositories;
        $this->blogRepositories = $blogRepositories;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $data = $this->loveRepositories->searchWhereSelect('user_id',auth()->user()->id,['User','Blog']);
        if(!auth()->user())
        {
            return abort(403);
        }
        $data = $this->blogRepositories->searchWhereSelect('user_id',auth()->user()->id,['User','Love.User','Love.Blog']);

        // dd($data);
        return view('notification.index',[
            'data' => $data,
        ]);
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
        if(!auth()->user())
        {
            return abort(403);
        }
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
        if(!auth()->user())
        {
            return abort(403);
        }
        $this->loveRepositories->delete($request->love_id);
        return response()->json([
            'message' => 'Sukses Hapus',

        ]);
    }
}
