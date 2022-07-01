<?php
if (isset($_GET['room_id'])){
    $get_room_id = $_GET['room_id'];
    $get_room_sql = "SELECT * FROM room NATURAL JOIN room_type WHERE room_id = '$get_room_id'";
    $get_room_result = mysqli_query($connection,$get_room_sql);
    $get_room = mysqli_fetch_assoc($get_room_result);

    $get_room_type_id = $get_room['room_type_id'];
    $get_room_type = $get_room['room_type'];
    $get_room_no = $get_room['room_no'];
    $get_room_price = $get_room['price'];
}

?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                    <em class="fa fa-home"></em>
                </a></li>
            <li class="active">Reservation</li>
        </ol>
    </div><!--/.row-->

    <!-- <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Reservation</h1>
        </div>
    </div>/.row -->

    

    <div class="row">
        <div class="col-lg-12">
            <form role="form" id="booking" data-toggle="phonenumber">
                <div class="response"></div>
                <div class="col-lg-12">
                    <?php
                    if (isset($_GET['room_id'])){?>

                        <div class="panel panel-default">
                            <div class="panel-heading">Room Information:
                                <a class="btn btn-secondary pull-right" href="index.php?room_mang">Replan Booking</a>
                            </div>
                            <div class="panel-body">
                                <div class="form-group col-lg-6">
                                    <label>Room Type</label>
                                    <select class="form-control" id="room_type" data-error="Select Room Type" required>
                                        <option selected disabled>Select Room Type</option>
                                        <option selected value="<?php echo $get_room_type_id; ?>"><?php echo $get_room_type; ?></option>
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label>Room No</label>
                                    <select class="form-control" id="room_no" onchange="fetch_price(this.value)" required data-error="Select Room No">
                                        <option selected disabled>Select Room No</option>
                                        <option selected value="<?php echo $get_room_id; ?>"><?php echo $get_room_no; ?></option>
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label>Check In Date</label>
                                    <input type="text" class="form-control" placeholder="mm/dd/yyyy" id="check_in_date" data-error="Select Check In Date" required>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label>Check Out Date</label>
                                    <input type="text" class="form-control" placeholder="mm/dd/yyyy" id="check_out_date" data-error="Select Check Out Date" required>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="col-lg-12">
                                    <h4 style="font-weight: bold">Total Days : <span id="staying_day">0</span> Days</h4>
                                    <h4 style="font-weight: bold">Price: <span id="price"><?php echo $get_room_price; ?></span> /-</h4>
                                    <h4 style="font-weight: bold">Total Amount : <span id="total_price">0</span> /-</h4>
                                </div>
                            </div>
                        </div>
                    <?php } else{?>
                        <div class="panel panel-default">
                            <div class="panel-heading">Room Information:
                                <a class="btn btn-secondary pull-right" style="border-radius:0%" href="index.php?reservation">Replan Booking</a>
                            </div>
                            <div class="panel-body">
                                <div class="form-group col-lg-6">
                                    <label>Room Type</label>
                                    <select class="form-control" id="room_type" onchange="fetch_room(this.value);" required data-error="Select Room Type">
                                        <option selected disabled>Select Room Type</option>
                                        <?php
                                        $query  = "SELECT * FROM room_type";
                                        $result = mysqli_query($connection,$query);
                                        if (mysqli_num_rows($result) > 0){
                                            while ($room_type = mysqli_fetch_assoc($result)){
                                                echo '<option value="'.$room_type['room_type_id'].'">'.$room_type['room_type'].'</option>';
                                            }}
                                        ?>
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label>Room No</label>
                                    <select class="form-control" id="room_no" onchange="fetch_price(this.value)" required data-error="Select Room No">

                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label>Check In Date</label>
                                    <input type="text" class="form-control" placeholder="mm/dd/yyyy" id="check_in_date" data-error="Select Check In Date" required>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label>Check Out Date</label>
                                    <input type="text" class="form-control" placeholder="mm/dd/yyyy" id="check_out_date" data-error="Select Check Out Date" required>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="col-lg-12">
                                    <h4 style="font-weight: bold">Total Days : <span id="staying_day">0</span> Days</h4>
                                    <h4 style="font-weight: bold">Price: <span id="price">0</span> /-</h4>
                                    <h4 style="font-weight: bold">Total Amount : <span id="total_price">0</span> /-</h4>
                                </div>
                            </div>
                        </div>
                    <?php }
                    ?>
                    <div class="panel panel-default">
                    
               
                        <div class="panel-heading">Customer Detail:</div>
                        <div class="panel-body">

                        
                        <div id="success-msg" class="col-lg-12">
                    </div>
                            <div class="form-group col-lg-6">
                                <label>First Name</label>
                                <input class="form-control" onkeyup="firstnameValidate()" placeholder="First Name" id="first_name" data-error="Enter First Name" required>
                                <div id="fname-error" class=""></div>
                            </div>

                            <div class="form-group col-lg-6">
                                <label>Last Name</label>
                                <input class="form-control" onkeyup="lastnameValidate()" placeholder="Last Name" id="last_name">
                                <div id="lname-error" class=""></div>
                            
                            </div>

                            <div class="form-group col-lg-6">
                                <label>Contact Number</label>
                                <input type="number" class="form-control" onkeyup="contactValidate()"  data-error="Enter Min 10 Digit" data-minlength="10" data-maxlength="10" placeholder="Contact No" id="contact_no" required>
                                <div   id="contact-error" class=""></div>
                                
                            </div>

                            <div class="form-group col-lg-6">
                                <label>Email Address</label>
                                <input type="email" class="form-control"  onkeyup="emailValidate()"placeholder="Email Address" id="email" data-error="Enter Valid Email Address" required>
                                <div id="email-error" class=""></div>
                            </div>

                            <div class="form-group col-lg-6">
                                <label>ID Card Type</label>
                                <select class="form-control" id="id_card_id" data-error="Select ID Card Type" required onchange="validId(this.value);">
                                    <option selected disabled>Select ID Card Type</option>
                                    <?php
                                    $query  = "SELECT * FROM id_card_type";
                                    $result = mysqli_query($connection,$query);
                                    if (mysqli_num_rows($result) > 0){
                                        while ($id_card_type = mysqli_fetch_assoc($result)){
                                            echo '<option value="'.$id_card_type['id_card_type_id'].'">'.$id_card_type['id_card_type'].'</option>';
                                        }}
                                    ?>
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group col-lg-6">
                                <label>Selected ID Card Number</label>
                                <input type="text" class="form-control"onkeyup="cardValidate()" placeholder="ID Card Number" id="id_card_no" data-minlength="10" data-maxlength="10" data-error="Enter Valid ID Card No" required>
                                <div  id="card-error"></div>
                            </div>

                            <div class="form-group col-lg-12">
                                <label>Residential Address</label>
                                <input type="text" class="form-control" onkeyup="addressValidate()"placeholder="Full Address" id="address" required>
                                <div id="address-error"></div>
                            </div>
                        </div>
                    </div>
                    <button type="submit"  class="btn btn-lg btn-success pull-right reservation-btn" id="reservation-btn"style="border-radius:0%">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <!-- <p class="back-link">Developed By Prem Chand Saini</p> -->
        </div>
    </div>

</div>    <!--/.main-->


<!-- Booking Confirmation-->
<div id="bookingConfirm" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center"><b>Room Booking</b></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert bg-success alert-dismissable" role="alert"><em class="fa fa-lg fa-check-circle">&nbsp;</em>Room Successfully Booked</div>
                        <table class="table table-striped table-bordered table-responsive">
                       
                            <tbody>
                            <tr>
                                <td><b>Customer Name</b></td>
                                <td id="getCustomerName"></td>
                            </tr>
                            <tr>
                                <td><b>Room Type</b></td>
                                <td id="getRoomType"></td>
                            </tr>
                            <tr>
                                <td><b>Room No</b></td>
                                <td id="getRoomNo"></td>
                            </tr>
                            <tr>
                                <td><b>Check In</b></td>
                                <td id="getCheckIn"></td>
                            </tr>
                            <tr>
                                <td><b>Check Out</b></td>
                                <td id="getCheckOut"></td>
                            </tr>
                            <tr>
                                <td><b>Total Amount</b></td>
                                <td id="getTotalPrice"></td>
                            </tr>
                            <tr>
                                <td><b>Payment Status</b></td>
                                <td id="getPaymentStaus"></td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-primary" style="border-radius:60px;" href="index.php?reservation"><i class="fa fa-check-circle"></i></a>
            </div>
        </div>

    </div>
</div>




<script>
    const button = document.getElementById('reservation-btn')

    var bookingform=document.getElementById('booking');

    var contactnumber= document.getElementById('contact_no');
    var fname= document.getElementById('first_name');
    var lname= document.getElementById('last_name');
    var email= document.getElementById('email');
    var address= document.getElementById('address');
    var cardId= document.getElementById('id_card_id');
    var cardNo= document.getElementById('id_card_no');

    

    var fnameerror= document.getElementById("fname-error");
    var lnameerror= document.getElementById("lname-error");
    var contacterror= document.getElementById("contact-error");
    var emailerror= document.getElementById("email-error");
    var addresserror= document.getElementById("address-error");
    var carderror= document.getElementById("card-error");

    var successmsg=document.getElementById("success-msg");

    var usernamRegex = /^[a-zA-Z]+$/;
    var usernamRegex =/^[a-zA-Z\s]*$/g;

    bookingform.addEventListener('submit',(e)=>{
        e.preventDefault();
        console.log(contactnumber.value);

        successmsg.innerText="Booking Successful";
        successmsg.className="alert alert-success";
        setTimeout("contacterror.style.visibility = 'hidden'", 5000);
        alert("booking successfull");
        // bookingform.reset();


     

    })



    function contactValidate(){
        var phoneno = /^\d{10}$/;
        if(contactnumber.value.match(phoneno)){
            // contacterror.innerText="";
            // contacterror.className="";
            contacterror.innerText="Valid contact";
            contacterror.className="alert alert-success";
            setTimeout("contacterror.style.visibility = 'hidden'", 2000);
            button. disabled = false;
        return true;
        }else{
            contacterror.style.visibility = 'visible';
            contacterror.innerText="Enter valid phone number of 10 Digit";
            contacterror.className="alert alert-danger";
            button. disabled = true;
            return false;
        }

        if(contactnumber.value == ''){
            button. disabled = true;  
        }
    }

    function emailValidate(){
        var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if(email.value.match(mailformat)){
            // emailerror.innerText="";
            // emailerror.className="";
            emailerror.innerText="Valid email";
            emailerror.className="alert alert-success";
            setTimeout("emailerror.style.visibility = 'hidden'", 2000);
            button. disabled = false;
            return true;
        }else{
            emailerror.style.visibility = 'visible';

            emailerror.innerText="You have entered an invalid email address!";
            emailerror.className="alert alert-danger";
            button. disabled = true;
            return false;
        }
        if(email.value == ''){
            button. disabled = true;  
        }
    }

    function firstnameValidate(){ 
        var letters = /^[A-Za-z]+$/;
        // first name validation
        if(fname.value.match(letters)){
            // fnameerror.innerText="";
            // fnameerror.className="";
            fnameerror.innerText="Valid name";
            fnameerror.className="alert alert-success";
            setTimeout("fnameerror.style.visibility = 'hidden'", 2000);
            button. disabled = false;
            return true;
        }else{
            // uname.focus();
            fnameerror.style.visibility = 'visible';
            fnameerror.innerText="First Name must have alphabet.No spaces";
            fnameerror.className="alert alert-danger";
            button. disabled = true;
            return false;
        }
        if(fname.value == ''){
            button. disabled = true;  
        }

    }

    function lastnameValidate(){ 
        var letters = /^[A-Za-z]+$/;
        // last name validation
        if(lname.value.match(letters)){
            // lnameerror.innerText="";
            // lnameerror.className="";
            lnameerror.innerText="Valid name";
            lnameerror.className="alert alert-success";
            setTimeout("lnameerror.style.visibility = 'hidden'", 2000);
            button. disabled = false;
            return true;
        }else{
            lnameerror.style.visibility = 'visible';
            lnameerror.innerText="Last Name must have alphabet.No spaces";
            lnameerror.className="alert alert-danger";
            button. disabled = true;
            return false;
        }
        if(lname.value == ''){
            button. disabled = true;  
        }
    }

    function addressValidate(){ 
        var addressvalidator = /^[a-zA-Z0-9\s]*$/g;
        if(address.value.match(addressvalidator)){
            // addresserror.innerText="";
            // addresserror.className="";
            addresserror.innerText="Valid address";
            addresserror.className="alert alert-success";
            setTimeout("addresserror.style.visibility = 'hidden'", 2000);
            button. disabled = false;
            return true;
        }else{
            addresserror.style.visibility = 'visible';

            addresserror.innerText="Address must have letters and numbers and spaces";
            addresserror.className="alert alert-danger";
            button. disabled = true;
            return false;
        }

        if(address.value == ''){
            button. disabled = true;  
        }
    }
   

    function cardValidate(){ 
        var nationalcard =/^[0-9]{10}$/; //10characters
        var voterCard= /^[A-Z0-9]{12}$/;//capital letters,/, and 7digits 
        var panCard= /^[A-Z0-9]{10}$/;//capital letters and 7digits 
        var drivingCard = /^[A-Z0-9\s]{12}$/g;// capital letters,spaces ,and digits

       if(cardId.value == 1){

            if(cardNo.value.match(nationalcard)){
              carderror.innerText="Valid card";
                carderror.className="alert alert-success";
                setTimeout("carderror.style.visibility = 'hidden'", 2000);
                button.disabled = false;
                return true;
            }else{
                carderror.style.visibility = 'visible';

                carderror.innerText="Card must have 10 characters";
                carderror.className="alert alert-danger";
                button.disabled = true;

                return false;
            }
       }else if(cardId.value ==2){
        if(cardNo.value.match(voterCard)){
              carderror.innerText="Valid card";
                carderror.className="alert alert-success";
                setTimeout("carderror.style.visibility = 'hidden'", 2000);
                
                button.disabled = false;
                return true;
            }else{
                carderror.style.visibility = 'visible';

                carderror.innerText="Card must have 12 characters";
                carderror.className="alert alert-danger";
                button.disabled = true;

                return false;
            }

       }else if(cardId ==3){
        if(cardNo.value.match(panCard)){
              carderror.innerText="Valid card";
                carderror.className="alert alert-success";
                setTimeout("carderror.style.visibility = 'hidden'", 2000);
                button.disabled = false;
                return true;
            }else{
                carderror.style.visibility = 'visible';
                carderror.innerText="Card must have 10 characters";
                carderror.className="alert alert-danger";
                button.disabled = true;
                return false;
            }

       }else if(cardId ==4){
        if(cardNo.value.match(drivingCard)){
              carderror.innerText="Valid card";
                carderror.className="alert alert-success";
                setTimeout("carderror.style.visibility = 'hidden'", 2000);
                button.disabled = false;
                return true;
            }else{
                carderror.style.visibility = 'visible';
                carderror.innerText="Card must have 12 characters";
                carderror.className="alert alert-danger";
                button.disabled = true;
                return false;
            }

       }else{

       }

       if(cardNo.value == ''){
            button. disabled = true;  
        }
    }
</script>


