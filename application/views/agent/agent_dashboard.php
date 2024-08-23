<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Main content -->
    <section class="content">
      <div class="row">
          <img style="width: 100%; height: auto" src="https://images.pexels.com/photos/164634/pexels-photo-164634.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1">
      </div>
      <div class="container">
        <div>
          <?php if($this->session->flashdata('msg')) { echo $this->session->flashdata('msg'); $this->session->unset_userdata('msg');}?>
        </div>
        <div class="d-flex justify-content-evenly flex-wrap">
          <div class="card p-2 flex-fill">
            <div class="card-body">
              <div style="text-align: center;">
                <h3>Available Cars</h3>
              </div>
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
                      <td>Please add cars to rent</td>
                    </tr>
                    <?php } else { 
                    $i=1;
                    foreach($cars_list as $car) {?>
                    <tr>
                      <td><?php echo $i++;?></td>
                      <td><?php echo $car['vehicle_model'];?></td>
                      <td><?php echo $car['vehicle_number'];?></td>
                      <td><?php echo $car['seating_capacity'];?></td>
                      <td><?php echo $car['rent'];?></td>
                      <td><button class="btn btn-primary" onclick="handle_update()" row_id="<?php echo $car['id'];?>" vehicle_model="<?php echo $car['vehicle_model'];?>" vehicle_number="<?php echo $car['vehicle_number'];?>" seating_capacity="<?php echo $car['seating_capacity'];?>" rent="<?php echo $car['rent'];?>"><i><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#0000F5"><path d="M200-200h57l391-391-57-57-391 391v57Zm-80 80v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm640-584-56-56 56 56Zm-141 85-28-29 57 57-29-28Z"/></svg></i>edit</button></td>
                    </tr>
                    <?php } } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="card" style="width: 18rem;">
            <img src="https://images.pexels.com/photos/305070/pexels-photo-305070.jpeg?auto=compress&cs=tinysrgb&w=600" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Welcome: <?php echo session_get('user')['name']?></h5>
              <p class="card-text">Welcome to the car rentals, you may add new cars in your list from here.</p>
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Add New Car</button>
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bookedCarsModal" data-bs-whatever="@mdo">Booked Cars</button>
            </div>
          </div>  
        </div>
      </div>
    </section>    
    <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@fat">Open modal for @fat</button>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap">Open modal for @getbootstrap</button> -->

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Add new car</h1>
          </div>
          <div class="modal-body">
            <form id="my_form" action="<?php echo base_url('agent/add_car')?>" method="post" class="row g-3">
              <input hidden name="id" value="" type="text" class="form-control" id="modal_id" placeholder="">
              <div class="col-12">
                  <label for="" class="form-label">Vehicle model</label>
                  <input name="vehicle_model" value="" type="text" class="form-control" id="modal_vehicle_model" placeholder="">
              </div>
              <div class="col-md-12">
                  <label for="" class="form-label">Vehicle number</label>
                  <input name="vehicle_number" value="" type="text" class="form-control" id="modal_vehicle_number">
              </div>
              <div class="col-md-12">
                  <label for="" class="form-label">seating capacity</label>
                  <input name="seating_capacity" value="" type="number" class="form-control" id="modal_seating_capacity">
              </div>            
              <div class="col-12">
                  <label for="" class="form-label">rent per day</label>
                  $<input name="rent" value="" type="number" class="form-control" id="modal_rent" placeholder="500">
              </div>
              <div class="col-12">
                  <button type="submit" class="btn btn-primary btn-lg">Add</button>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="dispose_modal()" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="bookedCarsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">List Of Booked Cars</h1>
          </div>
          <div class="modal-body p-2">
          <div class="table-responsive">
            <table class="table">
                  <thead class="table-dark">
                    <tr>
                      <th scope="col">Sr. No.</th>
                      <th scope="col">Model</th>
                      <th scope="col">Vehicle Number</th>
                      <th scope="col">Seating capacity</th>
                      <th scope="col">($)Rent/day</th>
                      <th scope="col">Rent By</th>
                      <th scope="col">Customer Email</th>
                      <th scope="col">Rent Days</th>
                      <th scope="col">Start Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $i=1;
                    $counter = 0;
                    foreach($cars_list as $car) {
                    if(isset($car['rent_by']) && !empty($car['rent_by'])) {
                      $counter++;
                    ?>
                    <tr>
                      <td><?php echo $i++;?></td>
                      <td><?php echo $car['vehicle_model'];?></td>
                      <td><?php echo $car['vehicle_number'];?></td>
                      <td><?php echo $car['seating_capacity'];?></td>
                      <td><?php echo $car['rent'];?></td>
                      <td><?php echo $car['customer_name'];?></td>
                      <td><?php echo $car['customer_email'];?></td>
                      <td><?php echo $car['rent_days'];?></td>
                      <td><?php echo $car['rent_start_date'];?></td>
                    </tr>
                    <?php } }
                    if($counter==0) { ?>
                    <tr>                    
                      <td>No cars Booked.</td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="dispose_modal()" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
</div>


<script>
  function handle_update() {
    var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
    const row = document.activeElement.attributes;
    document.getElementById('modal_id').value = row.row_id.value;
    document.getElementById('modal_vehicle_model').value = row.vehicle_model.value;
    document.getElementById('modal_vehicle_number').value = row.vehicle_number.value;
    document.getElementById('modal_seating_capacity').value = row.seating_capacity.value;
    document.getElementById('modal_rent').value = row.rent.value;
    myModal.show();
  }
  function dispose_modal() {    
    document.getElementById('modal_id').value = '';
    document.getElementById('modal_vehicle_model').value = '';
    document.getElementById('modal_vehicle_number').value = '';
    document.getElementById('modal_seating_capacity').value = '';
    document.getElementById('modal_rent').value = '';
  }
</script>