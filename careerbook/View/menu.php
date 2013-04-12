</head>
<body>
    <a href="javascript:void(0)" id="selectorLogin"></a>
	<div id="mainWrapper">
		<div id="headerWrapper">
			<div id="top">
				<div class="cl">&nbsp;</div>
				<div id="header_left">
    				<h1 id="logo">
    					<a href="#"><?php echo $lang->PROJECTTITLE; ?></a>
    				</h1>
				</div>				
				<div id="header_right">
					<div id = "header_userName" > 
    				<label id="header_userNameLabel"><?php echo $lang->WELCOME ?> <?php	
    				echo $userData ['first_name'] . " " . $userData ['last_name'];
    				?></label></div>
    				<div id = "header_logout" ><a href="./userHomePage.php?logOut"
        			class="btn blue"><?Php echo $lang->LOGOUT?></a></div>    				
				</div>
				<div id="header_right_search">
    				<form action="userHomePage.php" method="get" id="search">
    					<div class="field-holder">
    						<input type="text" class="field" placeholder="Search"
    							title="Search" name="Search">
    					</div>
    					<input type="submit" class="button" value="Search">
    					<div class="cl">&nbsp;</div>
    				</form>
				</div>
			</div>
			<nav class="top-nav">
				<div class="shell">
					<a href="#" class="nav-btn"><?php echo $lang->HOME?><span></span></a>
					<span class="top-nav-shadow"></span>
					<ul>
						<li class="active first"><span><a href="userHomePage.php"><?php echo $lang->HOME?></a></span></li>
						<li><span><a href="../controller/mainentrance.php?action=Group"><?php echo $lang->GROUP?></a></span></li>
						<li><span><a href="userHomePage.php?Friends"><?php echo $lang->FRIENDS?></a></span></li>
						<li><span><a href="userHomePage.php?message"><?php echo $lang->MESSAGES?></a></span></li>
						<li><span><a href="userHomePage.php?resume"><?php echo $lang->RESUME?></a></span></li>
						<li><span><a href="userHomePage.php?profile"><?php echo $lang->ACCOUNT?></a></span></li>
						<li><span><a href="userHomePage.php?information"><?php echo $lang->PROFILE?></a></span></li>
						<li class="last"><span><a href="userHomePage.php?Settings"><?php echo $lang->SETTINGS?></a></span></li>
					</ul>
				</div>
			</nav>
		</div>
		<div id="contentWrapper">