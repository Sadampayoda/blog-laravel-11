<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidationBlog;
use App\Models\Blog;
use App\Repositories\BlogRepositories;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    protected $blogRepositories;
    public function __construct(BlogRepositories $blogRepositories)
    {
        $this->blogRepositories = $blogRepositories;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = $this->blogRepositories->all('User');

        $blogs->map(function ($blog){
            $newFormat = Carbon::createFromFormat('Y-m-d H:i:s',$blog->created_at);
            $blog->create_blog = $newFormat->format('H:i - d F Y');
        });

        // dd($blogs);
        return view('blog.index',[
            'data' => $blogs
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
    public function store(ValidationBlog $validationBlog)
    {
        if(!auth()->user()->id)
        {
            return abort(404);
        }
        $filename = null;
        if($validationBlog->hasFile('image'))
        {
            $file = $validationBlog->file('image');
            $filename = $file->store('upload/blog');

        }

        $this->blogRepositories->create([
            'user_id' => auth()->user()->id,
            'image' => $filename,
            'description' => $validationBlog->description
        ]);

        return redirect()->route('blog.index')->with('success','Anda telah berhasil membuat blog');


    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        //
    }
}
