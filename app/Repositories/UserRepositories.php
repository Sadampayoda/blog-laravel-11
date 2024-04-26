<?php


namespace App\Repositories;
use App\Repositories\interface\{CrudRepositoriesInterface};
use App\Models\User;

Class UserRepositories implements CrudRepositoriesInterface {
    public function all(array $relationships = []){
        if($relationships){
            return User::with($relationships)->orderBy('created_at','DESC')->get();
        }else{
            return User::all();
        }
    }
    public function find($id, ?array $relationships = [])
    {
        if($relationships){
            return User::with($relationships)->orderBy('created_at','DESC')->find($id);
        }else{
            return User::find($id);
        }
    }

    public function create(array $data)
    {
        User::create($data);
    }

    public function update($id, array $data)
    {
        User::where('id',$id)->update($data);
    }

    public function delete($id)
    {
        User::where('id',$id)->delete();
    }


}
