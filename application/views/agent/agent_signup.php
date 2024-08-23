<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Car Rental Agency</title>	
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="p-3 mb-2 bg-primary-subtle text-primary-emphasis">
    <div>
        <?php if($this->session->flashdata('msg')) { echo $this->session->flashdata('msg'); $this->session->unset_userdata('msg');}?>
    </div>
    <div class="position-absolute top-50 start-50 translate-middle border bg-dark text-light rounded p-5"></divclass>
        <form action="<?php echo base_url('agent/auth_signup')?>" method="post" class="row g-3">
            <div class="col-12">
                <label for="inputAddress" class="form-label">Car Rental Agency Name</label>
                <input name="name" type="text" class="form-control" id="inputAddress" placeholder="cardekho.com">
            </div>
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Email</label>
                <input name="email" type="email" class="form-control" id="inputEmail4">
            </div>
            <div class="col-md-6">
                <label for="inputPassword4" class="form-label">Password</label>
                <input name="password" type="password" class="form-control" id="inputPassword4">
            </div>            
            <div class="col-12">
                <label for="inputAddress2" class="form-label">Address</label>
                <input name="address" type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
            </div>
            <div class="col-12">
                <div class="form-check">
                <input required class="form-check-input" type="checkbox" id="gridCheck">
                <label class="form-check-label" for="gridCheck">
                    Check me out
                </label>
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-lg">Sign Up</button>
            </div>
        </form>
        <!-- <button type="button" class="btn btn-primary btn-lg" onclick="location.href='<?php echo base_url('agent/signup'); ?>'">SignUp</button>
        <button type="button" class="btn btn-primary btn-lg" onclick="location.href='<?php echo base_url('agent/login'); ?>'">LogIn</button> -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
