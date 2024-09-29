<?php
  require_once('../model/database.php');

  $product_id = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);

  if ($product_id != false)
    {
      $query = 'DELETE FROM products
                WHERE productID = :product_id';

      $statement = $db->prepare($query);
      $statement->bindValue(':product_id', $product_id);

      $statement-> execute();
      $statement-> closeCursor();
    }

    $url = "index.php";
      header("Location: " . $url);
      die();
?>