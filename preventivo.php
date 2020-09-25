<?php
function removeCaracteresSQL($string){
  $string = str_replace("=", "", $string);
  $string = str_replace("'", "", $string);
  $string = str_replace("/", "", $string);
  $string = str_replace("or", "", $string);
  $string = str_replace("'", "", $string);
  $string = str_replace("''", "", $string);
  $string = str_replace(">", "", $string);
  $string = str_replace("<", "", $string);
  $string = str_replace("SELECT", "", $string);
  $string = str_replace("INSERT", "", $string);
  $string = str_replace("INTO", "", $string);
  $string = str_replace("DELETE", "", $string);
  $string = str_replace("FROM", "", $string);
  $string = str_replace("WHERE", "", $string);
  $string = htmlspecialchars($string);
  return($string);
}

 ?>
