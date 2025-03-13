<?php

namespace App\Http\Controllers;

use App\Repositories\CartRepository;
use App\Services\ResponseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function __construct(private CartRepository $cartRepository, private ResponseService $responseService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate the request body
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $quantity = $request->quantity;

        // get the product
        $product = $this->cartRepository->find($request->product_id);

        // check if product is already in the cart
        $cart = Auth::user()->carts()->where('product_id', $request->product_id)->first();
        if ($cart) {

            // check if the product have not enugh stock
            if ($product->stock < $quantity + $cart->quantity) {
                return $this->responseService->error(__('product.not_enough_stock'));
            }

            $this->cartRepository->update([
                'quantity' => $cart->quantity + $quantity,
            ], $cart->id);

            return $this->responseService->success($cart, __('cart.updated'));
        }

        // check if the product have not enugh stock
        if ($product->stock < $request->quantity) {
            return $this->responseService->error(__('product.not_enough_stock'));
        }

        // create the cart
        $cart = $this->cartRepository->create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
        ]);

        // return the created cart
        return $this->responseService->created($cart, __('cart.created'));

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        // delete the cart
        $this->cartRepository->delete($id);
    }
}
