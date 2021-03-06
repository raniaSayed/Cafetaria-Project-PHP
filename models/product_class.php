<?php
include_once('Model.php');
class Product extends Model
{

 public $id;
 public $name;
 public $price;
 public $quantity;
 public $category_id;
 public $imagepath;

//****************
public $dbname;
public $host;
public $dbuser;
public $upasswd;
public $dsn;
public $db_connection ;


public function __construct()
{
  parent::__construct();
   $this->dbname="Cafeteria";
    $this->host="localhost";
    $this->dbuser="rania";
    $this->upasswd="rania2017";
  //data source name
   $this->dsn = "mysql:host=$this->host;dbname=$this->dbname";

   $this->db_connection = new PDO($this->dsn, $this->dbuser,$this->upasswd);

   $this->db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}


 public function Add_Product()
 {

   $query="insert into products (name,price,quantity,category_id,imagepath) values (?,?,?,?,?)";


   $insert_statm=$this->db_connection->prepare($query);

   $insert_parameters=[$this->name,$this->price,$this->quantity,$this->category_id,$this->imagepath];

    $insert_statm->execute($insert_parameters);

 }

//*******************

 public function Edit_Product()
 {

   //,imagePath=?
   $query="update products set  name=?,price=?,quantity=?,category_id=? where id=?";


   $edit_statm=$this->db_connection->prepare($query);

   $edit_parameters=[$this->name,$this->price,$this->quantity,$this->category_id,$this->id];

    $edit_statm->execute($edit_parameters);

    return $edit_statm->rowcount();

 }









//************get products names

 public function check_product_name()
 {


   $query="select name from  products where name= ? ";

   $param=[$this->name];

   $product_name=$this->db_connection->prepare($query);

    $product_name->execute($param);

    return $product_name->rowcount();

 }




public function getAllProducts()
{

   $query="select name,id,price,quantity,imagepath from  products ";

   $select_products=$this->db_connection->prepare($query);

    $select_products->execute();

  return $select_products;


}


//
// public function delete_order()
// {
//
//      $query="delete  from orders where user_id= ?";
//      $param=[$this->id];
//      $usr=$this->db_connection->prepare($query);
//       $usr->execute($param);
//       return $usr->rowcount();
//
// }


public function delete_product()
{

       $query="update  products set  quantity=?  where id= ?";
       $param=[$this->quantity,$this->id];
       $usr=$this->db_connection->prepare($query);
        $usr->execute($param);
        return $usr->rowcount();

  //$this->delete_order();
   //
   // $query="delete  from products where id= ?";
   //
   // $param=[$this->id];
   //
   // $product_name=$this->db_connection->prepare($query);
   //
   //  $product_name->execute($param);
   //
   //  return $product_name->rowcount();

}



public function get_product()
{


   $query="select * from  products where id = ? ";

    $param=[$this->id];
   $select_product=$this->db_connection->prepare($query);


    $select_product->execute($param);

  return $select_product;


}

public function selectProducts()
  {
    $query = sprintf("select * from products where quantity > 0");

    if(! $result_set = $this->prepareStmt($query)){
      echo $this->conn->connect_error;
      return false;
    }
    //$stmt->close();
    return $this->getData($result_set);

  }

}

?>
