<?php

namespace App\Services;


use App\Models\Model;
use App\Models\Product;
use App\Repositories\Json;

class Test extends Service
{
    protected $repo;

    public function __construct(Json $repository)
    {
        $this->repo = $repository;
    }


    public function save(Model $model)
    {

        if ($model->getId()) {
            $this->repo->update($model, $model->getId());
        } else {
            $this->repo->store($model);
        }
    }


    public function findProductOrNew($id = null)
    {
        $product = null;
        if ($id) {
            $product = $this->repo->find($id);
        }

        return $product ?? new Product();
    }


    public function getCalculatedData()
    {
        $collection = $this->repo->getAll();

        $lastRow = [
                'name' => 'Total',
                'qty' => 0,
                'price' => 0,
                'total' => 0
        ];
        $result = [];
        $index = 0;
        /** @var Product $item */
        foreach ($collection as $item) {
            $result[$index] = $item->toArray();
            $result[$index]['total'] = $item->getTotal();

            $lastRow['qty'] += $item->getQty();
            $lastRow['price'] += $item->getPrice();
            $lastRow['total'] += $item->getTotal();
            $index++;
        }
        $result[$index] = $lastRow;

        return $result;
    }
}