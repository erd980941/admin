<?php 
session_start();
    require_once __DIR__.'/../_classes/order.class.php';
    $orderModel=new Order();
    
    if (!isset($_SESSION['username']) || $_SESSION['adminLoggedIn'] !== true) {
        header('Location: ../pages/login');
        exit;
    }

    if (isset($_POST['update_order_status'])) {
        
        $orderId=htmlspecialchars($_POST['order_id']);
        $orderStatus=htmlspecialchars($_POST['order_status']);
    

        $result=$orderModel->updateOrderStatus($orderId,$orderStatus);
        
        if ($result) {
            header("Location:../pages/order-list?success=true");
            exit();
        } else {
            header("Location:../pages/order-list?error=true");
            exit();
        }
    } 
    else if(isset($_POST['update_shipping_tracking_number'])){

        $orderId=htmlspecialchars($_POST['order_id']);
        $trackingNumber=htmlspecialchars($_POST['shipping_tracking_number']);

        $result =$orderModel->updateTrackingNumber($orderId,$trackingNumber);
        if ($result) {
            header("Location:../pages/order-list?success=true");
            exit();
        } else {
            header("Location:../pages/order-list?error=true");
            exit();
        }

    }
    else if (isset($_GET['order_id'])&&$_GET['delete']=='true') {
        $orderId=htmlspecialchars($_GET['order_id']);
        $result =$orderModel->deleteOrder($orderId);
        if ($result) {
            header("Location:../pages/order-list?success=true");
            exit();
        } else {
            header("Location:../pages/order-list?error=true");
            exit();
        }
    }
    else{
        header("Location:../pages/order-list?error=true");
        exit();
    }

    
?>