<?php
session_start();


$product_code = filter_input(INPUT_POST, 'productCode', FILTER_VALIDATE_INT);
$customerID=$_SESSION['customer_id']

require_once('../model/database.php');

$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

$queryInsert = 'INSERT INTO registrations (customerID, productCode, registrationDate)
                VALUES (:customerID, :productCode', :'registrationDate)';
$statement = $db->prepare($queryInsert);
$statement->bindValue(':customerID', $customerID);
$statement->bindValue(':productCode', $productCode);
$statement->execute();
$statement->closeCursor();

header('Location: register_success.php');
exit();
?>