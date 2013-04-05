<?php 
/*
 **************************** Creation Log *******************************
File Name                   -  inbox.php
Project Name                -  Careerbook
Description                 -  file for displaying inbox messages 
Version                     -  1.0
Created by                  -  Avni Jain
Created on                  -  March 22, 2013
*/
session_start(); 
if(isset($_SESSION['myinbox'])) { 
	$a=$_SESSION['myinbox'];
	$n=count($a);
	?>
	<ul>
		<?php for($i=0;$i<$n;$i++) { ?>
		<li class="toggle">
			<a href="#inbox<?php echo $i?>"><?php echo $a[$i]['first_name'];echo $a[$i]['last_name'];?></a>
			<p id="inbox<?php echo $i?>">
			<?php echo $a[$i]['description'];?> <a href=" "><?php echo $a[$i]['messaging_time'];?></a>
			</p>
		</li>
		<?php } }?>
    </ul>