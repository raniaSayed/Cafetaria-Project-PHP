<?php

session_start();


//require_once('models/user_class.php');
require_once('models/user_class.php');

//***********************************

$check=false;

if(isset($_POST['user_name']))
{
	$uname=trim($_POST['user_name']);

  if(!empty($uname))
  {

  }else
  {
  	$check=true;
  	$err="Enter User Name";
  }
}






if($check)
{

$_SESSION['usrname']=$_POST['user_name'];
$_SESSION['room_number']=$_POST['rooms'];
//$_SESSION['extra_room']=$_POST['exrooms'];


 $errors='</br> '.$err;
 header("location:edit_user.php?errormsg=$errors");

 exit;
}
else
{


$eusr=new User();
$eusr->name=$_POST['user_name'];
$eusr->room_num=$_POST['rooms'];

$eusr->extra_room=$_POST['exrooms'];
$eusr->id=$_SESSION['userid'];



//echo $eusr->name.$eusr->room_num.$eusr->extra_room.$eusr->id;

 $t=$eusr->Edit_User();

header("location:All_Users.php");

//  if($t > 0)
//  {
//
//   unset($_SESSION['usrname']);
//   unset($_SESSION['room_number']);
//   unset($_SESSION['extra_room']);
//   unset($_SESSION['userid']);
//  // echo "product edited sucssessfully";
//
// header("location:All_Users.php");
//  }else
//  {
//  	echo "not edited";
//  }




}





?>
