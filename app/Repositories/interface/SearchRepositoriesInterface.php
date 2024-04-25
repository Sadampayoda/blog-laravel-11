<?php

namespace App\Repositories\interface;


interface SearchRepositoriesInterface {
    public function search($keyword, string $relationships = null);
}
