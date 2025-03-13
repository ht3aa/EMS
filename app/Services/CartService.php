<?php

namespace App\Services;

use App\Repositories\CartRepository;
use App\Repositories\ProductRepository;
use App\Services\Interfaces\ControllerInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartService implements ControllerInterface
{
    public function __construct(private CartRepository $cartRepository, private ProductRepository $productRepository, private ResponseService $responseService) {}

    public function index() {}

    public function store(Request $request)
    {

        $quantity = $request->quantity;

        // get the product
        $product = $this->productRepository->find($request->product_id);

        // check if product is already in the cart
        $cart = Auth::user()->carts()->where('product_id', $request->product_id)->first();
        if ($cart) {

            // check if the product have not enugh stock
            if ($product->stock < $quantity + $cart->quantity) {
                return $this->responseService->error(__('product.not_enough_stock'));
            }

            // update the cart quantity
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

    public function show(Request $request) {}

    public function update(Request $request, string $id) {}

    public function destroy(string $id)
    {
        // delete the cart
        $this->cartRepository->delete($id);

        return $this->responseService->success(null, __('cart.deleted'));
    }
}
