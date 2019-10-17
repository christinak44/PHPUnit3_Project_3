<?php
require 'inc/functions.php';
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$entry = get_detail_page($id);

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

                      <h1><?php echo $entry['title']; ?></h1>
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
                            <ul>
                                <li><a href="">Lorem ipsum dolor sit amet</a></li>
                                <li><a href="">Cras accumsan cursus ante, non dapibus tempor</a></li>
                                <li>Nunc ut rhoncus felis, vel tincidunt neque</li>
                                <li><a href="">Ipsum dolor sit amet</a></li>
                            </ul>
                        </div>-->
                    </article>
                </div>
            </div>
            <div class="edit">
                <p><a href="edit.php">Edit Entry</a></p>
            </div>
        </section>
        <footer>
            <div>
                &copy; MyJournal
            </div>
        </footer>
    </body>
</html>
