<?php
//génére un selecteur de page à insérer dans la Html javascript
  function pageSelectorGen($nbLine, $nbUsersByLine){
    if ($nbLine > $nbUsersByLine) {
      $nbLoop = ($nbLine / $nbUsersByLine) ;
      if ($nbLine % $nbUsersByLine != 0) {
        $nbLoop++ ;
      }
      $result = '<p>Pages:</p>';
      $result .= '<select name="pageSelector">';
      for ($i=1; $i <= $nbLoop ; $i++) {
        if ($i == 1) {
        $result .= '<option value='.$i.' selected="selected" onclick="console.log("salut")">'.$i.'</option>';
      }else {
        $result .= '<option value='.$i.' onclick="console.log("salut")">'.$i.'</option>';
      }

      }
      $result .=  '</select>';
      echo $result;
    }
  }
//découpe de tableau pour affichage
  // function cutTableUsers(){
  //     $users = array_slice($resultSQL,0,$_REQUEST["nbusers"]+1);
  //
  //
  // }


 ?>
