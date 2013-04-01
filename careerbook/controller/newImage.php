<?php
/*
    **************************** Creation Log *******************************
    File Name                   -  newImage.php
    Project Name                -  Careerbook
    Description                 -  Class file for start
    Version                     -  1.0
    Created by                  -  Mohit K. Singh 
    Created on                  -  March 12, 2013
	***************************** Update Log ********************************
	Sr.NO.		Version		Updated by           Updated on          Description
    -------------------------------------------------------------------------
     
    *************************************************************************

*/


ini_set('display_errors', true);
//*************************************************require class and model***************************************
include_once('../classes/myImage.php');
include_once('../Model/getImageModel.php');



class MergePicture extends  SimpleImage{     //claas which create a merge image for friends and group
    
    private $_frameImage;		//will store a frame image 
    private $_mainImage;		//will store a user image
    private $_subImage;			//will store a array of friends image 
    private $_frm_img_x;		//will store width of frame image
    private $_frm_img_y;		//will store height of frame image 
    private $_src_img_x;		//will store width of merge image
    private $_src_img_y;		//will store height of merge image
    
    
    public function __construct($userImg,$frndImage)
    {
	//****************************************set the class variables***************************************
        $this->_frameImage = imagecreatefromjpeg('../images/frame.jpg');
        $this->_frm_img_x=imagesx($this->_frameImage);
        $this->_frm_img_y=imagesy($this->_frameImage);	
        $this->load($userImg);
        $this->resize(160,130);
        $this->_mainImage=$this->output();
        $this->_subImage=$frndImage;
	
    }
    //*************************************************main function to generate merge image **************************************
    public function merge()
    {
        $img_x = imagesx($this->_mainImage);
        $img_y = imagesy($this->_mainImage);
        

    
        imagecopymerge($this->_frameImage, $this->_mainImage, ($this->_frm_img_x/2)-75, ($this->_frm_img_y/2)-125, 0, 0,$img_x, $img_y, 100);
	if($this->_subImage !=""){
	    shuffle($this->_subImage);
	    $num=1;
	    foreach($this->_subImage as $src){
	        
	        $this->load($src);
	        $this->resize(160,130);
	        $src=$this->output();
            
	        $src_x = imagesx($src);
	        $src_y = imagesy($src);
	        
	        $this->position($num);
            
	        imagecopymerge($this->_frameImage, $src, $this->_src_img_x, $this->_src_img_y, 0, 0,$src_x, $src_y, 100);
	        $num++;
	        if($num > 8){
                break;
	        }
	        imagedestroy($src);
            
	    }
	}
        
    }
    
    //*********************************return a merge image *********************************************
    public function getMergeImage(){
        return $this->_frameImage;
    }
    
    //**************************************finds the co-ordinates of new merge image ****************************************
    private function position($num){
        if($num==1)
        {
            $this->_src_img_x=80;
            $this->_src_img_y=40;
        }
        else if ($num==2)
        {
            $this->_src_img_x=85;
            $this->_src_img_y=$this->_frm_img_y/2-130;
        }
        else if ($num==3)
        {
            $this->_src_img_x=10;
            $this->_src_img_y=$this->_frm_img_y-270;
        }
        else if ($num==4)
        {
            $this->_src_img_x=$this->_frm_img_x/2-55;
            $this->_src_img_y=70;
        }
        else if ($num==5)
        {
            $this->_src_img_x=$this->_frm_img_x-200;
            $this->_src_img_y=50;            
        }
        else if ($num==6)
        {
            $this->_src_img_x=$this->_frm_img_x-170;
            $this->_src_img_y=$this->_frm_img_y/2-85;            
        }
        else if ($num==7)
        {
            $this->_src_img_x=$this->_frm_img_x-320;
            $this->_src_img_y=$this->_frm_img_y-285;            
        }
        else if ($num==8)
        {
            $this->_src_img_x=$this->_frm_img_x/2-215;
            $this->_src_img_y=$this->_frm_img_y-180;            
        }
    }
    
    
     
}

$objImageModel =new MyImageGet();

$userImg=$objImageModel->getUserImage($_REQUEST['userId']);	//get user image  
if(isset($_GET['friends'])){
$frndImage=$objImageModel->getUserFrndsImage($_REQUEST['userId']); //get all my friends image
}
elseif(isset($_GET['group'])){
	$frndImage=$objImageModel->getUserGroupImage($_REQUEST['userId']); //get all my group image
}
 print_r($frndImage);
die;

//**********************************************perform merge image ***********************************************************
$object=new MergePicture($userImg,$frndImage);
$object->merge();
$img=$object->getMergeImage();
imagegif($img);
imagedestroy($img);

?>
