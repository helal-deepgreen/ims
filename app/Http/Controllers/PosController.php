<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Gloudemans\Shoppingcart\Facades\Cart;

class PosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
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

        $carts = Cart::content();



        $query = Order::query();

        if($request->ajax()){

            $dueCylinder= Order::where(['customer_id'=>$request->customer_id])->first();
            return response()->json(['dueCylinder'=>$dueCylinder]);
        }
        return view('pos.index', [

            'products' => $products,
            'customers' => $customers,
            'carts' => $carts,
        ]);
    }

    /**
     * Handle add product to cart.
     */
    public function addCartItem(Request $request)
    {
        $rules = [
            'id' => 'required|numeric',
            'name' => 'required|string',
            'price' => 'required|numeric',
        ];

        $validatedData = $request->validate($rules);

        Cart::add([
            'id' => $validatedData['id'],
            'name' => $validatedData['name'],
            'qty' => 1,
            'price' => $validatedData['price']
        ]);

        return Redirect::back()->with('success', 'Product has been added to cart!');
    }

    /**
     * Handle update product in cart.
     */
    public function updateCartItem(Request $request, $rowId)
    {
        // dd($request->all());
        $rules = [
            'qty' => 'required|numeric',
            // 'price' => 'required|numeric',
        ];

        $validatedData = $request->validate($rules);

        Cart::update($rowId, $validatedData['qty']);
        // $updata = Cart::find($rowId);
        // $updata->qty = $request->qty;
        // $updata->price = $request->price;
        // $updata->save();

        return Redirect::back()->with('success', 'Product has been updated from cart!');
    }
    public function updatePrice(Request $request, $rowId)
    {
        // dd($request->all());
        // $update = Product::update([
        //     'selling_price' =>$request->price,
        // ]);

        $rules = [
            'price' => 'required|numeric',
            // 'price' => 'required|numeric',
        ];

        $validatedData = $request->validate($rules);

        Cart::update($rowId, ['price' => $request->price]);
        // $update = Product::find($id);
        // $update->selling_price = $request->price;
        // $update->save();


        return Redirect::back()->with('success', 'Product price has been updated');
    }
    /**
     * Handle delete product from cart.
     */
    public function deleteCartItem(String $rowId)
    {
        Cart::remove($rowId);

        return Redirect::back()->with('success', 'Product has been deleted from cart!');
    }

    /**
     * Handle create an invoice.
     */
    public function createInvoice(Request $request)
    {
        $rules = [
            'customer_id' => 'required|string'
        ];

        $customer_type = $request->new;
        $return_cylinder = $request->return;

        $validatedData = $request->validate($rules);
        $customer = Customer::where('id', $validatedData['customer_id'])->first();
        $carts = Cart::content();




        return view('pos.create', [
            'customer_type' =>$customer_type,
            'return' =>$return_cylinder,
            'customer' => $customer,
            'carts' => $carts
        ]);
    }

    // public function dueCylinder(Request $request){
    //     $query = Order::query();

    //     if($request->ajax()){
    //        $dueCylinder = $query->where('customer_id',$request->customer_id)->get();
    //         return response()->json(['dueCylinder'=>$dueCylinder]);
    //     }else{
    //         // $students = $query->get();
    //         // return view('student.index',compact('students'));
    //     }
    // }
}
