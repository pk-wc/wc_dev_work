<?php


  $dbIP = "localhost";
  $username = "wecarysa";
  $password = "?4UeY0H9%0%b";
  $dbName = "wecarysa_wecarriers";
  $con = mysqli_connect($dbIP,$username,$password,$dbName);


$q = $_GET['q'];
if(isset($q) || !empty($q)) {

    $str = "select * from pincodes where pincode like '$q%'";
    $result = mysqli_query($con,$str);
    $res = array();
    while($resultSet = mysqli_fetch_assoc($result)) {
     $res[$resultSet['id']]['id'] =  $resultSet['region']."-".$resultSet['city']."-".$resultSet['state'];
     $res[$resultSet['id']]['value'] =  $resultSet['pincode'];
    $res[$resultSet['id']]['label'] =  $resultSet['region'].",".$resultSet['city'].",".$resultSet['state'].",".$resultSet['pincode'];
    }
    if(!$res) {
        $res[0] = 'Not found!';
    }
    echo json_encode($res);
}
mysqli_close($con);
 
?>