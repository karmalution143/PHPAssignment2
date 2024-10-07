<?php
session_start();

if (!isset($_SESSION['email'])) {
  header('Location: login.php');
  exit();
}

require_once('../model/database.php');

$queryProducts = 'SELECT * FROM products';
$statement = $db->prepare($queryProducts);
$statement->execute();
$products = $statement->fetchAll();
$statement->closeCursor();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../main.css" />
  <title>Product Registration</title>
</head>
<body>
  <?php include("../view/header.php"); ?>
    <main>
      <h2>Register Product</h2>
      <P>Customer: <?php echo $_SESSION['email'];
      <form action="register_product.php" method="post">
        <label for="product">Select Product:</label>
          <select name="productID" id="product" required>
            <option value="">Select a Product</option>
              <?php foreach ($products as $product): ?>
                <option value="<?php echo $product['productID']; ?>">
                  <?php echo $product['name']; ?>
                </option>
              <?php endforeach; ?>
          </select>
            <br><br>
          <input type="submit" value="Register Product" />
      </form>
      <p><a href="../product_manager/index.php">View Product List</a></p>
    </main>
  <?php include("../view/footer.php"); ?>
</body>
</html>