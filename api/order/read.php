<?php 
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once('../../config/db.php');
    include_once('../../model/order.php');

    $db = new Database();
    $connect = $db->connect();

    $order = new Order($connect);
    $order->order_id = 2;
    // $order = new Order($connect);
    // echo $order;
    $result = $order->read();

    $order_array = [];
    $order_array['data'] = [];

    foreach($result as $row) {
        extract($row);

        $order_item = array(
            'order_id' => $order_id,
            'customer_id' => $customer_id,
            'phone' => $phone,
            'address' => $address,
            'total' => $total,
            'created_time' => $created_time,
            'last_updated' => $last_updated
        );

        array_push($order_array['data'], $order_item);
    }

    echo json_encode($order_array, JSON_PRETTY_PRINT);
?>