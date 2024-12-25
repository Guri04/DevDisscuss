<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dev-Discuss - Fourms</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <!-- files included -->
    <?php include 'partials/dbconnect.php'; ?>
    <?php include 'partials/_header.php'; ?>
    <?php
     $id = $_GET['threadid'];
     $sql = "SELECT * FROM `threads` WHERE thread_id=$id";
     $result = mysqli_query($conn,$sql);
     while($row = mysqli_fetch_assoc($result)){
        $title = $row['thread_title'];
        $desc = $row['thread_desc'];
        $thread_user_id = $row['thread_user_id'];
        //query the users table to find out the name of OP (user who posted)
        $sql2 = "SELECT user_name FROM `users` WHERE user_id='$thread_user_id'";
        $result2 = mysqli_query($conn,$sql2);
        $row2 = mysqli_fetch_assoc($result2);
        $posted_by = $row2['user_name'];


    }
   ?>
    <?php
    $showAlert= false;
    $method= $_SERVER['REQUEST_METHOD'];
    
    IF($method=='POST'){
      // Insert thread into database 
        $comment = $_POST['comment'];
        $comment = str_replace("<","&lt;",$comment);
        $comment = str_replace(">","&gt;",$comment);
        $userID = $_POST['userID'];
        $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ( '$comment', '$id', '$userID', current_timestamp());";
        $result = mysqli_query($conn,$sql);
        $showAlert= true;
        if($showAlert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Holy guacamole!</strong> Your thread has been added!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
    }
   
   
   
   ?>
    <div class="container my-4">
        <div class="alert alert-success" role="alert"">
            <h1 class="display-4"><?php echo $title; ?></h1>
            <p class="lead">
                <?php echo $desc; ?>
            </p>
            <hr class="my-4">
            <p>this is peer to peer forum for Be civil. Don/'t post anything that a reasonable person would consider
                offensive, abusive, or hate speech.Keep it clean. Don't post anything obscene or sexually
                explicit.Respect each other. Don/'t harass or grief anyone, impersonate people, or expose their private
                information.Respect our forum.</p>
            <p>Posted By:
             <em> 
            <?php echo $posted_by;?></p>
            </em>
        </div>
    </div>
    
    <?php
    if(isset($_SESSION['loggedin'])&& $_SESSION['loggedin'] == true){
    echo'<div class="container">
        <h1 class="py-2">Post a Comment</h1>
        <!-- add /fourms/threadlist.php?catid=1 if needed -->
        <form action="'.$_SERVER['REQUEST_URI'].'" method="post">
            <div class="mb-3">
                <label for="exampleFormControlTextarea1"  class="form-label">Type your comment</label>
                <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                <input type="hidden" name="userID" value = "'.$_SESSION['userID'].'">
            </div>
            <button type="submit" class="btn btn-success">Post Comment</button>
        </form>
    </div>';
}
else {
    echo'<h1 class="py-2 d-flex justify-content-center">Post a Comment</h1>
    <div class="alert alert-warning d-flex justify-content-center" role="alert">
    Please login to post a comment!
    </div>';
}
    ?>
    <div class="container mb-5">
        <h1 class="py-2">Discussions</h1>

    <?php
    $id = $_GET['threadid'];
     $sql = "SELECT * FROM `comments` WHERE thread_id=$id";
     $result = mysqli_query($conn,$sql);
     $noResult=true;
     while($row = mysqli_fetch_assoc($result)){
        $noResult=false;
        $id = $row['comment_id'];
        $content = $row['comment_content'];
        $time = $row['comment_time'];
        $th_user_id = $row['comment_by'];

        $sql2 = "SELECT user_name FROM `users` WHERE user_id='$th_user_id'";
        $result2 = mysqli_query($conn,$sql2);
        $row2 = mysqli_fetch_assoc($result2);

        echo '<div class="d-flex my-4">
       <div class="flex-shrink-0">
            <img src="img/ub.png" width="54px" alt="">
        </div>
        <div class="flex-grow-1 ms-1">
        <p class="fw-bold">'.$row2['user_name'].' at '.$time.'</p>
            '.$content.'
        </div>
        </div>';
}
if($noResult){
    echo '<div class="alert alert-success" role="alert">
  <div class="container">
    <h1 class="display-4">No Discussion Found!</h1>
    <p class="lead">Be the first person to ask a question</p>
  </div>
</div>';
}
?>

    </div>



    <?php include 'partials/_footer.php'; ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

</html>