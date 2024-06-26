<?php


namespace App\Repositories;
use App\Repositories\interface\{CrudRepositoriesInterface, SearchRepositoriesInterface};
use App\Models\Blog;

Class BlogRepositories implements CrudRepositoriesInterface, SearchRepositoriesInterface {
    public function all(array $relationships = []){
        if($relationships){
            return Blog::with($relationships)->orderBy('created_at','DESC')->get();
        }else{
            return Blog::all();
        }
    }
    public function find($id, ?array $relationships = [])
    {
        if($relationships){
            return Blog::with($relationships)->orderBy('created_at','DESC')->find($id);
        }else{
            return Blog::find($id);
        }
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

    public function search($columns,$keyword, ?array $relationships = [])
    {
        if($relationships){
            return Blog::with($relationships)->where($columns,'LIKE','%'.$keyword.'%')->orderBy('created_at','DESC')->get();
        }else{
            return Blog::where($columns,'LIKE','%'.$keyword.'%')->get();
        }
    }

    public function searchWhereSelect(string $columns, string $keyword, array $relationships = [])
    {
        if($relationships)
        {
            return Blog::with($relationships)->where($columns,$keyword)->get();
        }else{

            return Blog::where($columns,$keyword)->get();
        }
    }


}
