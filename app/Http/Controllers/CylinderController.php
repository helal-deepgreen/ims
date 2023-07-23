<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Support\Facades\Redirect;
use Gloudemans\Shoppingcart\Facades\Cart;
class CylinderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $row = (int) request('row', 10);

        if ($row < 1 || $row > 100) {
            abort(400, 'The per-page parameter must be an integer between 1 and 100.');
        }

        $products = Product::with(['category', 'unit'])
                ->filter(request(['search']))
                ->sortable()
                ->paginate($row)
                ->appends(request()->query());

        $customers = Customer::all()->sortBy('name');

        // $carts = Cart::content();
        $carts= session()->get('cylinder_cart');

        // return $carts;
        return view('cylinders.index', [
            'products' => $products,
            'customers' => $customers,
            'carts' => $carts,
        ]);
    }

    public function addCartItem(Request $request)
    {
        $rules = [
            'id' => 'required|numeric',
            'name' => 'required|string',
            'price' => 'required|numeric',
        ];

        $validatedData = $request->validate($rules);

        $cart= (object)[
            'id' => $validatedData['id'],
            'name' => $validatedData['name'],
            'qty' => 1,
            'return_cylinder' =>1,
            'price' => $validatedData['price']
        ];
        session()->put('cylinder_cart', $cart);

        // Cart::add([
        //     'id' => $validatedData['id'],
        //     'name' => $validatedData['name'],
        //     'qty' => 1,
        //     'return_cylinder' =>1,
        //     'price' => $validatedData['price']
        // ]);

        return Redirect::back()->with('success', 'Product has been added to cart!');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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
        //
    }
}
