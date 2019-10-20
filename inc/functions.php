<?php
//journal app functions
//create list view of entries to be displayed on main[index.php] page
function get_entries_list($id){
   include "connection.php";

   try {
   return $db->query('SELECT entries.*, group_concat(tags.tag) AS tags FROM entries
   LEFT JOIN tags ON entries.id = tags.entry_id
   GROUP BY entries.id
   ORDER BY 3 DESC');

 } catch (Exception $e){
     echo $e->getMessage();
     return array();
 }


}
function get_tags_list($tag_id){
   include "connection.php";

   try {
     $sql = 'SELECT tags.* FROM tags';
      if (!empty($entry_id)) {
   return $db->query('SELECT entries.*, tags.tag FROM entries
   LEFT JOIN tags ON entries.id = tags.entry_id
   ORDER BY 3 DESC');
   }
 } catch (Exception $e){
     echo $e->getMessage();
     return array();
 }


}
function list_by_tag($tag){
   include "connection.php";

   try {
   return $db->prepare('SELECT entries.*, tags.tag FROM entries
   LEFT JOIN tags ON entries.id = tags.entry_id
   WHERE tag = ?');

  $results->bindParam(1, $tag, PDO::PARAM_STR);

  $results->execute();

 } catch (Exception $e){
     echo $e->getMessage();
     return array();
 }
 return $results->fetch();

}

function get_detail_page($id){
  include "connection.php";

  $sql = 'SELECT entries.*, group_concat(tags.tag) AS tags FROM entries
  LEFT JOIN tags ON entries.id = tags.entry_id
  WHERE id = ?
  GROUP BY entries.id';


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
   }
  try {
      $results = $db->prepare($sql);
      $results->bindValue(1, $title, PDO::PARAM_STR);
      $results->bindValue(2, $date, PDO::PARAM_STR);
      $results->bindValue(3, $time_spent, PDO::PARAM_STR);
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
function delete_entry($id) {
    include 'connection.php';
    $sql = 'DELETE FROM entries WHERE id = ?';
    try {
        $results = $db->prepare($sql);
        $results->bindValue(1, $id, PDO::PARAM_INT);
        $results->execute();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage() . "<br>";
        return false;
    }
    return true;
}
 ?>
