<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                    <em class="fa fa-home"></em>
                </a></li>
            <li class="active">Home</li>
        </ol>
    </div>
                     

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
            <div class="panel-heading">Reservation History
                <a class="btn btn-secondary pull-right" href="userIndex.php?userReservation">Create Reservation</a>
            </div>

            <div>
                <script>
                  
                    function onButtonPress() {
                        $('.alert').alert('close')

                        <?php 
                        
                        ?>
                    }
                </script>
            <?php

            if (isset($_GET['userHome?success'])){
                echo '<div class="alert alert-success  mx-5 mt-4 
                border border-success" role="alert">Booking Cancelled
                <button type="button" class="btn bg-success ml-4" 
                onclick="onButtonPress()">
                Close
            </button>
                </div>
            
                ';

            }elseif(isset($_GET['userHome?cancelerror1'])){
                echo '<div class="alert alert-danger  mx-5 mt-4 
                border border-success" role="alert">Problem in cancelling booking.Please contact hotel receptionist
                <button type="button" class="btn bg-success ml-4" 
                onclick="onButtonPress()">
                Close
            </button>
                </div>';


            }elseif(isset($_GET['userHome?cancelerror2'])){
                echo '<div class="alert alert-danger 
                border border-success" role="alert">Database Error
                
                <button type="button" class="btn bg-warning ml-4" 
                onclick="onButtonPress()">
                Close
            </button>
                </div>';



            }elseif(isset($_GET['userHome?cancelled'])){
                echo '<div class="alert alert-warning  mx-5 mt-4 
                border border-success" role="alert">
                Booking Already Cancelled
                <button type="button" class="btn bg-warning ml-4" 
                onclick="onButtonPress()">
                Close
            </button>
                
                </div>
                
                
                ';



            }
            

            ?>
            </div>
            <div class="panel-body">
            <table class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%"
                           >
              
                         
                        <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Room Type</th>
                            <th>Room Number</th>
                            <th>Booking Date</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            
                            <?php
                    $sql = "SELECT * FROM booking WHERE user_id =$user_id";
                    $result = mysqli_query($connection,$sql);
                    $count = mysqli_num_rows($result);
                    $serial = 1;
                    while( $row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                        $booking_id=$row['booking_id'];
                        $user_id=$row['user_id'];


                        $customer_id=$row['customer_id'];//name,numer,email,card type,id
                        $room_id=$row['room_id'];//room number ,room type
                        
                        $booking_date=$row['booking_date'];
                        $check_in=$row['check_in'];
                        $check_out=$row['check_out'];
                        $total_price=$row['total_price'];
                        $remaining_price=$row['remaining_price'];
                        $payment_status=$row['payment_status'];

                        $customer_name='';
                        $customer_contact='';
                        $customer_email='';
                        $customer_card_type='';
                        $customer_card_id='';
                        $customer_address='';


                        $room_number='';
                        $room_type='';
                        $room_type_id=0;

                        $customer_sql = "SELECT * FROM customer WHERE customer_id =$customer_id";
                        $customer_result = mysqli_query($connection,$customer_sql);
                        $customer_count = mysqli_num_rows($customer_result);

                        while( $customer_row = mysqli_fetch_array($customer_result,MYSQLI_ASSOC)){
                            $customer_name=$customer_row['customer_name'];
                            $customer_email=$customer_row['email'];
                            $customer_contact=$customer_row['contact_no'];
                            $customer_card_type=$customer_row['id_card_type_id'];
                            $customer_card_id=$customer_row['id_card_no'];
                            $customer_address=$customer_row['address'];
                        }

                        $room_sql = "SELECT * FROM room WHERE room_id =$room_id";
                        $room_result = mysqli_query($connection,$room_sql);
                        $room_count = mysqli_num_rows($room_result);
                        while( $room_row = mysqli_fetch_array($room_result,MYSQLI_ASSOC)){
                            // `room_type_id`, `room_no`
                            $room_type_id=$room_row['room_type_id'];
                            $room_number=$room_row['room_no'];

                        }

                        $room_type_sql = "SELECT * FROM room_type WHERE room_type_id =$room_type_id";
                        $room_type_result = mysqli_query($connection,$room_type_sql);
                        $room_type_count = mysqli_num_rows($room_type_result);
                        while( $room_row = mysqli_fetch_array($room_type_result,MYSQLI_ASSOC)){
                            // `room_type_id`, `room_no`
                            $room_type=$room_row['room_type'];
                        }

                        ?><tr>
                                            <td>
                                            
                                                <?php echo $serial?>
                                        </td>
                                        <td><?php echo $room_type; ?></td>
                                        <td><?php echo $room_number; ?></td>

                                        <td><?php echo $booking_date;?></td>
                                        <td><?php echo $check_in;?></td>
                                        <td><?php echo $check_out;?></td>
                             

                                    
                                    <td>
                                    <button title="Customer Information" data-toggle="modal" data-target="#cutomerDetailsModal<?php echo $serial?>"  id="cutomerDetails" class="btn btn-warning" style="border-radius:60px;"><i class="fa fa-eye"></i></button>
                                    <a  id="cancel" class="btn btn-danger" name="cancel"href="ajaxUser.php?cancel=<?php echo  $booking_id.','.$room_id;?>" style="border-radius:60px;"><i class="fa fa-trash"></i></a>
                                         
                                    </td>
                          </tr>


                                    <div id="cutomerDetailsModal<?php echo $serial?>" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title text-center"><b>Customer's Detail</b></h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-lg-3"></div>
                                                    <div class="col-lg-6">
                                                        <p><strong>   Customer Name:</strong> <?php echo $customer_name;?></p>
                                                        <p><strong>Customer Email:</strong><?php echo $customer_email;?></p>
                                                        <p><strong>Customer Address:</strong><?php echo $customer_address;?></p>
                                                        <p><strong>Customer Contact:</strong> <?php echo $customer_contact;?></p>
                                                        <p><strong>Customer Card Type:</strong> <?php echo $customer_card_type;?></p>
                                                        <p><strong>Customer Card Id:</strong> <?php echo $customer_card_id;?></p>

                                                        <p><strong>Payment Status:</strong> <?php echo $payment_status;?></p>
                                                        <p><strong>Total Price:</strong> <?php echo $total_price;?></p>
                                                        <p><strong>Remaining Price:</strong> <?php echo $remaining_price;?></p>

                                                        <?php 
                                                          
                                                            if($total_price == 0){
                                                       echo" <p ><strong>Status:</strong> booking cancelled</p>";
                                                            }

                                                        ?>
                                                    </div>
                                                    <div class="col-lg-3"></div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    </div>


               
                        
           

               


                        
                    <?php
                        $serial ++;
                    }
                ?>
                        


           

            </div>
        </div>
        </div>
     </div>
</div>

<?php



?>
