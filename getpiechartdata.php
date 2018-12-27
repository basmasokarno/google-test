<?php
  $q=$_GET["q"];
  $dbuser="RMGS\basma.sokarno";
    $dbname="HR";
    $dbpass="P@$$w0rd";
    $dbserver=".";

  $sql_query = "select TeamID, TeamName from Team";

  $con = mysql_connect($dbserver,$dbuser,$dbpass);
  if (!$con){ die('Could not connect: ' . mysql_error()); }
  mysql_select_db($dbname, $con);
  $result = mysql_query($sql_query);
  echo "{ \"cols\": [ {\"TeamID\":\"\"
      ,\"label\":\"Name-Label\",\"pattern\":\"\",\"type\":\"string\"}, {\"id\":\"\",\"label\":\"PointSum\",\"pattern\":\"\",\"type\":\"number\"} ], \"rows\": [ ";
  $total_rows = mysql_num_rows($result);
  $row_num = 0;
  while($row = mysql_fetch_array($result)){
    $row_num++;
    if ($row_num == $total_rows){
      echo "{\"c\":[{\"v\":\"" . $row['TeamID'] . "-" . $row['label'] . "\",\"f\":null},{\"v\":" . $row['pointsum'] . ",\"f\":null}]}";
    } else {
      echo "{\"c\":[{\"v\":\"" . $row['TeamID'] . "-" . $row['label'] . "\",\"f\":null},{\"v\":" . $row['pointsum'] . ",\"f\":null}]}, ";
    }
  }
  echo " ] }";
  mysql_close($con);
?>