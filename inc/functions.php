<?php
//journal app functions
//create list view of entries to be displayed on main[index.php] page
function get_entries_list(){
   include "connection.php";

   try {
   return $db->query('SELECT title, date FROM entries
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
  var_dump($results);
}


 ?>
