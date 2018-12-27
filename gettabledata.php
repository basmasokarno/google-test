<?php
  $q=$_GET["q"];
  $dbuser="RMGS\basma.sokarno";
  $dbname="HR";
  $dbpass="P@$$w0rd";
  $dbserver=".";

  $sql_query = "select TeamID, TeamName from Team;";

  // $sql_query2 = "SELECT nickname, sum(j2.pointsum) as total FROM user JOIN ( SELECT j1.user_id, j1.label, name, hover, j1.pointsum FROM activityfield JOIN ( SELECT user_id, activity_id, label, field_id , SUM( points.points ) AS PointSum FROM points JOIN activity ON points.activity_id = activity.id WHERE points.user_id=" . $q . " GROUP BY points.user_id, points.activity_id, activity.label, activity.field_id ORDER BY points.activity_id ASC ) AS j1 ON activityfield.id = j1.field_id ) AS j2 ON j2.user_id = user.id WHERE pointsum > 0 GROUP BY user.nickname, user.id ORDER BY j2.pointsum DESC;";

  $con = mysql_connect($dbserver,$dbuser,$dbpass);
  if (!$con){ die('Could not connect: ' . mysql_error()); }
  mysql_select_db($dbname, $con);
  $result = mysql_query($sql_query);

  echo "{ \"cols\": [ {\"id\":\"\",\"label\":\"TeamID\",\"pattern\":\"\",\"type\":\"number\"}, 
                      {\"id\":\"\",\"label\":\"TeamName\",\"pattern\":\"\",\"type\":\"number\"}
                    ], \"rows\": [ ";

  $total_rows = mysql_num_rows($result);
  while($row = mysql_fetch_array($result)){
    echo "{\"c\":[{\"v\":\"" . $row['TeamID'] . "\",\"f\":null},
                  {\"v\":\"" . $row['TeamName'] . "\",\"f\":null}]}, ";
  }

  

  echo " ] }";
  mysql_close($con);
?>