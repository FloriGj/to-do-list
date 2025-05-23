<?php require_once 'header.php' ?>

<div class='container'>
    <div class='row'>
        <div class='jumbotron bg-light m-2 p-2'>
            <h1 class='display-4'>Welcome to TO-DO-LIST!</h1>
            <p class='lead'>Here, you can manage membership!</p>
            <hr class='my-4'>
            <p>Click a button below for a list of members or tiers</p>
            <p class='lead'>
                <a class='btn btn-primary btn-lg' href='members.php' role='button'>Members</a>
                <a class='btn btn-primary btn-lg' href='tiers.php' role='button'>Tiers</a>
            </p>
        </div>
    </div>

    <?php require_once 'footer.php' ?>