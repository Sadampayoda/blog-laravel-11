<?php

namespace App\Http\Controllers;

use App\Repositories\BlogRepositories;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
    protected $blogRepositories;
    public function __construct(BlogRepositories $blogRepositories)
    {
        $this->blogRepositories = $blogRepositories;
    }
    public function index()
    {
        return view('index');
    }

    public function searchBlog(Request $request)
    {
        $blogs = $this->blogRepositories->search($request->keyword,'User');

        $blogs->map(function ($blog) {
            $newFormat = Carbon::createFromFormat('Y-m-d H:i:s', $blog->created_at);
            $blog->create_blog = $newFormat->format('H:i - d F Y');
        });
        return view('blog.search',[
            'data' => $blogs
        ]);
    }
}
