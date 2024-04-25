<?php

namespace App\Repositories\interface;


interface CrudRepositoriesInterface {
    public function all(string $relationships = null);
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}
