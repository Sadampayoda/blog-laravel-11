<?php

namespace App\Repositories\interface;


interface SearchRepositoriesInterface {
    public function search($columns,$keyword, Array $relationships = []);

    public function searchWhereSelect(string $columns, string $keyword, Array $relationships = []);

}
