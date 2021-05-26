<?php
include_once "config.php";

class Crud extends Config
{

  function __construct()
  {
    parent::__construct();
  }


//Display All
  public function displayAll($table)
  {
    $query = "SELECT * FROM {$table}";
    $result = $this->con->query($query);
    if ($result->num_rows > 0) {
      $data = array();
      while ($row = $result->fetch_assoc()) {
        $data[] = $row;
      }
      return $data;
    }else{
      return 0;
    }
  }



  public function displayAllWithOrder($table,$orderValue,$orderType)
  {
    $query = "SELECT * FROM {$table} ORDER BY {$orderValue} {$orderType}";
    $result = $this->con->query($query);
    if ($result->num_rows > 0) {
      $data = array();
      while ($row = $result->fetch_assoc()) {
        $data[] = $row;
      }
      return $data;
    }else{
      return 0;
    }
  }


  public function displayAllSpecific($table,$value,$item)
  {
    $query = "SELECT * FROM {$table} WHERE $value='$item' ";
    $result = $this->con->query($query);
    if ($result->num_rows > 0) {
      $data = array();
      while ($row = $result->fetch_assoc()) {
        $data[] = $row;
      }
      return $data;
    }else{
      return 0;
    }
  }


    public function displayAllSpecificWithOrder($table,$value,$item,$orderValue,$orderType)
  {
    $query = "SELECT * FROM {$table} WHERE $value='$item' ORDER BY {$orderValue} {$orderType}";
    $result = $this->con->query($query);
    if ($result->num_rows > 0) {
      $data = array();
      while ($row = $result->fetch_assoc()) {
        $data[] = $row;
      }
      return $data;
    }else{
      return 0;
    }
  }


public function displayOneSpecific($table,$item,$value)
  {
    $item = $this->cleanse($item);
    $value = $this->cleanse($value);
    $query = "SELECT * FROM {$table} where $item='$value' ";
    $result = $this->con->query($query);
    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      return $row;
    }else{
      return 0;
    }
  }



  
  public function displayWithLimit($table,$limit)
  {
    $query = "SELECT * FROM {table} limit {$limit}";
    $result = $this->con->query($query);
    if ($result->num_rows > 0) {
      $data = array();
      while ($row = $result->fetch_assoc()) {
        $data[] = $row;
      }
      return $data;
    }else{
      return 0;
    }
  }

    public function displayNameById($table,$value)
  {
    $id = $this->cleanse($value);
    $query = "SELECT * FROM {$table} where id='$id' ";
    $result = $this->con->query($query);
    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      return $row['name'];
    }else{
      return 0;
    }
  }




  
//Counting All
  public function countAll()
  {
    $q=$this->con->query("SELECT type_id FROM vehicle_type");
    return $q->num_rows;
  }

//Counting Specific
  
  
// Inserting
  public function insertData($post)
  {
    $value1 = $this->cleanse($_POST['value1']);
    $value2 = $this->cleanse($_POST['value2']);
    $query="INSERT INTO table(col1,col2) VALUES('$value1','$value2')";
    $sql = $this->con->query($query);
    if ($sql==true) {
      header("Location:url?msg=Data was successfully inserted&type=success");
    }else{
      header("Location:url?msg=Error adding data try again!&type=error");
    }
  }

//Inserting with Files

  public function insertDataWithFiles($post)
  {
    $value1 = $this->cleanse($_POST['value1']);
    $value2 = $this->cleanse($_POST['value2']);

      $img1=$_FILES['img1']['name'];
    $temp=$_FILES['img1']['tmp_name'];
    $folder="images/" ;  
    $pos1=strpos($img1,'.');
    $len1=strlen($img1);
    $ext1=substr($img1, $pos1, $len1); 
    $imgv1=str_replace($img1,'.',uniqid().$ext1 ); 
    $imgf1='mymodel-'.$imgv1;

    move_uploaded_file($temp,$folder.$imgf1)  ;

    $query="INSERT INTO table(col1,col2) VALUES('$value1','$value2')";
    $sql = $this->con->query($query);
    if ($sql==true) {
      header("Location:url?msg=Data was successfully inserted&type=success");
    }else{
      header("Location:url?msg=Error adding data try again!&type=error");
    }
  }


//Delete Items
  public function delete($id, $table,$url) 
  { 
    $id = $this->cleanse($id);
    $query = "DELETE FROM $table WHERE id = $id";

    $result = $this->con->query($query);

    if ($result == true) {
      header("Location:$url?msg=Data was successfully deleted&type=success");
    } else {
      header("Location:$url?msg=Error deleting data&type=error");
    }
  }


  //Delete Items
  public function deleteTwo($id,$id1,$t,$id2,$t2,$url) 
  { 
    $id = $this->cleanse($id);
    $query = "DELETE FROM $t WHERE $id1 = $id";
    $query2 = "DELETE FROM $t2 WHERE $id2 = $id";

    $result = $this->con->query($query);
    $result2 = $this->con->query($query2);

    if ($result == true && $result2 == true) {
      header("Location:$url?msg=Data was successfully deleted&type=success");
    } else {
      header("Location:$url?msg=Error deleting data&type=error");
    }
  }



  //Delete Items
  public function deleteThree($id,$id1,$t,$id2,$t2,$id3,$t3,$url) 
  { 
    $id = $this->cleanse($id);
    $query = "DELETE FROM $t WHERE $id1 = $id";
    $query2 = "DELETE FROM $t2 WHERE $id2 = $id";
    $query3 = "DELETE FROM $t3 WHERE $id3 = $id";

    $result = $this->con->query($query);
    $result2 = $this->con->query($query2);
    $result3 = $this->con->query($query3);

    if ($result == true && $result2 == true && $result3 == true) {
      header("Location:$url?msg=Data was successfully deleted&type=success");
    } else {
      header("Location:$url?msg=Error deleting data&type=error");
    }
  }


  public function updateAdmin($post)
  {
    $name=$this->cleanse($_POST['name']);
    $email=$this->cleanse($_POST['email']);
    $password=$this->cleanse($_POST['password']);
    $query="UPDATE login SET name='$name',email='$email',password='$password' WHERE email='$email' ";
    $sql=$this->con->query($query);
    if ($sql==true) {
      header("Location:profile.php?msg=Account was updated successfully&type=success");
    }else{
      header("Location:profile.php?msg=Error updating account try again!&type=error");
    }
  }


  //Search
  public function displaySearch($value)
  {
  //Search box value assigning to $Name variable.
    $Name = $this->cleanse($value);
    $query = "SELECT * FROM product WHERE pid LIKE '%$Name%'";
    $result = $this->con->query($query);
    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      return $row;
    }else{
      return false;
    }
  }


//Mailing Function
  public function mailing($post)
  {
    $name=$this->cleanse($_POST['name']);
    $email=$this->cleanse($_POST['email']);
    $phone=$this->cleanse($_POST['phone']);
    $subject=$this->cleanse($_POST['subject']);
    $text=$this->cleanse($_POST['message']);

    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= "From: " . $email . "\r\n"; // Sender's E-mail  ---charset=iso-8859-1
    $headers .= 'Content-type: text/html; charset=utf8_encode' . "\r\n";

    $message ='<table style="width:100%">
    <tr>
    <td>'.$name.'  '.$subject.'</td>
    </tr>
    <tr><td>Email: '.$email.'</td></tr>
    <tr><td>phone: '.$subject.'</td></tr>
    <tr><td>Text: '.$text.'</td></tr>

    </table>';
    $to='support@dilproperty.com';

    if (@mail($to, $subject, $message, $headers))
    {
      header("Location:contact.php?msg=Your message has been sent, we will contact you in a moment&type=success");
    }else{
      header("Location:contact.php?msg=message failed sending, please try again later!&type=error");
    }

  }


  
//Empty Table
  public function emptyTable($table,$url) 
  { 
    $id = $this->cleanse($id);
    $query = "TRUNCATE {$table}";

    $result = $this->con->query($query);

    if ($result == true) {
      header("Location:$url?msg=Data was successfully deleted&type=success");
    } else {
      header("Location:$url?msg=Error deleting data&type=error");
    }
  }




  public function cleanse($str)
  {
   #$Data = preg_replace('/[^A-Za-z0-9_-]/', '', $Data); /** Allow Letters/Numbers and _ and - Only */
    $str = htmlentities($str, ENT_QUOTES, 'UTF-8'); /** Add Html Protection */
    $str = stripslashes($str); /** Add Strip Slashes Protection */
    if($str!=''){
      $str=trim($str);
      return mysqli_real_escape_string($this->con,$str);
    }
  }




  

  public function greeting()
  {
      //Here we define out main variables 
    $welcome_string="Welcome!"; 
    $numeric_date=date("G"); 

 //Start conditionals based on military time 
    if($numeric_date>=0&&$numeric_date<=11) 
      $welcome_string="Good Morning!,"; 
    else if($numeric_date>=12&&$numeric_date<=17) 
      $welcome_string="Good Afternoon!,"; 
    else if($numeric_date>=18&&$numeric_date<=23) 
      $welcome_string="Good Evening!,"; 

    return $welcome_string;

  }

}

?>

