<?php
require_once __DIR__.'/../_classes/order.class.php';
require_once __DIR__.'/../_classes/order-detail.class.php';
require_once __DIR__.'/../_classes/order-detail.class.php';
require_once __DIR__.'/../_classes/order-shipping-info.class.php';

$orderModel = new Order();
$orders = $orderModel->getOrders();
$enumValues = $orderModel->getEnumValuesForOrderStatus();

if(isset($_GET['order_status'])){
    $orderStatus=htmlspecialchars($_GET['order_status']);
    $orders=$orderModel->getOrdersByStatus($orderStatus);
}

function getOrderDetails($orderId){
    $orderDetailModel=new OrderDetail();
    $orderDetails=$orderDetailModel->getOrderDetailsByOrderId($orderId);
    return $orderDetails;
}

function getOrderShippingInfo($orderId){

    $orderShippingInfoModel=new OrderShippingInfo();
    $orderShippingInfos=$orderShippingInfoModel->getAllShippingInfo($orderId);
    return $orderShippingInfos;
}

?>