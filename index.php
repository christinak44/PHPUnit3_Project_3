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
    <body>
      <?php
          include 'inc/header.php';
      ?>
        <section>
            <div class"container">
                <div class="entry-list" style = "border:5px solid black;">
                    <article>
                        <?php
                        include "inc/functions.php";
                        foreach (get_entries_list() as $item) {
                          echo "<h2><a href='/detail.php?id=" . $item['id'] . "'>" . $item['title'] . "</a></h2>";
                          echo "<time>" . date('F jS,Y',strtotime($item['date'])) . "</time>";
                          echo "<p><a href='remove_entry.php?id=<?php echo $id; ?>' style='color:#f5671b'>Delete</a></p>";
                          //echo "<input type='submit' value='Delete' />\n";
                        }

                         ?>
                        <!--<h2><a href="detail.html">The best day I’ve ever had</a></h2>
                        <time datetime="2016-01-31">January 31, 2016</time>-->
                    </article>
                    <!--<article>
                        <h2><a href="detail_2.html">The absolute worst day I’ve ever had</a></h2>
                        <time datetime="2016-01-31">January 31, 2016</time>
                    </article>
                    <article>
                        <h2><a href="detail_3.html">That time at the mall</a></h2>
                        <time datetime="2016-01-31">January 31, 2016</time>
                    </article>
                    <article>
                        <h2><a href="detail_4.html">Dude, where’s my car?</a></h2>
                        <time datetime="2016-01-31">January 31, 2016</time>
                    </article>-->
                </div>
            </div>
        </section>
        <?php
          include 'inc/footer.php';
        ?>
    </body>
</html>
