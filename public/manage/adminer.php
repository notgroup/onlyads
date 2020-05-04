<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', false);

function adminer_object() {

  class AdminerSoftware extends Adminer {

    function name() {
      // custom name in title and heading
      return 'Software';
    }

  /* function permanentLogin() {
      // key used for permanent login
      return '26ddbfebb2eb6f439cdb698e0154796a';
    }*/



    function credentials() {
      // server, username and password for connecting to database
      if (isset($_GET['sqlite'])) {
        # code...
        return array('localhost', 'ODBC', '');
      } else {
        return array('localhost', 'root', '123456');

      }
    }
    function get_sqlite() {

     $path = "../../database/db/";
     $prod = "../../database/database.sqlite";
     $files = array_values(array_diff(scandir($path), array('.', '..')));
     $empty_array = [$prod];
     foreach($files as $file)
     {
      if( is_file($path.$file) && (strpos($file, 'sqlite') || strpos($file, 'db')))
      {
       $empty_array[] = $path.$file;
     }
   }
   return $empty_array;
 }

 function databases($flush = true) {
   if (isset($_GET['sqlite']))
     return $this->get_sqlite();
   return get_databases($flush);
 }
 function login($login, $password) {
      // validate user submitted credentials
  if (isset($_GET['sqlite'])) {
    return ($login == 'admin' && $password == '951753db');
  } else {
    return true;

  }
}




}

return new AdminerSoftware;
}



include './adminer-4.7.6-en.php';
