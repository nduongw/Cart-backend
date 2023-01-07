<?php

namespace App\Http\Controllers\OrderDetails;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderDetails;

class OrderDetailsController extends Controller
{
    public function getOrderDetails($id) {
        $order_details = OrderDetails::where('order_id', $id)->get();

        if ($order_details == null) {
            return response()->json(['Order does not exist', 400]);
        } else {
            return response()->json($order_details, 200);
        }

    }
}
