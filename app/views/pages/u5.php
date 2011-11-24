<?php
 mysql_connect("1.1.0.16", "pr", "0bfvhumddxr2oblm") or die(mysql_error());
 mysql_select_db("pr") or die(mysql_error());
  
  $result = mysql_query("SELECT * FROM users")
       or die(mysql_error());  
echo "<h2>Registered Users</h2>";
  while ($row = mysql_fetch_array( $result )){
           echo $row['first_name'];
                echo " ". $row['last_name'];
                echo "<br />";
                 }
echo "<h2>Invites Sent</h2>";
 $invites = mysql_query("SELECT * FROM site_invites")
         or die(mysql_error());

  while ($row2 = mysql_fetch_array( $invites )){
           echo $row2['name'];
                echo " | ". $row2['email'];
                echo "<br />";
                 }
  ?>
