<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::content();
        return view('cart', compact('cartItems'));
    }

    public function add(Request $request, Product $product)
    {
        Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'qty' => $request->quantity ?? 1,
            'price' => $product->price,
        ]);

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect()->back()->with('success', 'Товар добавлен в корзину');
    }

    public function remove(Request $request, $rowId)
    {
        Cart::remove($rowId);
        return redirect()->back()->with('success', 'Товар удален из корзины');
    }

    public function update(Request $request, $rowId)
    {
        Cart::update($rowId, $request->quantity);
        return redirect()->back()->with('success', 'Количество товара обновлено');
    }

    public function clear()
    {
        Cart::destroy();
        return redirect()->back()->with('success', 'Корзина очищена');
    }

    public function checkout()
    {
        if (Cart::count() === 0) {
            return redirect()->route('cart')
                ->with('error', 'Корзина пуста');
        }

        try {
            DB::beginTransaction();

            // Проверяем наличие товаров на складе
            foreach (Cart::content() as $item) {
                $product = Product::find($item->id);
                
                if (!$product) {
                    throw new \Exception("Товар {$item->name} больше не доступен");
                }

                if ($product->quantity < $item->qty) {
                    throw new \Exception("Товар {$product->name} доступен только в количестве {$product->quantity} шт.");
                }
            }

            // Создаем заказ
            $total = Cart::content()->sum(function($item) {
                return $item->price * $item->qty;
            });

            $order = Order::create([
                'user_id' => auth()->id(),
                'status' => 'new',
                'total_amount' => $total
            ]);

            // Добавляем товары и уменьшаем их количество на складе
            foreach (Cart::content() as $item) {
                $product = Product::find($item->id);
                
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->id,
                    'quantity' => $item->qty,
                    'price' => $item->price,
                ]);

                // Уменьшаем количество товара на складе
                $product->decrement('quantity', $item->qty);
            }

            Cart::destroy();
            DB::commit();

            return redirect()->route('orders.show', $order)
                ->with('success', 'Заказ успешно оформлен');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Ошибка при оформлении заказа: ' . $e->getMessage());
            
            return redirect()->route('cart.index')
                ->with('error', $e->getMessage() ?: 'Произошла ошибка при оформлении заказа');
        }
    }
} 