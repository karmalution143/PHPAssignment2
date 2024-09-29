<?php
    session_start();
    // get the data from the database
    $productCode = filter_input(INPUT_POST, 'productCode');
    $name = filter_input(INPUT_POST, 'name');
    $version = filter_input(INPUT_POST, 'version');
    $releaseDate = filter_input(INPUT_POST, 'releaseDate');

    if ($productCode == null || $name == null || 
        $version == null || $releaseDate == null) 
        {
            $_SESSION["add_error"] = "Invalid product data. Check all
                fields and try again.";

            $url = "../errors/error.php";
            header("Location: " . $url);
            die();
        } else {
            require_once('../model/database.php');

            $query = 'INSERT INTO products
                (productCode, name, version, releaseDate)
                VALUES
                (:productCode, :name, :version, :releaseDate)';

            $statement = $db->prepare($query);
            $statement->bindValue(':productCode', $productCode);
            $statement->bindValue(':name', $name);
            $statement->bindValue(':version', $version);
            $statement->bindValue(':releaseDate', $releaseDate);

            $statement->execute();
            $statement->closeCursor();
        }

        $url = "index.php";
        header("Location: " . $url);
        die();
?>