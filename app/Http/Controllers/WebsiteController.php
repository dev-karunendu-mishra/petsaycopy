<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;


class WebsiteController extends Controller
{
    public function index() {
        $products = Product::first();
        return view('default.home', compact('products'));
    }

    public function placeOrder(Request $request) {
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
        Order::create($validatedData);
        $request->session()->flash('status', 'Your message has been sent successfully!');
        return redirect()->back();
    }
}
