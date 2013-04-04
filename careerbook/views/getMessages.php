<?php 
//$text="hello how  are you . my name is mohit";
ini_set("display_errors",1);
include_once "../controller/friends_controller.php";


    $frndDisData = array();
    $frndDisData = $objFrndControl->start('getFrndsDis');
    $discussions = array(array("id"=>"0","discussion"=>"empty","comments"=>array()));
    $disCnt = 1;    



// echo "<pre/>";
// print_r ( array_keys($frndDisData) ); 
// print_r ( $frndDisData);
// die;
 
 
 
 //echo "<pre/>";
//  foreach($frndDisData as $key => $value){
// //     print_r($value);     
//      foreach($value as $inkey => $invalue){        
//   //       print_r($invalue);
// //         print($disCnt);         

//         // print($invalue["id"]);
//          for($i = 0 ; $i < $disCnt; $i++ ){
//              if($dis[$i]['id'] == $invalue["id"]){                 
//                  $dis[$i]['comments'][] = $invalue["comments"];
//              }
//              else if( $dis[$i]['id'] == "0" ){
//                  //echo "yes";
//                  $dis[$i]['id'] = $invalue["id"];
//                  $dis[$i]['discussion'] = $invalue["discussion"];
//                  $dis[$i]['comments'][] = $invalue["comments"];
//                  break;
//              }
//              //print_r($dis[$i]);
//          }
//          $dis[] = array("id"=>"0","discussion"=>"empty","comments"=>array());
//          $disCnt++;
//          //echo "<br/>";
//      }     
//  }
 //echo "<pre/>";
 //print_r($invalue);
// print_r($dis);
 
 //print_r($frndDisData);
 //die;
// $images = array(array("a1.jpeg"," first Discussion"),
// 		array("a2.jpeg","second Discussion"),
// 		array("a3.jpg","Third Discussion"),
// 		array("a4.jpeg","forth Discussion"));
?>