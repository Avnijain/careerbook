<?php
 
/*
    **************************** Creation Log *******************************
    File Name                   -  myImage.php
    Project Name                -  Careerbook
    Description                 -  Class file for start
    Version                     -  1.0
    Created by                  -  Mohit K. Singh 
    Created on                  -  March 10, 2013
	***************************** Update Log ********************************
	Sr.NO.		Version		Updated by           Updated on          Description
    -------------------------------------------------------------------------
     
    *************************************************************************
*/
ini_set("display_errors", "1"); 
class SimpleImage {
 
   private $_image;			//Store temporary   Image  
   private $_image_type;		//Store Image Type eg:- jpeg,jpg,gif,png etc
 
 //Load Image in class variable 
   function load($filename) {
 
      $image_info = getimagesize($filename);
      $this->_image_type = $image_info[2];
      if( $this->_image_type == IMAGETYPE_JPEG ) {
 
         $this->_image = imagecreatefromjpeg($filename);
      } elseif( $this->_image_type == IMAGETYPE_GIF ) {
 
         $this->_image = imagecreatefromgif($filename);
      } elseif( $this->_image_type == IMAGETYPE_PNG ) {
 
         $this->_image = imagecreatefrompng($filename);
      }
   }
   //save image 
   function save($filename, $image_type=IMAGETYPE_JPEG, $compression=75, $permissions=null) {
 
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->_image,$filename,$compression);
      } elseif( $image_type == IMAGETYPE_GIF ) {
 
         imagegif($this->_image,$filename);
      } elseif( $image_type == IMAGETYPE_PNG ) {
 
         imagepng($this->_image,$filename);
      }
      if( $permissions != null) {
 
         chmod($filename,$permissions);
      }
   }
   
   //return image 
   function output($image_type=IMAGETYPE_JPEG) {
 
      if( $image_type == IMAGETYPE_JPEG ) {
         return $this->_image;
      } elseif( $image_type == IMAGETYPE_GIF ) {
 
         return $this->_image;
      } elseif( $image_type == IMAGETYPE_PNG ) {
 
         return $this->_image;
      }
   }
   //return width of the image 
   function getWidth() {
 
      return imagesx($this->_image);
   }
   //return height of the image 
   function getHeight() {
 
      return imagesy($this->_image);
   }
   // re-size the height of the image 
   function resizeToHeight($height) {
 
      $ratio = $height / $this->getHeight();
      $width = $this->getWidth() * $ratio;
      $this->resize($width,$height);
   }
   // re-size the width of the image 
   function resizeToWidth($width) {
      $ratio = $width / $this->getWidth();
      $height = $this->getheight() * $ratio;
      $this->resize($width,$height);
   }
   //scale the image 
   function scale($scale) {
      $width = $this->getWidth() * $scale/100;
      $height = $this->getheight() * $scale/100;
      $this->resize($width,$height);
   }
   //set new height & width of the image 
   function resize($width,$height) {
      $new_image = imagecreatetruecolor($width, $height);
      imagecopyresampled($new_image, $this->_image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
      $this->_image = $new_image;
   }      
 
}




?>