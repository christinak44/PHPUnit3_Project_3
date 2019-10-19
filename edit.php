<?php
require 'inc/functions.php';

$title = $date = $time_spent = $learned = $resources = '';
if (isset($_GET['id'])) {
    list($id, $title, $date, $time_spent, $learned, $resources) = get_detail_page(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    $title = trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING));
    $date = trim(filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING));
    $time_spent = trim(filter_input(INPUT_POST, 'timeSpent', FILTER_SANITIZE_STRING));
    $learned = trim(filter_input(INPUT_POST, 'whatILearned', FILTER_SANITIZE_STRING));
    $resources = trim(filter_input(INPUT_POST, 'ResourcesToRemember', FILTER_SANITIZE_STRING));

        if(empty($title) || empty($date) || empty($time_spent) || empty($learned)){
           echo $error_message = 'Please enter the required fields: Title, Date, Time Spent, Learned';
        } else {
          if (add_entry( $title, $date, $time_spent, $learned, $resources, $id)) {
           echo 'Update complete.';
   //Timed redirect referenced- https://stackoverflow.com/questions/6119451/page-redirect-after-certain-time-php
            header('refresh: 3; url = detail.php?id="'. $id . '"');
            exit;
        } else {
            echo 'Could not update entry';
         }
    }

}
include 'inc/header.php';
?>
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
  background-image: url("css/images/white-math-page-paper-texture.jpg");
        background-repeat:no-repeat;
        background-position:center;
        background-attachment:fixed;
        background-size: cover;
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
    <body>

        <section>
            <div class="container">
                <div class="edit-entry">
                    <h2>Edit Entry</h2>
                    <form class="form-container form-add" method="post" action="edit.php">
                        <label for="title"> Title</label>
                        <input id="title" type="text" name="title" value="<?php echo $title; ?>"><br>
                        <label for="date">Date</label>
                        <input id="date" type="date" name="date" value="<?php echo $date; ?>"><br>
                        <label for="time-spent"> Time Spent</label>
                        <input id="time-spent" type="text" name="timeSpent" value="<?php echo $time_spent; ?>"><br>
                        <label for="what-i-learned">What I Learned</label>
                        <textarea id="what-i-learned" rows="5" name="whatILearned"><?php echo $learned; ?></textarea>
                        <label for="resources-to-remember">Resources to Remember</label>
                        <textarea id="resources-to-remember" rows="5" name="ResourcesToRemember"><?php echo $resources; ?></textarea>
                        <?php
                        if (!empty($id)){
                             echo '<input type="hidden" name="id" value="' . $id . '" />';
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
