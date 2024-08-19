<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private $indexView = 'admin.orders.all';
    private $storeRoute = 'admin.orders';
    private $editView = 'admin.orders.edit';
    private $deleteRoute = 'admin.orders';
    private $deleteMessage = 'Order deleted successfully.';
    private $createMessage = 'Order created successfully.';
    private $updateMessage = 'Order updated successfully.';

    private $columns = ["id"=>"ID", "name"=>"Name", "mobile"=>"Mobile","client_ip"=>"Client IP", "created_at"=>"Created At"];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records = Order::with(['product'])->get();
        return view($this->indexView,['columns'=>$this->columns,'edit'=>false,'records'=>$records,'model'=>null]);
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
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|regex:/^[0-9]{10}$/', // Assuming it's a 10-digit mobile number
            'address_line_one' => 'required|string|max:255',
            'address_line_two' => 'nullable|string|max:255',
            'pin' => 'required|string|size:6', // Assuming pin code is 6 digits
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'product_id' => 'required|exists:products,id', // Ensures that the Order exists
            'source' => 'nullable|string',
        ]);
        // Check if an order exists with the same mobile number in the last 30 days
        $existingOrder = Order::where('mobile', $validatedData['mobile'])
                    ->where('created_at', '>=', now()->subDays(30))
                    ->exists();

        if ($existingOrder) {
            return redirect()->back()->withErrors(['mobile' => 'You cannot place another order with this mobile number within a month.'])->withInput();
        }
        // Capture the client IP
        $validatedData['client_ip'] = $request->ip();

        // Store the order
        $order = Order::create($validatedData);

        //return response()->json($order, 201);
        return redirect()->route($this->storeRoute)->with('success', $this->createMessage);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        return view($this->editView,['columns'=>$this->columns, 'model'=>$order, 'edit'=>true]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
