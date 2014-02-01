<?php 
 ob_start();
 //start session and capture username that we will need later
session_start();
$user = "droup";
 require 'app_setting.php';

//after submiting form create folder for each users and then execute next function
function makedir(){
global $user;
	if (file_exists("upload/".($_SESSION['username']))) {
		upload();
	}else {
		mkdir("upload/".($_SESSION['username']), 0777);
		upload();
	}
}


//upload function
function upload(){
global $user;
try
{
    

// prevent files which are not png jpg
if (!(($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/pjpeg"))){
 echo 'invalid file';
//100KB max file size
}elseif($_FILES["file"]["size"] > 1003000){
 echo 'too big';
//everything is OK
 }else{
   if ($_FILES["file"]["error"] > 0)
     {
     echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
     }
   else
     {
      //save extension of file
	  $exts = explode(".", $_FILES["file"]["name"]) ;
	  $n = count($exts)-1;
	  $exts = $exts[$n];

	 //characters that will be needed to renaming file after upload
	 $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	 //generate random string with minimum 5 and maximum of 10 characters
	 $str = substr( str_shuffle( $chars ), 0, 10);
	 //add extension to file
     $name=$str.".".$exts;
	 //check if file exist (there is almost 0 possibility )
     if (file_exists("uploads/" . $name))
       {
		die("please try again");
		//move uploaded file to right directory
       }else{
       move_uploaded_file($_FILES["file"]["tmp_name"], "uploads/" . $name);
       echo "Stored in: " . "uploads/" .  $name;
        header("Location: app_auto_post.php?filepath=".getcurrentpath(). "uploads/" .  $name);
	   }
     }
   }
}
 catch (Exception $ex)
 {
    echo $ex->getMessage(); 
 }
 
}

if(isset($_POST['submit'])){
//after submiting execute this function
//makedir();
upload();
}
 else {
    echo "i don't know what should i do ..." ; 
}
ob_clean();
?>