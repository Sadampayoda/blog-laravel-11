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
        $blogs = $this->blogRepositories->all(['User','Comment','Love.User']);
        $blogs->map(function ($blog) {
            $newFormat = Carbon::createFromFormat('Y-m-d H:i:s', $blog->created_at);
            $blog->create_blog = $newFormat->format('H:i - d F Y');
            $blog->countComment = $blog->Comment->count();
            $blog->countLove = $blog->Love->count();
            if(auth()->user())
            {
                foreach($blog->Love as $item)
                {
                    $blog->loves = false;
                    if($item->user_id == auth()->user()->id)
                    {
                        $blog->loves = true;
                        $blog->id_love = $item->id;
                    }
                }
            }
        });
        return view('blog.search',[
            'data' => $blogs
        ]);
    }

    public function commentBlog($id)
    {

        $blogs = $this->blogRepositories->find($id,['User','Comment.User']);


        $newFormat = Carbon::createFromFormat('Y-m-d H:i:s', $blogs->created_at);
        $blogs->create_blog = $newFormat->format('H:i - d F Y');

        // dd($blogs);
        return view('comment.create', [
            'data' => $blogs
        ]);
    }


}
