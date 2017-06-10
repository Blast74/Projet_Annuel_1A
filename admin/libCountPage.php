<?php
//génére un selecteur de page à insérer dans la Html javascript
  function pageSelectorGen($users, $nbUsersByPage){
     $nblines = count($users);
    if ($nblines > $nbUsersByPage) {
      $nbLoop = ($nblines / $nbUsersByPage) ;
      if ($nblines % $nbUsersByPage != 0) {
        $nbLoop++ ;
      }
      echo $nbLoop;
    }
  }
//découpe de tableau pour affichage
  // function cutTableUsers(){
  //     $nblines = array_slice($resultSQL,0,$_REQUEST["nbusers"]+1);
  //
  //
  // }


 ?>
