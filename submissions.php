<?php
require_once('app/bootstrap.php');


if(isset($_POST["login"]) && !empty($_POST["phone"]) && !empty($_POST["password"])){
    $phone   = $_POST["phone"];
    $password   = $_POST["password"];
        loginUser($phone,$password);  
}

function loginUser($phone,$password){
    global $db;
    $password = hash("sha256",$password);
    if($user = $db->GetRow("SELECT * FROM users WHERE users.phone = ? AND users.password = ? ",["$phone","$password"])){
        $_SESSION['type'] = $user['role'];
        $_SESSION['userPhone'] = $user['phone'];
        $_SESSION['username'] = $user['names'];
        $_SESSION['userId'] = $user['id'];
        $_SESSION['userType'] = $user['role'];
        $_SESSION['user_password'] = "true";
        redirect($phone,"true",$user['role']);

    }else{
        echo "<script>alert('Invalid Phone or Password.'); document.location = 'auth/login.php';</script>";
    }

}

if(isset($_POST['register'])){
    $names = $_POST['names'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    if ($db->Check("SELECT * FROM users WHERE phone like  ?",["$phone"])){
        echo "<script>alert('Musanzwe mufite konti muri sisitemu');document.location='auth/register.php'</script>";
       }
       else{

       
    if($db->InsertData("INSERT INTO `users` ( `names`,`phone`,`password`, `createdAt`, `updatedAt`) VALUES (?,?, ?,current_timestamp(), current_timestamp())",["$names","$phone",hash("sha256","$password")])){
        echo "<script>alert('Konti yafunguwe neza!');document.location='auth/login.php'</script>";
         }else{
             echo "failed to save";
         }
        }
}


if(isset($_POST['save'])){
    $question_number = $_POST['question_number'];
    $question_text = $_POST['question_text'];
    $correct_choice = $_POST['correct_choice'];
   
 //choice array
    $choice = array();
    $choice[1] = $_POST['choice1'];
	$choice[2] = $_POST['choice2'];
	$choice[3] = $_POST['choice3'];
	$choice[4] = $_POST['choice4'];
    if ($db->Check("SELECT * FROM questions WHERE question_number like  ?",["$question_number"])){
        echo "<script>alert('question already exists');document.location='auth/register.php'</script>";
       }
       else{

       
    $result = $db->InsertData("INSERT INTO `questions` ( `question_number`,`question_text`) VALUES (?,?)",["$question_number","$question_text"]);
    if($result){
        foreach($choice as $option=> $value){
            if($value !=""){
                if($correct_choice == $option){
                    $is_correct = 1;
                }
                else{
                    $is_correct = 0;
                }
                // querying questions table
                 $insert = $db->InsertData("INSERT INTO `options` (question_number,is_correct,coption) VALUES (?,?,?)",["$question_number","$is_correct","$value"]);

                 if($insert){
                    continue;
                    echo "cool";

                 }
                 else{
                    echo "failed";
                 }

            }
        }
    }
    $message = "success";
  }

 
}

if(!isset($_SESSION['score'])){
    $_SESSION['score'] = 0;
    $_SESSION['count'] = 0;
}

if($_POST){  
    $_SESSION['count']++;
    $total_questions = $db->Getsum("SELECT COUNT(question_number) FROM questions");
    $number = $_POST['number'];
    $selected_choice = $_POST['choice'];
    $next =rand(1,$total_questions);
    $row= $db->GetRow("SELECT * FROM options WHERE question_number = $number AND is_correct = 1");
    $correct_choice = $row['id'];
   

    if($selected_choice == $correct_choice){
        $_SESSION['score']++;
    }
    // echo $_SESSION['count'];

    // exit();

    if($_SESSION['count'] >= 20){
        header("LOCATION: /gutwara.com/student/result.php");
    }else{
       
        header("LOCATION: /gutwara.com/student/quiz.php?n=". $next);

    }




}




