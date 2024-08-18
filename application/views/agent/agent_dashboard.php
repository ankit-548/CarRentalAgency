<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Main content -->
    <section class="content">
      <div class="row">
          <img style="width: 100%; height: auto" src="https://images.pexels.com/photos/164634/pexels-photo-164634.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1">
      </div>
      <div class="container">
        <div class="row">
          <div class="col-8">
            <table class="table table-striped">
              <thead>
                <tr>
                  <td>td1</td>
                  <td>td2</td>
                  <td>td3</td>
                  <td>td4</td>
                  <td>td5</td>
                </tr>
              </thead>
              <tbody>
                  <tr>
                    <th>th1</th>
                  </tr>
              </tbody>
             </table>
          </div>
          <div class="col-4">
            <div class="card" style="width: 18rem;">
              <img src="https://images.unsplash.com/photo-1616792577902-f1d86383a21b?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8ODd8fGJpZyUyMGNhcnxlbnwwfHwwfHx8MA%3D%3D" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Welcome: <?php echo session_get('user')['name']?></h5>
                <p class="card-text">Welcome to the car rentals, you may add new cars in your list from here.</p>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Add New Car</button>
              </div>
            </div>
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
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="<?php echo base_url('agent/add_new_car')?>" method="post" class="row g-3">
              <div class="col-12">
                  <label for="" class="form-label">Vehicle model</label>
                  <input name="vehicle_model" type="text" class="form-control" id="" placeholder="">
              </div>
              <div class="col-md-12">
                  <label for="" class="form-label">Vehicle number</label>
                  <input name="vehicle_number" type="text" class="form-control" id="">
              </div>
              <div class="col-md-12">
                  <label for="" class="form-label">seating capacity</label>
                  <input name="seating_capacity" type="number" class="form-control" id="">
              </div>            
              <div class="col-12">
                  <label for="" class="form-label">rent per day</label>
                  $<input name="rent" type="number" class="form-control" id="" placeholder="500">
              </div>
              <div class="col-12">
                  <button type="submit" class="btn btn-primary btn-lg">Add</button>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
</div>