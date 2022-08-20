<?php
require_once 'functions.php';

//for signup
    if(isset($_GET['signup'])){
    $response=validateSignupForm($_POST);
    if($response['status']){
         if(createUser($_POST)){
           header('location:../../?login&newuser');
         }else{
            echo"<script>alert('something is wrong')</script>";
         }
    } else{
          $_SESSION['error']=$response;
          $_SESSION['formdata']=$_POST;
          header("location:../../?signup");
    }
}

//for login
if(isset($_GET['login'])){
$response=validateLoginForm($_POST);
// echo"<pre>";
// print_r($response);
  if($response['status']){
    $_SESSION['Auth']=true;
    $_SESSION['userdata'] = $response['user'];
    header("location:../../");

  } else{
        $_SESSION['error']=$response;
        $_SESSION['formdata']=$_POST;
        header("location:../../?login");
  }
  }
  //for logout
  if(isset($_GET['logout'])){
    session_destroy();
    header('location:../../'); 
  }
  if(isset($_GET['updateprofile'])){

   // print_r($_FILES);
    $response=validateUpdateForm($_POST,$_FILES['profile_pic']);
    if($response['status']){
      if(updateProfile($_POST,$_FILES['profile_pic'])){
        header("location:../../?editprofile&success");

    //      echo "profile is update";
      }else{
        echo "something is wrong";
      }
        
    } else{
          $_SESSION['error']=$response;
          header("location:../../?editprofile");
    }
  }
  //delete post
  if(isset($_GET['deletepost'])){
    $post_id = $_GET['deletepost'];
      if(deletePost($post_id)){
          header("location:{$_SERVER['HTTP_REFERER']}");
      }else{
          echo "something went wrong";
      }
  
    
  }
  //add post
  if(isset($_GET['addpost'])){
    $response = validatePostImage($_FILES['post_img']);
 
    if($response['status']){
 if(createPost($_POST,$_FILES['post_img'])){
     header("location:../../?new_post_added");
 }else{
     echo "something went wrong";
 }
    }else{
     $_SESSION['error']=$response;
     header("location:../../");
    }
 }