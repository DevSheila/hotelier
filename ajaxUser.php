<?php
include_once 'db.php';
session_start();

if (isset($_POST['signup'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!$email || !$password||!$username||!$name ) {
        header('Location:signup.php?empty');
    } else {

        $password = md5($password);
        $query =" INSERT INTO `user`( `name`, `username`, `email`, `password`, `type`) 
        VALUES ('$name','$username','$email','$password','client')";

        if ($connection->query($query) === TRUE) {
      
            header("Location: ./userIndex.php?userHome");
  
          } else {
        //   echo "Error: " . $query . "<br>" . $connection->error;

            header('Location:signup.php');
          }
    }
}


if(isset($_GET['cancel'])){
   $booking_room=$_GET['cancel'];
   $booking_room_pieces = explode(",", $booking_room);
   $booking_id=$booking_room_pieces[0]; // piece1
   $room_id=$booking_room_pieces[1]; // piece2

 
    // $priceQuery = "SELECT * FROM booking WHERE booking_id = '$booking_id'";
    // $price_result = mysqli_query($connection, $price_Query);
    // $price = mysqli_fetch_assoc($price_result);
    // if(($price['total_price']) == 0){
    //     header("Location: ./userIndex.php?userHome?cancelled");
    // }else{
        $cancelBooking = "UPDATE booking SET total_price='0',remaining_price = '0',payment_status = '1' where booking_id = '$booking_id'";
        $result = mysqli_query($connection, $cancelBooking);
        if ($result) {
            $cancelRoom = "UPDATE room SET status = NULL,check_in_status = '0',check_out_status = '1' WHERE room_id = '$room_id'";
            $cancelResult = mysqli_query($connection, $cancelRoom);
            if ($cancelResult) {
             header("Location: ./userIndex.php?userHome?success");
     
             //    echo "booking canceled";
            } else {
              
             //    echo"Problem in cancelling booking.Please contact hotel receptionist";
                header("Location: ./userIndex.php?userHome?cancelerror1");
     
            }
        } else {
            $error="Error: " . $cancelBooking . "<br>" . $connection->error;
        
         header("Location: ./userIndex.php?userHome?cancelerror2");
     
     
        }
    // }
 

   
}

?>