<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once('./config/db.php');

session_start();

if (!isset($_SESSION['customer'])) {
    
    header("Location: ./signin/signin.html");
    exit();
}


// Initialize search query

$searchQuery = '';
if (isset($_GET['search'])) {
    $searchQuery = mysqli_real_escape_string($conn, $_GET['search']);
}


// Fetch food items
$sql = "SELECT id, name, description, price, food_picture FROM foods";

if (!empty($searchQuery)) {
    $sql .= " WHERE name LIKE '$searchQuery%'";
}

$result = $conn->query($sql);

?>

<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.4/font/bootstrap-icons.min.css" />
        <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.19.0/font/bootstrap-icons.css" rel="stylesheet">

	</head>
	<body>
		<nav class="navbar navbar-expand-lg bg-body-tertiary">
		    <div class="container-fluid">
				<a class="navbar-brand" href="/Food-Delivery/index.php">Home</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				  <span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarSupportedContent">
				  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
				  </ul>

                  <!-- Search form in the navbar -->
					<form class="d-flex" method="GET" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
						<input class="form-control me-2" type="search" name="search" placeholder="Search food..." aria-label="Search">
						<button class="btn btn-outline-success" type="submit">Search</button>
					</form>

                  <a class="navbar-brand" href="/Food-Delivery/cart/cart.php"><i class="ri-shopping-bag-line"></i></a>
				  <ul class="navbar-nav">
				    <li class="nav-item dropdown">
				      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
				        <i class="bi bi-gear"></i> Settings
				      </a>
				      <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
				        <li><a class="dropdown-item" href="./logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
				      </ul>
				    </li>
				  </ul>
				</div>
			</div>
		</nav>

        <div class="container-fluid mt-3">
			<div class="row">
				<div class="col">
					<h1 id="full_name" style="text-align: center;">Food Menu</h1>
				</div>
			</div>
		</div>

		<?php 

		if(!empty($searchQuery)) {

			echo "<div class='container-fluid mt-3'>";
				echo '<div class="row">';
					echo '<div class="col">';
						echo '<h3 id="full_name" style="text-align: center;">Results For '; ?> <?php echo "<b color=red>$searchQuery</b>" ?> <?php echo '</h3>';
					echo '</div>';
				echo '</div>';
			echo '</div>';	
		}

		?>

    	</header>
    	<!-- header end -->
    <div class="container mt-3">
        <div class="row">
            <?php while ($row = $result->fetch_assoc()) { ?>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($row['name']) ?></h5>
                        <p class="card-text"><?= htmlspecialchars($row['description']) ?></p>

                        <!-- Display the food picture with fixed size -->
                        <?php if (!empty($row['food_picture'])) { ?>
                            <img src="<?= htmlspecialchars($row['food_picture']) ?>" class="card-img-top" alt="<?= htmlspecialchars($row['name']) ?>" style="width: 100%; height: 200px; object-fit: cover;">
                        <?php } ?>

                        <!-- Display the price -->
                        <p><strong>Price: $<?= number_format($row['price'], 2) ?></strong></p>

                        <!-- Center the Add to Cart button -->
                        <div class="d-flex justify-content-center">
                            <a href="./cart/add_to_cart.php?food_id=<?= $row['id'] ?>" class="btn btn-primary">Add to Cart</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>


</body>
</html>

