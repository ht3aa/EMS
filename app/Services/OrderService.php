<?php

namespace App\Services;

use App\Repositories\CartRepository;
use App\Repositories\OrderRepository;
use App\Services\Interfaces\ControllerInterface;
use Illuminate\Http\Request;

class OrderService implements ControllerInterface
{
    public function __construct(private CartRepository $cartRepository, private OrderRepository $orderRepository, private ResponseService $responseService) {}

    public function index() {}

    public function store(Request $request)
    {

        // get the cart quantity from the request
        $cart = $this->cartRepository->find($request->cart_id);

        // create the order
        $order = $this->orderRepository->create([
            'cart_id' => $cart->id,
        ]);

        // update product stock
        $cart->product->update([
            'stock' => $cart->product->stock - $cart->quantity,
        ]);

        // delete the cart
        $this->cartRepository->delete($cart->id);


        return $this->responseService->created($order, __('order.created'));

    }

    public function show(Request $request) {}

    public function update(Request $request, string $id) {}

    public function destroy(string $id) {}
}
