<?php


namespace App\Repositories;
use App\Repositories\interface\{CrudRepositoriesInterface, SearchRepositoriesInterface};
use App\Models\Love;

Class LoveRepositories implements CrudRepositoriesInterface, SearchRepositoriesInterface {
    public function all(array $relationships = []){
        if($relationships){
            return Love::with($relationships)->orderBy('created_at','DESC')->get();
        }else{
            return Love::all();
        }
    }
    public function find($id, ?array $relationships = [])
    {
        if($relationships){
            return Love::with($relationships)->orderBy('created_at','DESC')->find($id);
        }else{
            return Love::find($id);
        }
    }

    public function create(array $data)
    {
        Love::create($data);
    }

    public function update($id, array $data)
    {
        Love::where('id',$id)->update($data);
    }

    public function delete($id)
    {
        Love::where('id',$id)->delete();
    }

    public function search($columns, $keyword, array $relationships = [])
    {
        if($relationships){
            return Love::with($relationships)->where($columns,'LIKE','%'.$keyword.'%')->orderBy('created_at','DESC')->get();
        }else{
            return Love::where($columns,'LIKE','%'.$keyword.'%')->get();
        }
    }
    public function searchWhereSelect(string $columns, string $keyword, array $relationships = [])
    {
        if($relationships)
        {
            return Love::with($relationships)->where($columns,$keyword)->orderBy('created_at','DESC')->get();
        }else{

            return Love::where($columns,$keyword)->orderBy('created_at','DESC')->get();
        }
    }


}
