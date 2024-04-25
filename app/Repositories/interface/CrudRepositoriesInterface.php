<?php

namespace App\Repositories\interface;


interface CrudRepositoriesInterface {
    public function all(array $relationships = []);
    public function find($id, array $relationships = []);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}
