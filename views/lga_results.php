<?php 
include_once('../handlers/lga_result.inc.php');
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
            	<h2 class="fs-5 text-center">Total Votes Of Polling Units(LGAs, Delta State)</h2>
            	<form class="form-group w-25 my-3">
            		<label>Select Polling unit</label>
            		<select class="form-control" name="lga">
            				<option selected disabled>--Select LGA--</option>
            			<?php foreach ($lga as  $value): ?>
            				<option value="<?= $value["lga_id"] ?>"> <?= $value["lga_name"] ?> </option>
            			<?php endforeach ?>
            		</select>
            	</form>
                <div class="table-responsive pt-3">
	                <table class="table table-striped table-bordered shadow text-center project-orders-table mx-auto mt-5" id="table_id">
	                    <thead>
	                      <tr>
	                        <th class="text-center">ID</th>
	                        <th class="text-center">Party Name</th>
	                        <th class="ml-5 text-center">Total Vote</th>
	                      </tr>
	                    </thead>
	                    <tbody>
	                      
	                 	</tbody>

	                 	<tfoot>
	                 		<tr>
	                 			<td class="text-center">***</td>
	                 			<td class="text-center">Total</td>
	                 			<td class="total text-center"></td>
	                 		</tr>
	                 	</tfoot>
                	</table>
            	</div>
          	</div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial -->
    </div>
      <!-- main-panel ends -->

<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script type="text/javascript" charset="utf8" src="../DataTables/datatables.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>

<script>
    $(document).ready(function () {
        $('#table_id').DataTable();
    });
</script>

<script>

	$(document).ready(function() {
	  $('select').on('change', function() {
	    var lga = $(this).val();
	    $.ajax({
	      type: 'POST',
	      url: '../handlers/lga_result.inc.php',
	      data: { lga: lga },
	      success: function(response) {
	      	var resp = JSON.parse(response);
	        $('tbody').html(resp["tag"]);
	        $('.total').text(resp["total_vote"]);
	        console.log(response);
	      }
	    });
	  });
	});

</script>



</body>
</html>