<?php

session_start();
//chk_product.php
//chech product data before inserting in database

require_once('product_class.php');

//***********************************

$check=false;



//***************************check photo********************

   $file_ext=strtolower(end(explode('.',$_FILES['product_picture']['name'])));
      
      $expensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$expensions)=== false){
         $pherror="extension not allowed, please choose a JPEG or PNG  or JPG file.";
         $check=true;
      }

//*************************************check name*******************
   /*$productobj=new Product();
    
    $nm=trim($_POST['product_name']);

   $productobj->name=$nm;
   $pro_exist=$productobj->check_product_name();

  if($pro_exist > 0)
  {
    $nameerror="Product Name is exist please enter Unique Name";
    $check=true;
  }*/



//**********************************
if($check)
{


$_SESSION['proname']=$_POST['product_name'];
$_SESSION['proprice']=$_POST['product_price'];
$_SESSION['proquantity']=$_POST['product_quantity'];
$_SESSION['procat']=$_POST['category'];



 $errors=$pherror.'</br> '.$nameerror;
 header("location:Add_Product.php?errormsg=$errors");




 exit;
}
else
{


  unset($_SESSION['proname']);
  unset($_SESSION['proprice']);
  unset($_SESSION['proquantity']);
  unset($_SESSION['procat']);
  unset($_SESSION['proid']);


$productobj=new Product();

$pro_img_path='products_imgs/'.$_FILES['product_picture']['name'];
move_uploaded_file($_FILES['product_picture']['tmp_name'], $pro_img_path);


$productobj->name=$_POST['product_name'];
$productobj->price=$_POST['product_price'];
$productobj->quantity=$_POST['product_quantity'];
$productobj->category_id=$_POST['category'];

$productobj->imagepath=$pro_img_path;

$productobj->Edit_Product();


//echo "product added sucssessfully";

header("location:All_Products.php");


}





?>