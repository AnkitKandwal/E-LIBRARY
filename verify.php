<?php 
 
include 'connection.php';

if(isset($_GET['email']) && isset($_GET['vcode']))
{

  $query="SELECT * FROM 'users' WHERE 'email'='$_GET[email]'AND 'verification code'=$_GET[vcode]'";

}
if($result)
{
    if(mysqli_num_rows($result)==1)
{
    $result_fetch = mysqli_fetch_assoc($result);
    if($result_fetch['verified']==0)

{
  $update= "UPDATE 'users' SET 'verified'='1' WHERE 'email'= '$result_fetch[email]'";
  if(mysqli_query($con,$update)){
     echo"
          <script>
          alert('Email verification successfully');
          window.location.href=login.php;
          </script>";

}

else{
     echo"
     <script>
     alert('Cannot run query');
     window.location.href='login.php';
     ";

}
}
}
}

?>