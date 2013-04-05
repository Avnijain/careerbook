<?php 
/***************************** Creation Log *******************************
File Name                   -  comments.php
Project Name                -  Careerbook
Description                 -  file for displaying discussion comments
Version                     -  1.0
Created by                  -  Prateek Saini
Created on                  -  April 04, 2013
*************************************************************************/
session_start();
if(isset($_SESSION['displayComments'])) {
    $resultSet = $_SESSION['displayComments'];
    $discussionID = $resultSet[0]['discussionID'];

unset($resultSet[0]['discussionID']);
//     echo "<pre/>";
//     print_r($resultSet);
//     die; 
    foreach ( $resultSet as $keys => $values ) {        
        foreach ( $values as $inkeys => $invalues ){
            if(isset($invalues['profile_image'])){
                if(!empty($invalues['profile_image'])){
                    $uri = 'data:image/png;base64,'.base64_encode($invalues['profile_image']);
                    ?>
                    <p>                    
                    <img src="<?php echo $uri;?>" width="35" height="30" class="group_image">
                    <?php
                }
            }
            if(isset($invalues['description'])){
                if(!empty($invalues['description'])){
                    ?>
                    <input type="text" disabled = "true" class="group_textarea"
                    placeholder="Comment" value = "<?php print ($invalues['description']); ?>"/>
                    <?php                    
                }
            }
            if(isset($invalues['first_name'])){
                if(!empty($invalues['first_name'])){
                    ?>
                    <span style="font-family: arial,sans-serif;font-size: 12px;float:right;">
                        <?php
                        print($invalues['first_name']);
                        ?>                    
                    <?php
                }
            }
            if(isset($invalues['created_on'])){
                if(!empty($invalues['created_on'])){
                    ?>
                        <?php
                        print($invalues['created_on']);
                        ?>
                    </span>
                    </p>
                    <?php
                }
            }            
        }
    }
}
?>
<style>
input[type="text"], textarea {
    background: none repeat scroll 0 0 transparent;
    border: 1px solid #F8F5F1;
    border-radius: 5px 5px 5px 5px;
    box-shadow: 0 0 1px #B3A895 inset;
    color: #7C7873;
    font: 14px normal normal uppercase helvetica,arial,serif;
    height: 36px;
    margin: 0 0 10px;
    padding: 0 10px;
    width: 380px;
}
textarea {
    height: 80px;
    padding-top: 14px;
}
textarea:focus, input[type="text"]:focus {
    background: none repeat scroll 0 0 rgba(255, 255, 255, 0.35);
}
</style>
<textarea id="commentID" class="group_textarea" placeholder="Comment"></textarea>
<input type="submit" id = "commentSubmit" value="post comment"></input>
<script src="../JavaScript/jquery-1.7.1.js"></script>
<script>
$(function(){
	$("#commentSubmit").click(function(){
		$.post("../controller/mainentrance.php",{"action":"postComment",
			"comment":$("#commentID").val(),
			"discussionID":"<?php echo $discussionID; ?>"},function(data,status){ 
			});
		});
});

</script>