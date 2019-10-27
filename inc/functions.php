<?php
//journal app functions
//create list view of entries to be displayed on main[index.php] page
function get_entries_list($entries_id = null, $tag_id = null){
   include "connection.php";
   $sql = "SELECT entries_id, title, date, time_spent, learned, resources FROM entries";
   try {

   if (!empty($tag_id)) {
      $results = $db->prepare(
        $sql
        . " JOIN tags_to_entries ON entries_id = tags_to_entries.entry_id
        WHERE tags_to_entries.tag_id = ?");
        $results->bindParam(1, $tag_id, PDO::PARAM_INT);
        }
    elseif (!empty($entries_id)) {
      $results = $db->prepare(
        $sql
        . " WHERE entries_id = ?");
      $results->bindParam(1, $entries_id, PDO::PARAM_INT);
    } else {
      $results = $db->prepare($sql
      . " ORDER BY date DESC");
    }
      $results->execute();

      if (!empty($entries_id)) {
        $entries = $results->fetch();
         }else{$entries = $results->fetchAll(PDO::FETCH_ASSOC);
       }
    } catch (Exception $e){
      echo $e->getMessage();
    }

  return $entries;
}
function add_tag($tags_id = null, $entry_id = null){
   include "connection.php";
   $sql = "SELECT tags_id, tag FROM tags";
   try {

   if (!empty($entry_id)) {
      $results = $db->prepare(
        $sql
        . " JOIN tags_to_entries ON tags_id = tags_to_entries.tag_id
        WHERE tags_to_entries.entry_id = ?");
        $results->bindParam(1, $entry_id, PDO::PARAM_INT);
        }
    elseif (!empty($tags_id)) {
      $results = $db->prepare(
        $sql
        . " WHERE tags_id = ?");
      $results->bindParam(1, $tags_id, PDO::PARAM_INT);
    } else {
      $results = $db->prepare($sql);
    }
      $results->execute();

      if (!empty($tags_id)) {
        $tags = $results->fetch();
      }else{$tags = $results->fetchAll(PDO::FETCH_ASSOC);
       }
    } catch (Exception $e){
      echo "bad query";
    }

    return $tags;
  }


function add_entry($title, $date, $time_spent, $learned, $resources, $entries_id = null) {
 include "connection.php";
//add or edit entry with/without tags
 if ($entries_id) {
     $sql = 'UPDATE entries SET title = ?, date = ?, time_spent = ?, learned = ?, resources = ? WHERE entries_id = ?';
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
      if($entries_id) {
      $results->bindValue(6, $entries_id, PDO::PARAM_INT);
      }
      $results->execute();
  } catch (Exception $e) {
      echo "Error!: " . $e->getMessage() . "<br />";
      return false;
    }
  return true;
}
function get_detail_page($entries_id){
//in order to edit w/o tag
  include "connection.php";
  $sql = 'SELECT entries_id, title, date, time_spent, learned, resources FROM entries
   WHERE entries_id = ?';
  try {
       $results = $db->prepare($sql);
       $results->bindValue(1, $entries_id, PDO::PARAM_INT);
       $results->execute();
  } catch (Exception $e){
      echo "Error!:" . $e->getMessage() . "<br />";
      return false;
  }
  return $results->fetch();
}
/*function tags_array($tags_id, $title){
include "connection.php";
try{
$sql = "SELECT * FROM tags";
$results = $db->query($sql);
$tagList = $results->fetchAll(PDO::FETCH_ASSOC);

} catch (Exception $e) {
    echo "Error!: " . $e->getMessage() . "<br />";
    return false;
  }
  return $tagList;
  //under review
}*/
/*function tags_edit($entry_id, $tag_id){
include "connection.php";
$sql = "SELECT entry_id, tag_id FROM tags_to_entries
LEFT JOIN tags_to_entries ON entries_id = tags_to_entries.entry_id
LEFT JOIN tags ON tags_to_entries.tag_id = tags_id";

if ($entry_id && $tag_id != $tags_id || !isset($entry_id)) {
      $sql = 'INSERT INTO tags_to_entries (entry_id, tag_id) VALUES (?, ?)';
    } else {
      $results = $db->prepare($sql);
    }

       try {
           $results = $db->prepare($sql);
           $results->bindValue(1, $entry_id, PDO::PARAM_INT);
           $results->bindValue(2, $tag_id, PDO::PARAM_INT);
         }
         $results->execute();
       } catch (Exception $e) {
           echo "Error!: " . $e->getMessage() . "<br />";
           return false;
         }
       return true;
       //under review
}*/

function delete_entry($entries_id) {
//delete entry
    include 'connection.php';
    $sql = 'DELETE FROM entries WHERE entries_id = ?';
    try {
        $results = $db->prepare($sql);
        $results->bindValue(1, $entries_id, PDO::PARAM_INT);
        $results->execute();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage() . "<br>";
        return false;
    }
    return true;
}
 ?>
