<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\Test as TestService;

class TestController extends Controller
{
    public function index()
    {
        return view('test.index');
    }


    public function save(Request $request, TestService $service)
    {

        try {
            $product = $service->findProductOrNew($request->get('id'));

            $product->setName($request->get('product'))
                    ->setQty((int)$request->get('qty'))
                    ->setPrice((int)$request->get('price'))
                    ->setId($request->get('id'));

            $service->save($product);

            return response()->json(['message' => 'Success']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error', 'tech' => $e->getMessage()], 500);
        }

    }


    public function inform(Request $request, TestService $service)
    {
        $data = $service->getCalculatedData();

        return ['data' => $data];
    }
}
