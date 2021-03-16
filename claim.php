<?php
$room=$_POST['room'];

if(strlen($room)>20 or strlen($room)<2){
    $message="Please enter code between 2 to 20";
    
    echo '<script language="javascript">';
    echo 'alert("'.$message.'");';
    echo 'window.location="http://localhost/chatroom";';  
    echo '</script>';

}
else if(!ctype_alnum($room)){
    $message="Please enter alphanumeric room code";
    
    echo '<script language="javascript">';
    echo 'alert("'.$message.'");';
    echo 'window.location="http://localhost/chatroom";';  
    echo '</script>';

}
else{
    include('db_connect.php');
    

}


$sql="SELECT * FROM `rooms` WHERE roomname= '$room'";
$result=mysqli_query($conn,$sql);
if($result){

    if(mysqli_num_rows($result) > 0){

        $message="Please enter different  room code.This room is already claimed";
        echo '<script language="javascript">';
        echo 'alert("'.$message.'");';
        echo 'window.location="http://localhost/chatroom";';  
        echo '</script>';  
    }
    else{
        $sql="INSERT INTO `rooms` ( `roomname`, `stime`) VALUES ( '$room', current_timestamp());";
        if(mysqli_query($conn,$sql)){
            $message="Your Room is ready.You can chat Now!";
            echo '<script language="javascript">';
            echo 'alert("'.$message.'");';
            echo 'window.location="http://localhost/chatroom/rooms.php?roomname='.$room.'";';  
            echo '</script>';

        }
    }

}






?>