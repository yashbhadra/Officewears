<?php
    //Php scipt to store the cart details of the customer in database
    //Initialize the session
    session_start();
    include('config.php');
    $cart = $_POST['data'];

        $total_amount = 0;
        $Customer_id = $_SESSION["id"];


        foreach($cart as $item){
            $total_amount = $total_amount + $item["price"];

        }

        $sql="INSERT INTO Orders (Customer_id, Amount) VALUES ($Customer_id,'$total_amount');";
        $result=mysqli_query($link,$sql);
        $order_id = 0;
        if($result){
            $order_id = mysqli_insert_id($link);
        }

        foreach($cart as $item){
            $prod_quantity = $item['count'];
            $prod_name = $item['name'];
            $fetch = "SELECT * FROM Product WHERE Type = '$prod_name';";
            $fetch_result = mysqli_query($link,$fetch);
            $row = mysqli_fetch_array($fetch_result,MYSQLI_ASSOC);
            $prod_id = $row['Product_id'];
            $insert_orderdetails = "INSERT INTO Order_details (Order_id,Product_id,Quantity)
                                    VALUES ('$order_id',
                                            '$prod_id',
                                            '$prod_quantity');";
            
            mysqli_query($link,$insert_orderdetails);

        }

    
?>
