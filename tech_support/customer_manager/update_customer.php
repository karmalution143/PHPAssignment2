<?php
    session_start();

    $customerID = filter_input(INPUT_POST, 'customerID');
    // get the data from the database
    $firstName = filter_input(INPUT_POST, 'firstName');
    $lastName = filter_input(INPUT_POST, 'lastName');
    $address = filter_input(INPUT_POST, 'address');
    $city = filter_input(INPUT_POST, 'city');
    $province = filter_input(INPUT_POST, 'province');
    $postalCode = filter_input(INPUT_POST, 'postalCode');
    $countryCode = filter_input(INPUT_POST, 'countryCode');
    $phone = filter_input(INPUT_POST, 'phone');
    $email = filter_input(INPUT_POST, 'email');
    $password = filter_input(INPUT_POST, 'password');

    // code to save to MySQL Database goes here
    // Validate inputs
    if ($firstName == null || $lastName == null
        || $address == null || $city == null || $province == null
        || $postalCode == null || $countryCode == null 
        || $phone == null || $email == null) 
        {
            $_SESSION["add_error"] = "Invalid data. Check all
                fields and try again.";

            $url = "../errors/error.php";
            header("Location: " . $url);
            die();

        } else {
            require_once('../model/database.php');

            $query = 'UPDATE customers
                SET firstName = :firstName, 
                    lastName = :lastName, 
                    address = :address,
                    city = :city, 
                    province = :province, 
                    postalCode = :postalCode, 
                    countryCode = :countryCode, 
                    phone = :phone, 
                    email = :email, 
                    password = :password 
                    WHERE customerID = :customerID';

            $statement = $db->prepare($query);
            $statement->bindValue(':customerID', $customerID);
            $statement->bindValue(':firstName', $firstName);
            $statement->bindValue(':lastName', $lastName);
            $statement->bindValue(':address', $address);
            $statement->bindValue(':city', $city);
            $statement->bindValue(':province', $province);
            $statement->bindValue(':postalCode', $postalCode);
            $statement->bindValue(':countryCode', $countryCode);
            $statement->bindValue(':phone', $phone);
            $statement->bindValue(':email', $email);
            $statement->bindValue(':password', $password);

            $statement->execute();
            $statement->closeCursor();
        }

        $url = "index.php";
        header("Location: " . $url);
        die();
?>