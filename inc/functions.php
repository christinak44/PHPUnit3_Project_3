<?php
//journal app functions
//create list view of entries to be displayed on main[index.php] page
function get_entries_list(){
   include "connection.php";

   try {
   return $db->query('SELECT * FROM entries
   ORDER BY 2 DESC');

 } catch (Exception $e){
     echo $e->getMessage();
     return array();
 }


}
function get_detail_page($id){
  include "connection.php";

  $sql = ' SELECT * FROM entries WHERE id = ?';

  try {
       $results = $db->prepare($sql);
       $results->bindValue(1, $id, PDO::PARAM_INT);
       $results->execute();
  } catch (Exception $e){
      echo "Error!:" . $e->getMessage() . "<br />";
      return false;
  }
  return $results->fetch();

}
function add_entry($title, $date, $time_spent, $learned, $resources, $id = null) {
 include "connection.php";

 if ($id) {
     $sql = 'UPDATE entries SET title = ?, date = ?, time_spent = ?, learned = ?, resources = ? WHERE id = ?';
 } else {
   $sql = 'INSERT INTO entries (title, date, time_spent, learned, resources) VALUES (?, ?, ?, ?, ?)';

  try {
      $results = $db->prepare($sql);
      $results->bindValue(1, $title, PDO::PARAM_STR);
      $results->bindValue(2, $date, PDO::PARAM_STR);
      $results->bindValue(3, $time_spent, PDO::PARAM_INT);
      //phpmanual referenced for acceptable value types
      $results->bindValue(4, $learned, PDO::PARAM_LOB);
      $results->bindValue(5, $resources, PDO::PARAM_LOB);
      if($id) {
      $results->bindValue(6, $id, PDO::PARAM_INT);
      }
      $results->execute();
  } catch (Exception $e) {
      echo "Error!: " . $e->getMessage() . "<br />";
      return false;
    }
  return true;
  }
}
 ?>
