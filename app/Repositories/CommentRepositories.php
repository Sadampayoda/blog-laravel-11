<?php


namespace App\Repositories;
use App\Repositories\interface\{CrudRepositoriesInterface};
use App\Models\Comment;

Class CommentRepositories implements CrudRepositoriesInterface {
    public function all(array $relationships = []){
        if($relationships){
            return Comment::with($relationships)->orderBy('created_at','DESC')->get();
        }else{
            return Comment::all();
        }
    }
    public function find($id, ?array $relationships = [])
    {
        if($relationships){
            return Comment::with($relationships)->orderBy('created_at','DESC')->find($id);
        }else{
            return Comment::find($id);
        }
    }

    public function create(array $data)
    {
        Comment::create($data);
    }

    public function update($id, array $data)
    {
        Comment::where('id',$id)->update($data);
    }

    public function delete($id)
    {
        Comment::where('id',$id)->delete();
    }

    public function search($keyword, ?array $relationships = [])
    {
        if($relationships){
            return Comment::with($relationships)->where('description','LIKE','%'.$keyword.'%')->orderBy('created_at','DESC')->get();
        }else{
            return Comment::where('description','LIKE','%'.$keyword.'%')->get();
        }
    }
}
