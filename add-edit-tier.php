<?php

require_once 'functions.php';

if (!empty($_POST)) {
    $title = $_POST['title'] ?? '';
    $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_INT);

    $db = connect();

    if (empty($_POST['id'])) {
        try {
            $newTierQuery = 'INSERT INTO tiers (title, price) VALUES (:title, :price)';
            $createTierStmt = $db->prepare($newTierQuery);
            $createTierStmt->execute([':title' => $title, ':price' => $price]);
            if ($createTierStmt->rowCount()) {
                $type = 'success';
                $message = 'Tier added';
            } else {
                $type = 'error';
                $message = 'Tier not added';
            }
        } catch (Exception $e) {
            $type = 'error';
            $message = 'Exception message: ' . $e->getMessage();
        }
    } else {
        // The tier is in the database, so let's update it
        // Get the tier ID
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

        try {
            // Write the SQL statement to update tier information here
            $updateTierQuery = 'UPDATE tiers SET title = :title, price = :price WHERE id = :id';
            $updateTierStmt = $db->prepare($updateTierQuery);
            $updateTierStmt->execute([':title' => $title, ':price' => $price, ':id' => $id]);
            // We'll use the rowCount() function to check if a row was modified. If so, we'll assume the statement was successful, otherwise, it likely failed.
            if ($updateTierStmt->rowCount()) {
                // Row was updated, let's set a success message
                $type = 'success';
                $message = 'Tier updated';
            } else {
                $type = 'error';
                $message = 'Tier not updated';
            }
        } catch (Exception $e) {
            $type = 'error';
            $message = 'Tier not updated: ' . $e->getMessage();
        }
    }
    $createTierStmt = null;
    $updateTierStmt = null;
    $db = null;

    // Re-redirect back to main tiers page
    header('location:' . 'tiers.php?type=' . $type . '&message=' . $message);
}
