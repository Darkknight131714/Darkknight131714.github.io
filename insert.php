<?php
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$email=$_POST['email'];
$host = "localhost";
$dbUsername="root";
$dbPassword="";
$dbname="hello";
$conn=new mysqli($host,$dbUsername,$dbPassword,$dbname);
if(mysqli_connect_error())
{
die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
}
else
{
$SELECT="SELECT email From hello Where email = ? Limit 1";
$INSERT= "INSERT Into hello (fname,lname,email) values(?,?,?)";
$stmt = $conn->prepare($SELECT);
$stmt->bind_param("s",$email);
$stmt->execute();
$stmt->bind_result($email);
$stmt->store_result();
$rnum=$stmt->num_rows;
if($rnum==0)
{
$stmt->close();
$stmt = $conn->prepare($INSERT);
$stmt->bind_param("sss",$fname,$lname,$email);
$stmt->execute();
echo "New Record";
}
else
{
 echo " Someone already here";
}
$stmt->close();
$conn->close();
}
?>