<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Car Rental Agency</title>	
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="p-0 m-0 bg-primary-subtle text-primary-emphasis">
    <div class="content-wrapper">
        <secion class="content">
            <div class="d-flex">
                <div class="d-none d-md-block w-75 max-vh-100">
                    <img src="https://images.unsplash.com/photo-1557825631-19082bca3803?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MjZ8fGNhciUyMHJlbnRhbHxlbnwwfHwwfHx8MA%3D%3D" width="100%" alt="">
                </div>
                <div class="col-12 col-md-3">
                    <div class="card w-100 h-100">
                        <img src="https://images.pexels.com/photos/305070/pexels-photo-305070.jpeg?auto=compress&cs=tinysrgb&w=600" class="card-img-top" alt="...">
                        <div class="card-body">
                        <h5 class="card-title">Welcome</h5>
                        <p class="card-text">Welcome to the car rentals, you may SignUp/SignIn to your acccount from here.</p>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#signUpModal" data-bs-whatever="@mdo">SignUp</button>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#signInModal" data-bs-whatever="@mdo">SignIn</button>
                        </div>
                    </div>                        
                </div>
            </div>
            <div class="modal fade" id="signUpModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">SignUp</h1>
                    </div>
                    <div class="modal-body">
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
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="dispose_modal()" data-bs-dismiss="modal">Close</button>
                    </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="signInModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">SignIn</h1>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo base_url('agent/auth_signin')?>" method="post" class="row g-3">
                            <div class="col-md-6">
                                <label for="inputEmail4" class="form-label">Email</label>
                                <input name="email" type="email" class="form-control" id="inputEmail4">
                            </div>
                            <div class="col-md-6">
                                <label for="inputPassword4" class="form-label">Password</label>
                                <input name="password" type="password" class="form-control" id="inputPassword4">
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
                                <button type="submit" class="btn btn-primary btn-lg">LogIn</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="dispose_modal()" data-bs-dismiss="modal">Close</button>
                    </div>
                    </div>
                </div>
            </div>
        </secion>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
