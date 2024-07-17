<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Support\Cost\ShippingCost;
use App\Support\Cost\Contract\CostInterface;

class CheckoutController extends Controller {
    public function __construct(private CostInterface $cost) {}

    public function processCheckout(Request $request) {
        Log::info('API processCheckout called');

        // Validate the request
        $request->validate([
            'products' => 'required|array',
            'products.*' => 'exists:products,id',
            'quantities' => 'required|array',
            'quantities.*' => 'integer|min:1',
        ]);

        // Get the authenticated user
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'User not authenticated'], 401);
        }

        // Get the total cost including shipping
        $totalCost = $this->calculateTotalCost($request->products, $request->quantities);
        $shippingCost = new ShippingCost($this->cost);
        $totalCostWithShipping = $totalCost + $shippingCost->getCost();

        // Create the order
        $order = $this->createOrder($totalCostWithShipping, $user);

        // Attach products to the order
        foreach ($request->products as $productId) {
            $quantity = $request->quantities[$productId];
            $order->products()->attach($productId, ['quantity' => $quantity]);
        }

        // Clear the user's cart (assuming you have a method to do this)
        $this->clearCart($user);

        return response()->json(['message' => 'Order placed successfully', 'order_id' => $order->id, 'total_cost' => $totalCostWithShipping], 200);
    }

    private function calculateTotalCost($productIds, $quantities) {
        $totalCost = 0;
        foreach ($productIds as $productId) {
            $product = Product::find($productId);
            $quantity = $quantities[$productId];
            $totalCost += $product->price * $quantity;
        }
        return $totalCost;
    }

    private function getProductQuantity($productId) {
        // Assuming you have a method to get the quantity of a product in the cart
        return app('App\Support\Basket\BasketAtViews')->getProductQuantity($productId);
    }

    private function createOrder($totalCost, $user) {
        Log::info('Creating order for user: ' . $user->id . ' with total cost: ' . $totalCost);

        // Create a new order
        return Order::create([
            'customer_id' => $user->id,
            'price' => $totalCost,
            'date_placed' => Carbon::now(),
        ]);
    }

    private function clearCart($user) {
        // Assuming you have a method to clear the user's cart
        // This method should be implemented in your BasketAtViews or similar class
        app('App\Support\Basket\BasketAtViews')->clear();
    }
}