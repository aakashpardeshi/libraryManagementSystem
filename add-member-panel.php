<?php
    include('header.html');
   include('config.php');
?>

<body>
<div class="container">
       <div class="row">
            <h5>Add Member</h5>   
            
        </div>
        <br/>
        <div class="row">
        <form class="form" method="POST" action="add-member.php">

            <div class="form-group">
                <label for="mname">Member Name *:</label>
                <input type="text" class="form-control" name="mname" placeholder="Enter Member Name" required>
            </div>
            <div class="form-group">
                <label for="dob">Date of Birth *:</label>
                <input type="date" class="form-control" name="dob" placeholder="Enter Date of Birth" required>
            </div>
            <div class="form-group">
                <label for="city">City  *:</label>
                <input type="text" class="form-control" name="city" placeholder="City" required>
            </div>
            <div class="form-group">
                <label for="state">State *:</label>
                <input type="text" class="form-control" name="state" placeholder="State" default = 0 required>
            </div>
            <div class="form-group">
                <label for="streetNo">Street Number*:</label>
                <input type="number" class="form-control" name="streetNo" placeholder="Street Number" required>
            </div>
            <div class="form-group">
                <label for="streetName">Street Name*:</label>
                <input type="text" class="form-control" name="streetName" placeholder="Street Name" required>
            </div>
            <div class="form-group">
                <label for="aptNo">Appartment Number*:</label>
                <input type="number" class="form-control" name="aptNo" placeholder="Appartment Number" required>
            </div>
            <div class="form-group">
                <label for="pin">Pincode*:</label>
                <input type="number" class="form-control" name="pin" placeholder="Pincode" maxlength="6" required >
            </div>
            <br></br>
            <input type="submit" class="btn btn-success">
        </form>
    </div>
</div>
</body>