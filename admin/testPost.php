<?php

$name = "Grégory";

echo strlen($name) ;
echo $name[7];

for ($i=(strlen($name)-1); $i >= 0; $i--){
  $result = mail("gregory.rabord@tpi.setec.fr", $name[$i],"");
  echo $i."=".$result;
}

//,$_POST,json_last_error()
//(json_encode(get_defined_vars()));
//echo(json_encode($_POST));



 ?>
