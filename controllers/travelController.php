<?php

class travelController extends Controller {
    
    
	function travel(){
$num=0;
$dst=$this->model("sqlcommand");   
$row=$dst->ds($num);

$lat = $row['lat'];                // 取經度
$lng = $row['lng'];                // 取緯度
$mark = $row['mark'];  
 // 取資料
  if(!empty($_POST['word']))
{
    $word = ereg_replace("\n", "<br />\n", $_POST['word']); // 將換行轉成資料庫存取的換行符號
    $getword=$this->model("sqlcommand");
    $getword->getedit($word);

}




$mylist=$this->model("sqlcommand");   
$result =$mylist->mylist();

$myedit=$this->model("sqlcommand");
$row2 =$myedit->showedit();







// 列出加入的景點名稱
if(mysqli_num_rows($result)>0){
 while($row =mysqli_fetch_array($result)){
   
$this->view("travel",[$lat,$lng,$mark],[$row['dname'],$row['dnum']],$row2); 
}

}
}
        

function goedit(){
$echoedit=$this->model("sqlcommand");
$edit =$echoedit->myedit();

$this->view("travel_edit",$edit);
}





	function dsbutton(){
			
			$dst=$this->model("sqlcommand");
			
	if(isset($_POST['tain']))
			$num=1;
			
   
// 點選"Taichung按鈕"
else

   $num=0;
   
$row=$dst->ds($num);

$lat = $row['lat'];                // 取經度
$lng = $row['lng'];                // 取緯度
$mark = $row['mark'];  
 // 取資料
$mylist=$this->model("sqlcommand");   
$result =$mylist->mylist();

$myedit=$this->model("sqlcommand");
$row2 =$myedit->showedit();

// 列出加入的景點名稱
if(mysqli_num_rows($result)>0){
 while($row =mysqli_fetch_array($result)){
   
$this->view("travel",[$lat,$lng,$mark],[$row['dname'],$row['dnum']],$row2); 

}
}
}




function mydelete($dnum){
 
    $deletedst=$this->model("sqlcommand");
    $row=$deletedst->deletedb($dnum);
    
    
    $this->view("/EasyMVC/travel/travel",$dnum); 
  
  
}







}

?>