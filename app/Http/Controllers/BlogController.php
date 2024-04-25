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
        $blogs = $this->blogRepositories->all(['User','Comment']);

        $blogs->map(function ($blog) {
            $newFormat = Carbon::createFromFormat('Y-m-d H:i:s', $blog->created_at);
            $blog->create_blog = $newFormat->format('H:i - d F Y');
            $blog->countComment = $blog->Comment->count();
        });

        // dd($blogs);
        return view('blog.index', [
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

        if (!auth()->user()->id) {
            return abort(404);
        }
        $filename = null;
        if ($validationBlog->hasFile('image')) {
            $file = $validationBlog->file('image');
            $filename = random_int(10, 9999999) . '-' . $file->getClientOriginalName();
            $file->move('image/blogs', $filename);
        }

        $this->blogRepositories->create([
            'user_id' => auth()->user()->id,
            'image' => $filename,
            'description' => $validationBlog->description
        ]);

        return redirect()->route('blog.index')->with('success', 'Anda telah berhasil membuat blog');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        $blogs = $this->blogRepositories->find($blog->id,['User','Comment.User']);


        $newFormat = Carbon::createFromFormat('Y-m-d H:i:s', $blogs->created_at);
        $blogs->create_blog = $newFormat->format('H:i - d F Y');

        // dd($blogs);
        return view('blog.show', [
            'data' => $blogs,
        ]);
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
    public function update(ValidationBlog $validationBlog, Blog $blog)
    {
        // dd($validationBlog->all());
        if (!auth()->user()) {
            return abort(404);
        }

        if ($validationBlog->hasFile('image')) {
            $validationBlog->only('image', 'description');

            if($validationBlog->imageLama)
            {
                if (file_exists(public_path('image/blogs/' . $validationBlog->imageLama))) {
                    unlink(public_path('image/blogs/' . $validationBlog->imageLama));
                }

            }

            $file = $validationBlog->file('image');
            $filename = random_int(10, 9999999) . '-' . $file->getClientOriginalName();
            $file->move('image/blogs', $filename);
        } else {
            $validationBlog->only('description');
            $filename = $validationBlog->imageLama;
            if ($validationBlog->imageHapus == 'on') {

                if (file_exists(public_path('image/blogs/' . $validationBlog->imageLama))) {
                    unlink(public_path('image/blogs/' . $validationBlog->imageLama));
                }
                $filename = null;
            }

        }
        $this->blogRepositories->update($blog->id, [
            'user_id' => auth()->user()->id,
            'image' => $filename,
            'description' => $validationBlog->description
        ]);

        return redirect()->route('blog.index')->with('success', 'Anda telah berhasil Update blog');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        if($blog->image)
        {
            if (file_exists(public_path('image/blogs/' . $blog->image))) {
                unlink(public_path('image/blogs/' . $blog->image));
            }
        }

        $this->blogRepositories->delete($blog->id);
        return redirect()->route('blog.index')->with('success', 'Anda telah berhasil Hapus blog');
    }
}
