<?php 
// if form is submitted
if(isset($_POST["pname"])){
  // create folder
  mkdir(__DIR__ . $_POST["pname"], 0655); // Creates a folder in this directory named whatever value returned by pname input
}
