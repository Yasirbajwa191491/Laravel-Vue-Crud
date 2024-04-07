<?php

namespace App\Repositories;

use App\Models\Product;

interface ProductRepositoryInterface
{
    public function all();

    public function create(array $data);

    public function find($id);

    public function update(Product $product, array $data);

    public function delete(Product $product);
}
