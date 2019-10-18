
<?php
require 'inc/functions.php';
$page = 'New Entry';
$title = $date = $time_spent = $learned = $resources = '';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING));
    $date = trim(filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING));
    $time_spent = trim(filter_input(INPUT_POST, 'timeSpent', FILTER_SANITIZE_NUMBER_INT));
    $learned = trim(filter_input(INPUT_POST, 'whatILearned', FILTER_SANITIZE_STRING));
    $resources = trim(filter_input(INPUT_POST, 'ResourcesToRemember', FILTER_SANITIZE_STRING));

        if(empty($title) || empty($date) || empty($time_spent) || empty($learned)){
           echo $error_message = 'Please enter the required fields: Title, Date, Time Spent, Learned';
        } else {
          if (add_entry($title, $date, $time_spent, $learned, $resources)) {
            header('Location: index.php');
            exit;
        } else {
            echo 'Could not add entry';
         }
    }

}
include 'inc/header.php';
?>

<!DOCTYPE html>
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
    </head>
    <body>
        <section>
            <div class="container">
                <div class="new-entry">
                    <h2>New Entry</h2>
                    <form class="form-container form-add" method="post" action="new.php">
                        <label for="title"> Title</label>
                        <input id="title" type="text" name="title"><br>
                        <label for="date">Date</label>
                        <input id="date" type="date" name="date"><br>
                        <label for="time-spent"> Time Spent</label>
                        <input id="time-spent" type="text" name="timeSpent"><br>
                        <label for="what-i-learned">What I Learned</label>
                        <textarea id="what-i-learned" rows="5" name="whatILearned"></textarea>
                        <label for="resources-to-remember">Resources to Remember</label>
                        <textarea id="resources-to-remember" rows="5" name="ResourcesToRemember"></textarea>
                        <?php
                        if (!empty($id)){
                             echo '<input type="hidden" name="id" value="' .$id . '" />';
                        }
                        ?>
                        <input type="submit" value="Publish Entry" class="button">
                        <a href="index.php" class="button button-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </section>
        <?php include 'inc/footer.php'; ?>
    </body>
</html>
