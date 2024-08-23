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
    <div class="d-flex justify-content-center align-items-center" style="height: 100vh;"></divclass>
        <button type="button" class="btn btn-primary btn-lg m-1" onclick="location.href='<?php echo base_url('customer'); ?>'">I'm a customer</button>
        <button type="button" class="btn btn-primary btn-lg m-1" onclick="location.href='<?php echo base_url('agent'); ?>'">I'm a agency person</button>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
