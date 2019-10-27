
Testing area
<input type="checkbox" name="options[]" value="<?php echo $row['value']?>"
<?php if(in_array($row['value'], $checked)){ echo 'checked="checked"'; }?>/>
<?
if(isset)
if($tagBox = add_tag()) {
  echo "<p>"Tags:"</p>";

echo "<div>";
echo "<input type='"checkbox"' id="'scales'" name="'tags[]'" value=". $tagBox[];

echo "<label for="'scales'">"Scales"</label>";"
echo </div>
            foreach($tagBox as $tagCheck) {
              echo "<input type=\"checkbox\" id=\"tag_".$item['tag_id']."\" name=\"tags[]\" value=\"".$item['tag_id'] ."\"";
              if(is_array($tags)) {
                if(in_array($item['tag_id'],$tags)) {
                  echo " CHECKED";
                }
              }
              echo " />\n";
              echo "<label class='check_label' for='tag_".$item['tag_id']."'>".$item['title']."</label><br>\n";
            }
            echo "</fieldset><br>\n";
          }
