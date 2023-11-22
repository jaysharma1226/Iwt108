<?php
   $fname = $_POST['fname'];
   $lname = $_POST['lname'];
   $pno = $_POST['pno'];
   $email = $_POST['email'];
   $password = $_POST['password'];

    // $conn = new mysqli('localhost','root','','register');
    // if($conn->connect_error){
    //     die('Connection Failed  : '.$conn->connect_error);
    // }else{
    //     $stmt = $conn->prepare("insert into register(fname,lname,pno,email,password)values(?,?,?,?,?)");
    //     $stmt -> bind_param("ssiss" , $fname , $lname , $pno , $email , $password);
    //     $stmt->execute();
    //     echo "Registered Successfully !";
    //     $stmt->close();
    //     $conn->close();

    // }
    if(!empty($fname) || !empty($lname) || !empty($pno) || !empty($email) ||!empty($password)){
        $host = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbname = "register";

        $conn = new mysqli($host,$dbUsername,$dbPassword,$dbname);

        if(mysqli_connect_error()){
            die('Connect Error(' . mysqli_connect_error().')' . mysqli_connect_error());
        }else{
            $SELECT = "SELECT email from register where email =? Limit 1";
            $INSERT = "INSERT into register (fname,lname,pno ,password ) values (?,?,?,?)";
            $stmt = $conn->prepare($SELECT);
            $stmt->bind_param("s",$email);
           $stmt->execute();
           $stmt->bind_result($email);
           $stmt->store_result();
           $rnum = $stmt->num_rows;

           if($rnum==0){
            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("ssiss" , $fname , $lname , $pno , $email,$password);
            $stmt->execute();
            echo "reecord added successfully";
           }else{
            echo "email already exists";
           }
           $stmt->close();
           $conn->close();
        }
    }else{
        echo "All field are required !!!!!!";
        die();
    }
   ?>