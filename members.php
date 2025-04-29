<?php

require_once 'functions.php';

// Create a try/catch block to handle database exceptions
try {
    // Connect to the database using the connect function
    $db = connect();
    if ($db === null) {
        throw new Exception("Failed to connect to the database.");
    }
    // Create the $membersQuery here. Use an inner join to get the tier titles for the table
    $memQuer = 'SELECT * FROM members';
    // Execute the query
    $membersQuery = $db->query($memQuer);
    if (!$membersQuery) {
        // Check if query failed and print the error
        $errorInfo = $db->errorInfo();
        throw new Exception("Query failed: " . $errorInfo[2]);
    }
    echo "Query executed successfully.<br>";

    // Fetch all members and assign the result to $members
    $members = $membersQuery->fetchAll(PDO::FETCH_ASSOC);
    if (empty($members)) {
        throw new Exception("No members found.");
    }
    echo 'Number of members fetched: ' . count($members) . '<br>';
} catch (PDOException $e) {
    //Echo the message if there was a database exception echo
    "Database error: " . $e->getMessage();
} catch (Exception $e) {
    // Echo the message if there was an exception
    echo $e->getMessage();
}

// Close the database connection here
$db = null;
?>

<?php require_once 'header.php' ?>

<a href='index.php' class='btn btn-secondary m-2 active' role='button'>Home</a>
<a href='tiers.php' class='btn btn-secondary m-2 active' role='button'>Tiers</a>

<?php if (!empty($_GET['type']) && ($_GET['type'] === 'success')) : ?>
    <div class='row'>
        <div class='alert alert-success'>
            Success! <?= $_GET['message'] ?>
        </div>
    </div>
<?php elseif (!empty($_GET['type']) && ($_GET['type'] === 'error')) : ?>
    <div class='row'>
        <div class='alert alert-danger'>
            Error! <?= $_GET['message'] ?>
        </div>
    </div>
<?php endif; ?>
<div class='row'>
    <h1 class='col-md-12 text-center border border-dark text-white bg-primary'>Members</h1>
</div>
<div class='row mb-3'>
    <div class='tabel-responsive'>

        <?php if (!empty($members)) : ?>
            <table class='table table-striped'>
                <thead>
                    <tr>
                        <th scope='col'>#</th>
                        <th scope='col'>First Name</th>
                        <th scope='col'>Last Name</th>
                        <th scope='col'>Address</th>
                        <th scope='col'>Tier</th>
                        <th scope='col'>Actions</th>
                        <th scope='col'>Active</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($members as $member) : ?>
                        <tr>
                            <td><?= $member['id'] ?></td>
                            <td><?= htmlentities($member['first_name']) ?></td>
                            <td><?= htmlentities($member['last_name']) ?></td>
                            <td><?= htmlentities($member['address']) ?></td>
                            <td><?= htmlentities($member['tier_id']) ?></td>
                            <td>
                                <a class='btn btn-primary' href='member-form.php?id=<?= $member['id'] ?>' role='button'>Edit</a>
                                <a class='btn btn-danger' href='delete-member.php?id=<?= $member['id'] ?>' role='button'>Delete</a>
                            </td>
                            <td><?= $member['active'] ? 'Yes' : 'No' ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?> <p>No members found.</p>
        <?php endif; ?>
    </div>
</div>
<div class='row'>
    <div class='col'>
        <a class='btn btn-success' href='member-form.php' role='button'>Add member</a>
    </div>
</div>

<?php require_once 'footer.php' ?>