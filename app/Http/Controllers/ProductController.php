<?php

namespace App\Http\Controllers;

use App\Repositories\ProductRepository;
use App\Services\ResponseService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(private ProductRepository $productRepository, private ResponseService $responseService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->responseService->success($this->productRepository->paginate(), __('product.fetched'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->responseService->success($this->productRepository->find($id), __('product.one_fetched'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
