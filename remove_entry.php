<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>MyJournal</title>
        <link href="https://fonts.googleapis.com/css?family=Cousine:400" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Work+Sans:600" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/site.css">
        <style>
         body:after {
        content: "";
	background-image: url("css/images/miranda_by_mizaeltengu_db46m2q-fullview.jpg");
        background-repeat:no-repeat;
        background-position:center;
        background-attachment:fixed;
        background-size: auto auto;
        opacity: 0.25;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        position: absolute;
        z-index: -1;
}
</style>
    </head>
<?php

require 'inc/functions.php';
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$page = 'Remove Entry';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
  include 'inc/header.php';
}
if (delete_entry($id)) {
  echo 'Delete, successful. You will be redirected automatically or  by clicking link below.</ br>
  <p><a href="index.php?id=<?php echo $id; ?>">Home</a></p>';
  header('refresh: 5; url = index.php');
} else {
  echo 'Delete, incomplete.';

}

include 'inc/footer.php';
