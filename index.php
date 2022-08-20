<?php
require_once 'assets/php/functions.php';
if(isset($_SESSION['Auth'])){
$user = getUser($_SESSION['userdata']['id']);
$posts=filterPosts();
$follow_suggestions = filterFollowSuggestion();
}
//manage pages
$pagecount= count($_GET);






if(isset($_SESSION['Auth']) && !$pagecount){                                       //&& $_SESSION['userdata']
//echo "user is logged in";
// $userdata = $_SESSION['userdata'];
// echo "<pre>";
showpage('header',['page_title'=>'Home']);
showpage('navbar');
showpage('wall');
//print_r($userdata);
}elseif(isset($_SESSION['Auth'])&& isset($_GET['editprofile']) ){
    showpage('header',['page_title'=>'Edit Profile']);
    showpage('navbar');
    showpage('edit_profile'); 
}
elseif(isset($_SESSION['Auth'])&& isset($_GET['u']) ){
    $profile=getUserByUsername($_GET['u']);
    if(!$profile){
        showPage('header',['page_title'=>'User Not Found']);
        showPage('navbar');
        showPage('user_not_found');

    }else{
     $profile_post = getPostById($profile['id']);  
     $profile['followers']=getFollowers($profile['id']);
     $profile['following']=getFollowing($profile['id']);
        showPage('header',['page_title'=>$profile['first_name'].' '.$profile['last_name']]);
        showPage('navbar');
        showPage('profile');
    }
}
    elseif(isset($_GET['signup'])){
    showpage('header',['page_title'=>'Pictogram-Signup']);
showpage('signup');
}elseif (isset($_GET['login'])) {
showpage('header',['page_title'=>'Pictogram-Login']);
showpage('login');
}else{
    if(isset($_SESSION['Auth'])){
        showpage('header',['page_title'=>'Home']);
        showpage('navbar');
        showpage('wall');   
    }else{
        showpage('header',['page_title'=>'Pictogram-Login']);
        showpage('login'); 
    }
   
}
showpage('footer');
unset ($_SESSION['error']);
unset($_SESSION['formdata']);