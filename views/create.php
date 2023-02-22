<?php 
include_once('../handlers/results.inc.php');
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>BinCom Test | Promise Ogbonnaya</title>

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" crossorigin="anonymous">
	<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css"> -->
  <link rel="stylesheet" type="text/css" href="../DataTables/datatables.css">
</head>
<body>

	<div class="main-panel">
        <div class="container">
          <div class="row mt-5">
            <div class="col-md-12 mt-5">
            	<h2 class="fs-5 text-center">Store/Save Result</h2>
            	<form method="post" action="../handlers/results.inc.php" id="store_form">
            		<div class="alert msg"></div>
				  <div class="form-group mb-3">
				    <label for="party">Party</label>
				    <select name="party" class="form-control p-3">
				    	<option selected disabled>---Select party---</option>
				    	<?php foreach ($parties as $value): ?>
				    		<option value="<?= $value['partyname'] ?>"> <?= $value['partyname'] ?> </option>
				    	<?php endforeach ?>
				    </select>
				    <span class="text-danger party"></span>
				  </div>

				  <div class="form-group mb-3">
				    <label for="unit">Polling Unit</label>
				    <select name="unit" class="form-control p-3">
				    	<option selected disabled>---Select polling unit---</option>
				    	<?php 
				    		for ($i=1; $i <= 50 ; $i++) { ?>
				    			<option value="<?= $i?>"> <?= $i ?> </option>
				    		<?php }
				    	?>
				    </select>
				    <span class="text-danger unit"></span>
				  </div>

				  <div class="form-group mb-3">
				    <label for="score">Party Score</label>
				    <input type="number" class="form-control p-3" id="score" placeholder="Enter No. of Votes" name="score"> <br>
				    <span class="text-danger score"></span>
				  </div>
				  <div class="form-group mb-3">
				    <label for="staff">Staff</label>
				    <input type="text" class="form-control p-3" id="staff" placeholder="Enter your name" name="staff"> <br>
				    <span class="text-danger staff"></span>
				  </div>

				  <input type="text" name="ip_address" value="<?= getenv("REMOTE_ADDR") ?>" hidden>
				  <button type="submit" class="btn btn-primary" name="submit">Submit</button>
				</form>       
          	</div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial -->
    </div>
      <!-- main-panel ends -->

<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script src="js/store_vote.js"></script>
<script type="text/javascript" charset="utf8" src="../DataTables/datatables.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>

</body>
</html>