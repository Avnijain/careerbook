    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <html>
	<head>
	    <link rel="stylesheet" href="css/sliderStyle.css" type="text/css" media="screen"/>
		    <style>
		*{
		    margin:0;
		    padding:0;
		}
    
		a.back{
		    background:transparent url(./images/back.png) no-repeat top left;
		    position:fixed;
		    width:150px;
		    height:27px;
		    outline:none;
		    bottom:0px;
		    left:0px;
		}
		#content{
		    margin:150px auto 10px auto;
		}
		.reference{
		    clear:both;
		    width:800px;
		    margin:30px auto;
		}
		.reference p a{
		    text-transform:uppercase;
		    text-shadow:1px 1px 1px #fff;
		    color:#666;
		    text-decoration:none;
		    font-size:10px;
		}
		.reference p a:hover{
		    color:#333;
		}
	    </style>
	</head>
	<body>
	    <div id="content">
		<a class="back" href=""></a>
		<div class="rotator">
		    <ul id="rotmenu">
			<li>
			    <a href="rot1">About Us</a>
			    <div style="display:none;">
				<div class="info_image">../images/career.jpg</div>
				<div class="info_heading">Our Works</div>
				<div class="info_description">
				    <ul>
				    <li id="reconnect">Stay informed about your contacts and industry</li>
				    <li id="answers">Find the people &amp; knowledge you need to achieve your goals</li>
				    <li id="power">Control your professional identity online</li>
				    </ul>
				</div>
			    </div>
			</li>
			<li>
			    <a href="rot2">Services</a>
			    <div style="display:none;">
				<div class="info_image">../images/2.jpg</div>
				<div class="info_heading">We serve</div>
				<div class="info_description">
				    <ul>
					<li>Resume Building...Build a professional look</li>
					<li>Career Guidance...</li>
					<li>Counsultancy...</li>
				    </ul>
				</div>
			    </div>
			</li>
			<li>
			    <a href="rot3">Contact</a>
			    <div style="display:none;">
				<div class="info_image">../images/3.jpg</div>
				<div class="info_heading">Get in touch</div>
				<div class="info_description">
				    <?php require_once 'contactus.php'?>
				</div>
			    </div>
			</li>
		    </ul>
		    <div id="rot1">
			<img src="" width="800" height="300" class="bg" alt=""/>
			<div class="heading">
			    <h1></h1>
			</div>
			<div class="description">
			    <p></p>
			</div>    
		    </div>
		</div>
	    </div>
	    <div class="reference">
	    </div>
	   <!-- The JavaScript -->
	    <script type="text/javascript" src="./JavaScript/jquery.min.js"></script>
	    <script type="text/javascript" src="./JavaScript/jquery.easing.1.3.js"></script>
	    <script type="text/javascript">
		$(function() {
		    var current = 1;
		    
		    var iterate		= function(){
			var i = parseInt(current+1);
			var lis = $('#rotmenu').children('li').size();
			if(i>lis) i = 1;
			display($('#rotmenu li:nth-child('+i+')'));
		    }
		    display($('#rotmenu li:first'));
		    var slidetime = setInterval(iterate,3000);
				    
		    $('#rotmenu li').bind('click',function(e){
			clearTimeout(slidetime);
			display($(this));
			e.preventDefault();
		    });
				    
		    function display(elem){
			var $this 	= elem;
			var repeat 	= false;
			if(current == parseInt($this.index() + 1))
			    repeat = true;
					    
			if(!repeat)
			    $this.parent().find('li:nth-child('+current+') a').stop(true,true).animate({'marginRight':'-20px'},300,function(){
				$(this).animate({'opacity':'0.7'},700);
			    });
					    
			current = parseInt($this.index() + 1);
					    
			var elem = $('a',$this);
			
			    elem.stop(true,true).animate({'marginRight':'0px','opacity':'1.0'},300);
					    
			var info_elem = elem.next();
			$('#rot1 .heading').animate({'left':'-420px'}, 500,'easeOutCirc',function(){
			    $('h1',$(this)).html(info_elem.find('.info_heading').html());
			    $(this).animate({'left':'0px'},400,'easeInOutQuad');
			});
					    
			$('#rot1 .description').animate({'bottom':'-270px'},500,'easeOutCirc',function(){
			    $('p',$(this)).html(info_elem.find('.info_description').html());
			    $(this).animate({'bottom':'0px'},400,'easeInOutQuad');
			})
			$('#rot1').prepend(
			$('<img/>',{
			    style	:	'opacity:0',
			    className : 'bg'
			}).load(
			function(){
			    $(this).animate({'opacity':'1'},600);
			    $('#rot1 img:first').next().animate({'opacity':'0'},700,function(){
				$(this).remove();
			    });
			}
		    ).attr('src','images/'+info_elem.find('.info_image').html()).attr('width','800').attr('height','300')
		    );
		    }
		});
	    </script>
	</body>
    </html>
