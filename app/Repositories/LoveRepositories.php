<?php


namespace App\Repositories;
use App\Repositories\interface\{CrudRepositoriesInterface};
use App\Models\Love;

Class LoveRepositories implements CrudRepositoriesInterface {
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


}
