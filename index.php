<?php
require_once 'classes/crud.php';
require_once 'library/lib.php';
require_once 'classes/auth.php';
?>

<?php
$lib=new Lib;
$validate=new Auth;
if (isset($_POST['login'])) {
$validate->check($_POST);
}
$lib->msg();
?>

<div class="container">
  <form action="index.php" method="POST">
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" name="email" placeholder="Enter email" required="required">
    </div>
    
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" class="form-control" name="password" placeholder="Enter password" required="required">
    </div>
    <input type="submit" name="login" class="btn btn-primary"  value="Submit">
  </form>
</div>

<?php
$rk=new Crud;
$rq=$rk->displayAll();
foreach ($rq as $r) {
echo $r['name'];
echo $r['password'];
echo "<br/>";
}


$a=$lib->aes_encrypt('1234','God is good');
echo $a.'<br/>';
echo $lib->aes_decrypt('1234',$a);

?>