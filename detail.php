<?php
require 'inc/functions.php';
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if(isset($_GET['id'])){
  $entry = get_detail_page($id);
}
include 'inc/header.php'; ?>
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

            <div class="container">
              <!--  <div class="site-header">
                    <a class="logo" href="index.html"><i class="material-icons">library_books</i></a>
                    <a class="button icon-right" href="new.html"><span>New Entry</span> <i class="material-icons">add</i></a>
                </div>-->
            </div>

        <section>
            <div class="container">
                <div class="entry-list single">
                    <article>

                      <h2><?php echo $entry['title']; ?></h2>
                      <time><?php echo date('F jS,Y',strtotime($entry['date'])); ?></time>


                      <!--<h1>The best day I’ve ever had</h1>
                        <time datetime="2016-01-31">January 31, 2016</time>
                        <div class="entry">
                            <h3>Time Spent: </h3>
                            <p>15 Hours</p>
                        </div>
                        <div class="entry">-->
                            <h3 style= "text-align:left;">Time Spent:<?php echo "<time> " . $entry['time_spent'] . "</time>"; ?></h3>
                            <h3 style= "text-align:left;">What I Learned:</h3>
                            <p class="entry"><?php echo $entry['learned']; ?></p>

                        </div>
                        <div class="entry">
                            <h3>Resources to Remember:</h3>
                            <?php if (!empty($entry['resources'])) {
                echo "<ul>";
                foreach (explode(trim(','), $entry['resources']) as $resource) {
                    echo "<li>" . trim($resource) . "</ br></li>";
                }
                echo "</ul>";
              }
              ?>
                        </div>
                        <div class="entry">
                            <h3>Tags:</h3>
                            <?php if (!empty($entry['tags'])) {
                echo "<ul>";
                foreach (explode(trim(','), $entry['tags']) as $tag) {
                  echo "<form methode='get' action='tags.php?=" . trim($tag) ."'>";
                  echo "<input type='hidden' name='" . trim($tag) . "' id='" . trim($tag) . "' />";
                  echo "<input type='submit' class= 'button-tag' value= '" . trim($tag) . "' />";
                  echo "&nbsp";
                }
                echo "</form>";
                echo "</ul>";
              }
              ?>
                        </div>
                    </article>
                </div>
            </div>
            <div class="edit">
                <p><a href="edit.php?id=<?php echo $id; ?>">Edit Entry</a>
                <a href="delete.php?id=<?php echo $id; ?>"style='color:#f5671b'>Delete</a></p>
            </div>
        </section>
        <?php include 'inc/footer.php'; ?>
        </footer>
    </body>
</html>
