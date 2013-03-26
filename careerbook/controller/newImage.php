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
include_once('../classes/myImage.php');
include_once('../Model/getImageModel.php');



class mergePicture extends  SimpleImage{
    private $_frameImage;
    private $_mainImage;
    private $_subImage;
    private $_frm_img_x;
    private $_frm_img_y;
    private $_src_img_x;
    private $_src_img_y;
    
    
    public function __construct($userImg,$frndImage)
    {
        $this->_frameImage = imagecreatefromjpeg('../images/frame.jpg');
        $this->_frm_img_x=imagesx($this->_frameImage);
        $this->_frm_img_y=imagesy($this->_frameImage);	
        $this->load($userImg);
        $this->resize(160,130);
        $this->_mainImage=$this->output();
        $this->_subImage=$frndImage;
	//array('../images/a1.jpg','../images/a2.jpg','../images/a3.jpg','../images/a4.jpg','../images/a5.jpg','../images/a6.jpg','../images/a7.jpg','../images/a8.jpg');
    }
    
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
    
    public function getMergeImage(){
        return $this->_frameImage;
    }
    
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
$userImg=$objImageModel->getUserImage($_REQUEST['userId']);


$frndImage=$objImageModel->getUserFrndsImage($_REQUEST['userId']);


$object=new mergePicture($userImg,$frndImage);
$object->merge();
$img=$object->getMergeImage();


imagegif($img);

imagedestroy($img);

?>
