
<?php
  require 'inc/functions.php';
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$page = 'Remove Entry';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
  include 'inc/header.php';
}
if (delete_entry($id)) {
  echo 'Successfully deleted entry.';
  header('refresh: 5; url = index.php');
} else {
  echo 'Delete, incomplete.';

}

include 'inc/footer.php';
