<?PHP
  // Original PHP code by Chirp Internet: www.chirp.com.au
  // Please acknowledge use of this code by including this header.
  include '../classes/appel_offres.class.php';
  
  function cleanData(&$str)
  {
    $str = preg_replace("/\t/", "\\t", mb_convert_encoding($str, 'UTF-16LE', 'UTF-8') );
    $str = preg_replace("/\r?\n/", "\\n", mb_convert_encoding($str, 'UTF-16LE', 'UTF-8'));
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', mb_convert_encoding($str, 'UTF-16LE', 'UTF-8')) . '"';
  }
  
  function export($tableName){
  // filename for download
  $filename = $tableName  . date('Ymd') . ".xls";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel;charset=UTF-8");
 
  $AO = new offres();
  
  $flag = false;
  $result = $AO->getAppelOffre();
  foreach ($result as &$row) {
    
     if(!$flag) {
      //display field/column names as first row
       echo implode("\t", array_keys($row)) . "\r\n";
       $flag = true;
     }
    array_walk($row, __NAMESPACE__ . '\cleanData');
    echo implode("\t", array_values($row)) . "\r\n";
  }
  exit();
 }
 
  if (isset($_GET['tableName'])) {
  //die($_GET['tableName']);
    export($_GET['tableName']);
  }

  
?>