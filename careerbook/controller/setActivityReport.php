<?php
/*
 **************************** Creation Log *******************************
File Name                   -  setActivityReport.php
Project Name                -  Careerbook
Description                 -  Controller Class file for users information
Version                     -  1.0
Created by                  -  Prateek Saini
Created on                  -  April 06, 2013
***************************** Update Log ********************************
Sr.NO.		Version		Updated by           Updated on          Description
-------------------------------------------------------------------------
*************************************************************************
*/
require_once ('../library/jpgraph/src/jpgraph.php');
require_once ('../library/jpgraph/src/jpgraph_line.php');
require_once ('../library/jpgraph/src/jpgraph_bar.php');
session_start();
if(!empty($_SESSION['activityReport'])){
    $resultSet = $_SESSION['activityReport'];    
}
if(isset($resultSet)){
    if(count($resultSet) > 0){        
        foreach($resultSet as $key => $value){
            $year[] = "day$key";
            foreach($value as $inkey => $invalue){
                if($inkey == "comments_count"){
                    $ydata[] = intval($invalue);
                }
            }
        }
    }
}

 // Width and height of the graph
$width = 300; $height = 250;
 
// Create a graph instance
$graph = new Graph($width,$height);
 
// Specify what scale we want to use,
// text = txt scale for the X-axis
// int = integer scale for the Y-axis
$graph->SetScale('textint');
 
// Setup a title for the graph
$graph->title->Set('Activity Report');
 
// Setup titles and X-axis labels
$graph->xaxis->title->Set('(Days)');
$graph->xaxis->SetTickLabels($year);
 
// Setup Y-axis title
$graph->yaxis->title->Set('(# Time Span)');
 
// Create the bar plot
$barplot=new BarPlot($ydata);
 
// Add the plot to the graph
$graph->Add($barplot);    

// Display the graph
$graph->Stroke();
?>