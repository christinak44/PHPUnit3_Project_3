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
      /*https://stackoverflow.com/questions/8798677/cant-get-a-border-around-a-html-div-element
      https://www.photohdx.com/pic-2193/white-math-page-paper-texture
      https://www.wikihow.com/Set-a-Background-Image-in-HTML
      https://stackoverflow.com/questions/14466102/how-do-i-make-my-background-image-transparent-in-css-if-i-have-the-following-cod
      transparent background aid*/
          include 'inc/header.php';
      ?>
        <section>
            <div class"container">
                <div class="entry-list" style = "border:1px solid black;">
                  <h2>Log:</h2>
                    <article class="entry-list">
                        <?php
                        include "inc/functions.php";
                      /*  if ($_SERVER['REQUEST_METHOD'] == 'GET') {*/
                       $entries_id = null;
                       $tag_id = null;
                        if(isset($_GET['entries_id'])){
                        $entries_id = filter_input(INPUT_GET, 'entries_id', FILTER_SANITIZE_NUMBER_INT);
                         }
                         if(isset($_GET['tags_id'])){
                         $tags = filter_input(INPUT_GET, 'tags_id', FILTER_SANITIZE_NUMBER_INT);
                          }
                        $entries = get_entries_list($entries_id,$tag_id);
                        foreach ($entries as $entry) {
                          echo "<h2><a href='/detail.php?id=" . $entry['entries_id'] . "'>" . $entry['title'] . "</a></h2>";
                          echo "<time>" . date('F jS,Y',strtotime($entry['date'])) . "</time> &nbsp <a href='remove_entry.php?id=" . $entry['entries_id'] . "' style='color:#f5671b'>Delete</a><br>";
                          //echo "<a href='tags.php?tag=" . trim($item['tag']) . "'>#" . trim($item['tag']) . "</a> ";
                          //echo "<input type='submit' value='Delete' />\n";

                          if($tags = add_tag(null,$entry['entries_id'])) {
                         foreach ($tags as $tag) {
                           //echo "<form method='get' action='tags.php?tag=" . trim($tag) ."'>";
                           echo "<a href='tags.php?tag_id=" . $tag['tags_id'] . "'class='button-tag'>#" . $tag['tag'] . "</a> ";
                           //echo "<input type='hidden' name='" . trim($tag) . "' id='" . trim($tag) . "' />";
                          //echo "<input type='submit' class= 'button-tag' value= '" . trim($tag) . "' />";
                           echo "</ br>";
                           }
                        }       //echo "&nbsp";

                              //echo "</form>";
                          }

                        //var_dump($tag);
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
