<?php 
session_start(); 
if(isset($_SESSION['outbox']))
	{  $a1=$_SESSION['outbox'];

	$n=count($a1);
	?><ul>
<?php for($i=0;$i<$n;$i++)
{?>
<li class="toggle">
	<a href="#six<?php echo $i?>"><?php echo $a1[$i]['first_name'];echo $a1[$i]['last_name'];?></a>
	<p id="six<?php echo $i?>">
	<?php echo $a1[$i]['description'];?> <a href=" "><?php echo $a1[$i]['messaging_time'];?></a>
	</p>
</li>
<?php } }?></ul>