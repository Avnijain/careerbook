function testoverlay() {
			url = "View/NewRegistration.php";
			$("#selectorLogin").attr("href",url);
	        $("#selectorLogin").trigger("click");
		    
		}
		function forgetPwdOverlay() {
			url = "View/forgetPasswd.php";
			$("#selectorLogin").attr("href",url);
	        $("#selectorLogin").trigger("click");
		    
		}
		$(document).ready(function() {
			var screenW = 800, screenH = 1200;
			if (parseInt(navigator.appVersion)>3) {
			 screenW = screen.width;
			 screenH = screen.height;
			}
			else if (navigator.appName == "Netscape" 
			    && parseInt(navigator.appVersion)==3
			    && navigator.javaEnabled()
			   ) 
			{
			 var jToolkit = java.awt.Toolkit.getDefaultToolkit();
			 var jScreenSize = jToolkit.getScreenSize();
			 screenW = jScreenSize.width;
			 screenH = jScreenSize.height;
			}
				$("#selectorLogin").fancybox({
		        'width'			: screenW/2,
		        'height'		: screenH-210,
		        'autoScale'		: false,
		        'transitionIn'		: 'none',
		        'transitionOut'		: 'none',
		        'type'			: 'iframe'
		    });
			
		});
		
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