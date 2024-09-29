<?php
  require_once('../model/database.php');

  $tech_id = filter_input(INPUT_POST, 'tech_id', FILTER_VALIDATE_INT);

  if ($tech_id != false)
    {
      $query = 'DELETE FROM technicians
                WHERE techID = :tech_id';

      $statement = $db->prepare($query);
      $statement->bindValue(':tech_id', $tech_id);

      $statement-> execute();
      $statement-> closeCursor();
    }

    $url = "index.php";
      header("Location: " . $url);
      die();
?>