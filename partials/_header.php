<?php
session_start();

echo 
'<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
<div class="container-fluid">
  <a class="navbar-brand" href="/">Dev-Discuss</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/about.php">About</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Categories
        </a>
        <ul class="dropdown-menu">';
        $sql= "SELECT cat_name ,cat_id FROM `categories`";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){

         echo '<a class="dropdown-item" href="threadlist.php?catid='.$row['cat_id'].'">'.$row['cat_name'].'</a>';
        }
        
        echo '</ul>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/contact.php">contact</a>
      </li>
    </ul>';
    if(isset($_SESSION['loggedin'])&& $_SESSION['loggedin'] == true){
  echo '<form class="d-flex" role="search" method="get" action="search.php">
  <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
  <button class="btn btn-success " type="submit">Search</button>
<style>.brand {
  padding-top: var(--bs-navbar-brand-padding-y);
  padding-bottom: var(--bs-navbar-brand-padding-y);
  margin-inline: var(--bs-navbar-brand-margin-end);
  /* font-size: var(--bs-navbar-brand-font-size); */
  color: var(--bs-navbar-brand-color);
  text-decoration: none;
  white-space: nowrap;
}</style>
  <a class="brand"   href="#">Welcome '.$_SESSION['user_name'].'</a>

  <a href="partials/logout.php"  class="btn btn-outline-success" >Logout</a>
  </form>';

    }

    else {
      echo'<form class="d-flex" role="search">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-success" type="submit">Search</button>
      </form>
      <div class="mx-2">
      <button class="btn btn-outline-success mx-2" data-bs-toggle="modal" data-bs-target="#login-modal">Login</button>
      <button class="btn btn-outline-success ml-2" data-bs-toggle="modal" data-bs-target="#signup-modal">Signup</button>';
    }
      echo '</div>
      </div>
      </div>
      </nav>';


include 'partials/login-modal.php';
include 'partials/signup-modal.php';
if (isset($_GET['signupsuccess'])&& $_GET ['signupsuccess']== "true"){
  echo '<div class="alert my-0 alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> You can now login<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
}
if(isset($_GET['signupsuccess'])&& $_GET ['signupsuccess']== "false"){
  echo '<div class="alert my-0 alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Passwords do not match <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
}
if(isset($_GET['loggedin'])&& $_GET ['loggedin']== "true"){
  echo '<div class="alert my-0 alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> You\'ve logged in successfully <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';}
if(isset($_GET['loggedin'])&& $_GET ['loggedin']== "false"){
  echo '<div class="alert my-0 alert-danger alert-dismissible fade show" role="alert">
               <strong>Error!</strong> Invalid Credentials<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
             </div>';
}


?>
