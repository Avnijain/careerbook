<?php
include_once("../classes/lang.php");
?>
<div class="post">
					<p>
						<?php
							$ip= $_SERVER['REMOTE_ADDR'];
							echo $lang->IPADDRESS;
							echo " " . $ip;
							echo "<br>";
							//echo $_SERVER['HTTP_USER_AGENT'];
						?>
						
					</p>
				    	<div class="image">
				    		<a href="userHomePage.php?message"><img src="../images/message.jpg" alt="" width="90%"></a>
				    	</div>
				    	<div class="data">
				    		<p><?php echo $lang->USERMESSAGES?></p>
							<?php
								
								require_once '../controller/message_controller.php';
								$objMessage1 = new MessageController();
								$count=$objMessage1->handleNewMessage();
								print($count[0]['count(id)']);
							?>
				    	</div>
				    </div>
				    <!-- /Post -->
					<!-- Post -->
				   <div class="post last">
				    	<div class="image">
				    		<a href="userHomePage.php?FriendsRequest"><img src="../images/addFriends.jpg" alt="" width="90%"></a>
				    	</div>
				    	<div class="data">
				    		<p><?php echo $lang->USERFRIENDREQUEST?></p>
                                                
                                                <?php
                                                    
                                                        include_once('../classes/friendsClass.php');
                                                        $friendsReqData=unserialize($_SESSION['FrndReq']);
                                                        $myFrndReq= $friendsReqData->countReqFrnds();
                                                        echo "<b>".$myFrndReq."</b>";
                                                    
                                                ?>
                                                                                         
                                                                                               
				    	</div>
				    </div>
				    <!-- /Post -->
				    <div class="cl">&nbsp;</div>
				</div>