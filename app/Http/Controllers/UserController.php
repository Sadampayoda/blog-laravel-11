<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidationProfile;
use Illuminate\Http\Request;
use App\Models\User;
use App\Repositories\BlogRepositories;
use App\Repositories\UserRepositories;
use Carbon\Carbon;

class UserController extends Controller
{
    protected $UserRepositories,$blogRepositories;
    public function __construct(UserRepositories $UserRepositories, BlogRepositories $blogRepositories)
    {
        $this->UserRepositories = $UserRepositories;
        $this->blogRepositories = $blogRepositories;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = $this->blogRepositories->searchWhereSelect('user_id',auth()->user()->id,['User','Comment','Love']);
        $blogs->map(function ($blog) {
            $newFormat = Carbon::createFromFormat('Y-m-d H:i:s', $blog->created_at);
            $blog->create_blog = $newFormat->format('H:i - d F Y');
            $blog->countComment = $blog->Comment->count();
            $blog->countLove = $blog->Love->count();
            foreach($blog->Love as $item)
            {
                $blog->loves = false;
                if($item->user_id == auth()->user()->id)
                {
                    $blog->loves = true;
                    $blog->id_love = $item->id;
                }
            }
        });
        return view('profile.index', [
            'data' => $blogs,
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ValidationProfile $validationProfile, User $user)
    {
        // $validationProfile->only(['name', 'email', 'image']);

        if ($validationProfile->hasFile('image')) {


            if ($validationProfile->imageLama) {
                if (file_exists(public_path('image/profile/' . $validationProfile->imageLama))) {
                    unlink(public_path('image/profile/' . $validationProfile->imageLama));
                }
            }

            $file = $validationProfile->file('image');
            $filename = random_int(10, 9999999) . '-' . $file->getClientOriginalName();
            $file->move('image/profile', $filename);
        } else {
            $validationProfile->only('description');
            $filename = $validationProfile->imageLama;
            if ($validationProfile->imageHapus == 'on') {

                if (file_exists(public_path('image/profile/' . $validationProfile->imageLama))) {
                    unlink(public_path('image/profile/' . $validationProfile->imageLama));
                }
                $filename = null;
            }
        }
        $this->UserRepositories->update(auth()->user()->id, [
            'name' => $validationProfile->name,
            'image' => $filename,
            'email' => $validationProfile->email
        ]);

        return redirect()->route('profile.index')->with('success', 'Anda telah berhasil Update Profile');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
