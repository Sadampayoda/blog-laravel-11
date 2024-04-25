<?php


namespace App\Repositories;
use App\Repositories\interface\CrudRepositoriesInterface;
use App\Models\Blog;

Class BlogRepositories implements CrudRepositoriesInterface{
    public function all(string $relationships = null){
        if($relationships){
            return Blog::with($relationships)->get();
        }else{
            return Blog::all();
        }
    }
    public function find($id)
    {
        return Blog::find($id);
    }

    public function create(array $data)
    {
        Blog::create($data);
    }

    public function update($id, array $data)
    {
        Blog::where('id',$id)->update($data);
    }

    public function delete($id)
    {
        Blog::where('id',$id)->delete();
    }
}
