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
function list_by_tag($tag){
   include "connection.php";

   try {
     if (!empty($tag)) {
      $sql = 'SELECT entries.*, tags.* FROM entries
      LEFT JOIN tags ON entries.id = tags.entry_id
      JOIN tags_to_entries ON tags.tag_id = tags_to_entries.tag_id
      WHERE tags.tag = ?';

   /*return $db->prepare('SELECT entries.*, tags.tag FROM entries
   LEFT JOIN tags ON entries.id = tags.entry_id
   WHERE tag = ?');*/

  $results = $db->prepare($sql);
  $results->bindValue(1, $tag, PDO::PARAM_STR);
} //$results->bindParam(2, $id, PDO::PARAM_INT);
  $results->execute();

 } catch (Exception $e){
     echo $e->getMessage();
     return array();
 }

 return $results->fetchAll(PDO::FETCH_ASSOC);

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
/*function add_entry($title, $date, $time_spent, $learned, $resources, $tag, $entry_id, $id = null) {
 include "connection.php";
  $sql = $sql2 = $sql3 = '';
 if ($id) {
     $sql = 'UPDATE entries SET title = ?, date = ?, time_spent = ?, learned = ?, resources = ? WHERE id = ?';
   } else {
   $sql = 'INSERT INTO entries (title, date, time_spent, learned, resources) VALUES (?, ?, ?, ?, ?)';
   }
   $sql_results = $db->prepare($sql);
 if ($id) {
     $sql2 = 'UPDATE tags SET tag = ? WHERE entry_id = ?';
   } else {
   $sql2 = 'INSERT INTO tags (tag, entry_id) VALUES (?, ?)';
   }
   $sql2_results = $db->prepare($sql2);

   $sql3 = 'INSERT INTO tags_to_entries (entry_id, tag_id) VALUES (?, ?)';

   $sql3_results = $db->prepare($sql3);
  try {
    $db->beginTransaction();

      $sql_results->bindValue(1, $title, PDO::PARAM_STR);
      $sql_results->bindValue(2, $date, PDO::PARAM_STR);
      $sql_results->bindValue(3, $time_spent, PDO::PARAM_STR);
      //phpmanual referenced for acceptable value types
      $sql_results->bindValue(4, $learned, PDO::PARAM_LOB);
      $sql_results->bindValue(5, $resources, PDO::PARAM_LOB);
      //$sql_results->bindValue(6, $tag, PDO::PARAM_STR);
      //$sql_results->bindValue(7, $entry_id, PDO::PARAM_INT);
      if($id) {
      $sql_results->bindValue(6, $id, PDO::PARAM_INT);
      }
      $sql_results->execute();

      $sql2_results->bindValue(1, $tag, PDO::PARAM_STR);
      $sql2_results->bindValue(2, $entry_id, PDO::PARAM_INT);

      $sql2_results->execute();

      $sql3_results->bindValue(1, $entry_id, PDO::PARAM_INT);
      $sql3_results->bindValue(2, $tag, PDO::PARAM_STR);

      $sql3_results->execute();
    $db->commit();
  } catch (Exception $e) {
      echo "Error!: " . $e->getMessage() . "<br />";
      return false;
    }
  return true;

}*/
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
