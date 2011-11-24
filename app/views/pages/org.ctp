<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	
	<title>METRICS</title>
	
	<link rel="stylesheet" href="/theme/peers/css/orgtab.css">
	
    <script src='http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js'></script>
    <script src="/theme/peers/js/organictabs.jquery.js"></script>
    <script>
        $(function() {
    
            $("#example-one").organicTabs();
            
            $("#example-two").organicTabs({
                "speed": 200
            });
    
        });
    </script>
</head>

<body>
<?php
 mysql_connect("1.1.0.16", "pr", "0bfvhumddxr2oblm") or die(mysql_error());
  mysql_select_db("pr") or die(mysql_error());

    $users = mysql_query("SELECT * FROM users")
        or die(mysql_error());
    $invites = mysql_query("SELECT * FROM site_invites")
        or die(mysql_error());
?>


		<h1>METRICS</h1>
		
		
	     <div id="example-two">
					
    		<ul class="nav">
                <li class="nav-one"><a href="#featured2" class="current">Users</a></li>
                <li class="nav-two"><a href="#core2">Invitations</a></li>
                <li class="nav-three"><a href="#jquerytuts2">Boards</a></li>
                <li class="nav-four"><a href="#graphs">Graphs</a></li>
                <li class="nav-five last"><a href="#classics2">Numbers</a></li>
            </ul>
    		
    		<div class="list-wrap">
    		
                        <ul id="featured2">
<div id="heads">
                             <ul>
                             <li><h3>Name</h3></li>
                             <li><h3>Inviter</h3></li>
                             <li><h3>Joined Boards</h3></li>
                             <li><h3>Pending Boards</h3></li>
                             <li><h3>Total Invited</h3></li>
                            </ul>
                            </div>
                            <br />
                            <br />
<div id="users">
                            <?php
                             while ($row = mysql_fetch_array( $users )){
                                 /* echo "<li><a href='#'>"; */
                             echo $row['first_name'];
                             echo " ". $row['last_name'];
/* echo "</a></li>"; */
                                echo "<br />";                                                                                                                                             
                             }                                                                                                                                                             
?>
</div>
<div id="inviter">
<?php
     $users2 = mysql_query("SELECT * FROM users")
                 or die(mysql_error());
                            while ($row2 = mysql_fetch_array( $users2 )){
                             $email = $row2['email'];                                                                                                                                       
                             $invquery = mysql_query("SELECT * FROM site_invites WHERE email = '{$email}'");                                                                               
                             $row3 = mysql_fetch_assoc($invquery);                                                                                                                         
                             $invid =  $row3['user_id'];                                                                                                                                   
                             $invquery2 = mysql_query("SELECT * FROM users WHERE id = '{$invid}'");                                                                                        
                             $row4 = mysql_fetch_assoc($invquery2);                                                                                                                        
                             if ($row4['first_name']!=""){                                                                                                                                 
                                 
                                 echo $row4['first_name'];
                                 echo "<br />";
                             }else{                                                                                                                                                        
                                 echo "&times;";
                                 echo "<br />";                                 
                             }} ?>
</div>
<div id="boards">
<?php
                    $users3 = mysql_query("SELECT * FROM users")
                                     or die(mysql_error());
                             while ($row5 = mysql_fetch_array( $users3 )){
                                 $id = $row5['id'];
                                 $boardsquery = mysql_query("select COUNT(board_id) from users_boards where user_id = '{$id}'");
                                $row6 = mysql_fetch_array($boardsquery);
                                 echo $row6['COUNT(board_id)'];
                                 echo "<br />";
                             }
?></div>
<div id="pending">
<?php
                    $users5 = mysql_query("SELECT * FROM users")
                        or die(mysql_error());
                             while ($row9 = mysql_fetch_array( $users5 )){
                                $id3 = $row9['id'];
                                $pendquery = mysql_query("select COUNT(board_id) from board_invitations where user_id = '{$id3}' AND status = 'pending'");
                                $row10 = mysql_fetch_array($pendquery);
                                echo $row10['COUNT(board_id)'];
                                echo "<br />";
                             }
?>
</div>

<div id="invited"><?php
                    $users4 = mysql_query("SELECT * FROM users")
                                or die(mysql_error());
                        while ($row7 = mysql_fetch_array( $users4 )){
                            $id2 = $row7['id'];
                            $invitedquery = mysql_query("select COUNT(id) from site_invites where user_id = '{$id2}'");
                            $row8 = mysql_fetch_array($invitedquery);
                            echo $row8['COUNT(id)'];
                            echo "<br />";
                        }
?>
</div>                                                 
    			</ul>
        		 
        		 <ul id="core2" class="hide">
                    <div id="heads">
                             <ul>
                             <li><h3>Name</h3></li>
                             <li style="padding-right:70px;"><h3>Email</h3></li>
                             <li><h3>Status</h3></li>
                            <!--  <li><h3>Total Invited</h3></li> -->
                            </ul>
                            </div>
                            <br />
                            <br />
                   <div id="names"> <?php
                        $invited = mysql_query("SELECT * FROM site_invites")
                            or die(mysql_error());
                             while ($inv = mysql_fetch_array( $invited )){
                                 /* echo "<li><a href='#'>"; */
                             echo $inv['name'];
                             /* echo "</a></li>"; */
                             echo "<br />";                                                                            
                            }                                                                                            
?>                      </div>
                    <div id="email">
                    <?php
                        $invited2 = mysql_query("SELECT * FROM site_invites")
                            or die(mysql_error());
                            while ($inv2 = mysql_fetch_array( $invited2 )){
                            echo $inv2['email'];
                            echo "<br />";
                            }
?></div>
                <div id="status">
                <?php
                            $invitestat = mysql_query("SELECT * FROM site_invites")
                                or die(mysql_error());
                            while($inv3 = mysql_fetch_assoc( $invitestat )){
                                $emailstat = $inv3['email'];
                                $userz = mysql_query("SELECT * FROM users where email = '{$emailstat}'");
                                $userz2 = mysql_fetch_assoc($userz);
                                 if ($userz2['email']!=""){                                                                
                                         echo "<b>Accepted</b>";
                                         echo "<br />";
                                 }else{                                                                                       
                                         echo "Pending";
                                         echo "<br />";
                                 }}?>
                    </div>
                        </ul>
        		 
        		 <ul id="jquerytuts2" class="hide">
    				<li><a href="http://css-tricks.com/auto-moving-parallax-background/">Auto-Moving Parallax Background</a></li>
        		 </ul>
                         <ul id="graphs" class="hide">
                            test
                        </ul>
        		 <ul id="classics2" class="hide">
                    <li><a href="http://css-tricks.com/php-for-beginners-building-your-first-simple-cms/">PHP: Build Your First CMS</a></li>
        		 </ul>
        		 
    		 </div> <!-- END List Wrap -->
		 
		 </div> <!-- END Organic Tabs (Example One) -->
	
	
	
</body>

</html>
