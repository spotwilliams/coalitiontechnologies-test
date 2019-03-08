<?php

namespace App\Repositories;


use App\Models\Model;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class Json extends Repository
{

    protected $path = 'products.json';

    public function store(Model $model)
    {
        $model->setId($this->lastId() + 1);

        $products = $this->getAll();

        $products->add($model);

        $array = $this->toArray($products);

        $this->storage()->put($this->path, json_encode($array));
    }


    public function update(Model $model, $id)
    {
        $products = $this->getAll();

        $products->reject(function (Model $model, $key) use ($id) {
            return $model->getId() === $id;
        });

        $products->add($model);

        $array = $this->toArray($products);

        $this->storage()->put($this->path, json_encode($array));
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    /**
     * @param $id
     * @return mixed
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function find($id)
    {

        $products = $this->getAll();

        return $products->search(function (Model $item, $key) use ($id) {
            return $item->getId() === $id;
        });
    }

    public function lastId()
    {
        return $this->getAll()->count();
    }

    protected function storage()
    {
        return Storage::disk('local');
    }

    /**
     * @return Collection
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function getAll()
    {
        $file = $this->storage()->get($this->path);
        $data = json_decode($file, true);
        $collection = new Collection();
        foreach ($data ?? [] as $item) {
            $product = new Product();
            $product->setName($item['name'])
                    ->setQty($item['qty'])
                    ->setPrice($item['price'])
                    ->setId($item['id']);

            $collection->add($product);
        }
        return $collection;

    }

    public function toArray(Collection $collection)
    {
        $result = [];
        /** @var Model $item */
        foreach ($collection as $item) {
            $result[] = $item->toArray();
        }

        return $result;
    }
}