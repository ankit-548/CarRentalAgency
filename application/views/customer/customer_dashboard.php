<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Main content -->
    <section class="content">
      <div class="row">
          <img style="width: 100%; height: auto" src="https://images.pexels.com/photos/164634/pexels-photo-164634.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1">
      </div>
      <div style="text-align: center;">
        <h3>Available Cars To Rent</h3>
      </div>
      <div class="container">
        <div>
          <?php if($this->session->flashdata('msg')) { echo $this->session->flashdata('msg'); $this->session->unset_userdata('msg');}?>
        </div>
        <div class="d-flex justify-content-evenly flex-wrap">
          <div class="card p-2 flex-fill">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table">
                  <thead class="table-dark">
                    <tr>
                      <th scope="col">Sr. No.</th>
                      <th scope="col">Model</th>
                      <th scope="col">Vehicle Number</th>
                      <th scope="col">Seating capacity</th>
                      <th scope="col">Rent($)</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if(!isset($cars_list) || empty($cars_list)) {?>
                    <tr>                    
                      <td>No cars available to rent</td>
                    </tr>
                    <?php } else { 
                    $i=1;
                    foreach($cars_list as $car) {
                      $booked = false;
                      if(isset($car['rent_days']) && !empty($car['rent_days'])) {
                        $date = new DateTime($car['rent_start_date']);
                        $booked_till = $date->modify('+'.$car['rent_days'].' days');
                        $today_date = new DateTime();
                        $booked = $booked_till>$today_date ? true : false;
                      }
                    ?>
                    <tr>
                      <td><?php echo $i++;?></td>
                      <td><?php echo $car['vehicle_model'];?></td>
                      <td><?php echo $car['vehicle_number'];?></td>
                      <td><?php echo $car['seating_capacity'];?></td>
                      <td><?php echo $car['rent'];?></td>
                      <?php if($booked) { ?>
                        <td style="color: green">Booked</td>
                      <?php } else if(!isset(session_get('user')['id'])) { ?> 
                        <td><button class="btn btn-primary" onclick="handle_signIn()" row_id="<?php echo $car['id'];?>" vehicle_model="<?php echo $car['vehicle_model'];?>" vehicle_number="<?php echo $car['vehicle_number'];?>" seating_capacity="<?php echo $car['seating_capacity'];?>" rent="<?php echo $car['rent'];?>">Rent Car</button></td>
                      <?php } else if(!session_get('user')['is_customer']) { ?>
                        <td><button class="btn btn-primary" onclick="show_alert()" row_id="<?php echo $car['id'];?>" vehicle_model="<?php echo $car['vehicle_model'];?>" vehicle_number="<?php echo $car['vehicle_number'];?>" seating_capacity="<?php echo $car['seating_capacity'];?>" rent="<?php echo $car['rent'];?>">Rent Car</button></td>
                      <?php } else { ?>                    
                      <td>
                        <div class="dropdown">
                          <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                            Rent Car
                          </button> 
                          <form action="<?php echo base_url('customer/rent_car')?>" method="post" class="dropdown-menu p-4">
                            <input hidden name="id" value="<?php echo $car['id'];?>">
                            <div class="mb-3">
                              <label for="" class="form-label">Days To Rent</label>
                              <input name="rent_days" type="number" class="form-control" id="" placeholder="5">
                            </div>
                            <div class="mb-3">
                              <label for="" class="form-label">Start Date</label>
                              <input name="rent_start_date" type="date" class="form-control" id="" placeholder="">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                          </form>                        
                        </div>
                      </td>
                      <?php } ?>
                    </tr>
                    <?php } } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>  
    <div class="modal fade" id="signUpModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">SignUp</h1>
          </div>
          <div class="modal-body">
          <form action="<?php echo base_url('customer/auth_signup')?>" method="post" class="row g-3">
            <div class="col-12">
                <label for="inputAddress" class="form-label">Name</label>
                <input name="name" type="text" class="form-control" id="inputAddress" placeholder="">
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
          <form action="<?php echo base_url('customer/auth_signin')?>" method="post" class="row g-3">
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
</div>


<script>
  function handle_signIn() {
    var myModal = new bootstrap.Modal(document.getElementById('signInModal'));
    myModal.show();
  }
  function show_alert() {    
    alert('Sorry, Car agency is not allowed to book a car.')
  }
</script>