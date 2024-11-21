<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once('../config/db.php');
session_start();

// Check if the user is logged in
if (!isset($_SESSION['customer'])) {
    header("Location: ../signin/signin.html");
    exit();
}

// Get the user ID from the session
$user_id = $_SESSION['customer']['id'];


// Fetch cart items for this user
$sql = "
    SELECT foods.id AS food_id, foods.name, foods.description, foods.price, foods.food_picture, cart.quantity
    FROM cart
    JOIN foods ON cart.food_id = foods.id
    WHERE cart.user_id = ?
";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Delivery</title>
</head>
<body>

<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.19.0/font/bootstrap-icons.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/dist/remixicon.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.4/font/bootstrap-icons.min.css" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>



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
                  <a class="navbar-brand" href="/Food-Delivery/cart/cart.php"><i class="ri-shopping-bag-line"></i></a>
				  <ul class="navbar-nav">
				    <li class="nav-item dropdown">
				      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
				        <i class="bi bi-gear"></i> Settings
				      </a>
				      <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
				        <li><a class="dropdown-item" href="../logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
				      </ul>
				    </li>
				  </ul>
				</div>
			</div>
		</nav>

        <div class="container-fluid mt-3">
			<div class="row">
				<div class="col">
					<h3 id="full_name" style="text-align: center;">Your Cart</h3>
				</div>
			</div>
		</div>

    </header>
    <!-- header end -->


    <body>
    <div class="container mt-3">
        <!-- <h3>Your Cart</h3> -->
        <div class="row">
            <?php if ($result->num_rows > 0) { ?>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($row['name']) ?></h5>
                                <p class="card-text"><?= htmlspecialchars($row['description']) ?></p>
                                
                                <!-- Display the food picture -->
                                <?php if (!empty($row['food_picture'])) { ?>
                                    <img src="<?= htmlspecialchars($row['food_picture']) ?>" class="card-img-top" alt="<?= htmlspecialchars($row['name']) ?>" style="width: 100%; height: 200px; object-fit: cover;">
                                <?php } ?>

                                <!-- Display the quantity and price -->
                                <p><strong>Price: $<?= number_format($row['price'], 2) ?></strong></p>
                                <p><strong>Quantity: <?= $row['quantity'] ?></strong></p>

                                <!-- Display total for this item -->
                                <p><strong>Total: $<?= number_format($row['price'] * $row['quantity'], 2) ?></strong></p>

                                <!-- Center the Add to Cart button -->
                                <div class="d-flex justify-content-center">
                                    <a href="./delete_from_cart.php?food_id=<?= $row['food_id'] ?>" class="btn btn-danger">Delete</a>
                                </div>

                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <p>Your cart is empty.</p>
            <?php } ?>
        </div>
    </div>
</body>
</html>
