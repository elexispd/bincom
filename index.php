<!DOCTYPE html>
<html>
<head>
	<title>My Webpage</title>
	<!-- Include Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" >
	<style>
		/* Set background color */
		body {
			background: linear-gradient(to bottom right, #81C784, #4CAF50);
		}
		/* Center links in the middle of the page */
		.container {
			display: flex;
			flex-direction: column;
			justify-content: center;
			align-items: center;
			height: 100vh;
		}
	</style>
</head>
<body>
	<div class="container">
		<!-- Add three links in the middle of the page -->
		<h1 class="text-light">This is Promise Ogbonnaya's Solution</h1>
		<div class="d-flex mt-4">
			<a href="views/polling_unit.php" class="btn btn-primary">Task 1</a>
			<a href="views/lga_results.php" class="btn btn-secondary mx-3">Task 2</a>
			<a href="views/create.php" class="btn btn-success">Task 3</a>
		</div>
	</div>
		
	<!-- Include Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" ></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper-base.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
