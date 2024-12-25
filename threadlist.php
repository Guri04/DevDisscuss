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
     $id = $_GET['catid'];
     $sql = "SELECT * FROM `categories` WHERE cat_id=$id";
     $result = mysqli_query($conn,$sql);
     while($row = mysqli_fetch_assoc($result)){
        $catname = $row['cat_name'];
        $catdesc = $row['cat_description'];
        
    }
   ?>
    <?php
    $showAlert= false;
    $method= $_SERVER['REQUEST_METHOD'];
    
    IF($method=='POST'){
      // Insert thread into database 
        $th_title = $_POST['title'];
        $th_desc = $_POST['desc'];
        $th_title = mysqli_real_escape_string($conn, $th_title);
        $th_desc = mysqli_real_escape_string($conn, $th_desc);
        $th_title = str_replace("<","&lt;",$th_title);
        $th_title = str_replace(">","&gt;",$th_title);
        $th_desc = str_replace("<","&lt;",$th_desc);
        $th_desc = str_replace(">","&gt;",$th_desc);
        $userID = $_POST['userID'];
        $userID = mysqli_real_escape_string($conn, $userID);
        $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ( '$th_title', '$th_desc', '$id', '$userID', current_timestamp())";
        $result = mysqli_query($conn,$sql);
        $showAlert= true;
        if($showAlert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Holy guacamole!</strong> Your thread has been added! please wait for community to respond
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
    }
   
   
   
   ?>
    <!-- Categories info -->
    <div class="container my-4">
        <div class="alert alert-success" role="alert">
            <h1 class="display-4">Welcome to <?php echo $catname; ?> forums</h1>
            <p class="lead">
                <?php echo $catdesc; ?>
            </p>
            <hr class="my-4">
            <p>this is peer to peer forum for Be civil. Don/'t post anything that a reasonable person would consider
                offensive, abusive, or hate speech.Keep it clean. Don't post anything obscene or sexually
                explicit.Respect each other. Don/'t harass or grief anyone, impersonate people, or expose their private
                information.Respect our forum.</p>
            <!--<a class="btn btn-success btn-lg" href="" role="button"> Learn More</a>-->
        </div>
    </div>
    <?php
    if(isset($_SESSION['loggedin'])&& $_SESSION['loggedin'] == true){
    // <!-- Discussion FORM -->
    echo '<div class="container">
            <h1 class="py-2">Start a Discussion</h1>
            <!-- add /fourms/threadlist.php?catid=1 if needed -->
            <form action=" '.$_SERVER['REQUEST_URI'].'" method="post">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Thread Title</label>
            <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
            <input type="hidden" name="userID" value = "'.$_SESSION['userID'].'">

            <div id="emailHelp" class="form-text">Keep your title as short and crisp as possible</div>
        </div>

        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Ellaborate your Concern</label>
            <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
        </div>';}
    else{
echo '<h1 class="py-2 d-flex justify-content-center">Start a Discussion</h1>
<div class="alert alert-warning d-flex justify-content-center" role="alert">
Please login to start a discussion!
</div>';
    }
    ?>
    <div class="container mb-5" id="ques">
        <h1 class="py-2">Browse Questions</h1>
        <!-- php to get thread from database -->
        <?php
        $id = $_GET['catid'];
    
     $sql = "SELECT * FROM `threads` WHERE thread_cat_id=$id";
     $result = mysqli_query($conn,$sql);
     $noResult=true;
     while($row = mysqli_fetch_assoc($result)){
        $noResult = false;
        $id = $row['thread_id'];
        $title = $row['thread_title'];
        $desc = $row['thread_desc'];
        $thread_time = $row['timestamp'];
        $th_user_id = $row['thread_user_id'];
        $sql = "SELECT * FROM `users` WHERE thread_cat_id=$id";
        $sql2 = "SELECT user_name FROM `users` WHERE user_id='$th_user_id'";
        $result2 = mysqli_query($conn,$sql2);
        $row2 = mysqli_fetch_assoc($result2);
        
 



        echo '<div class="d-flex my-4">
       <div class="flex-shrink-0">
            <img src="img/ub.png" width="54px" alt="">
        </div>
        <div class="flex-grow-1 ms-1">
       <p class="font-weight-bold my-0">'. $row2['user_name'] .' at '.$thread_time.'</p>
            <h5> <a class="text-dark" href="thread.php?threadid='.$id.'">'.$title.'</a></h5>
            '.$desc.'
        </div>
        </div>';
}
// echo var_dump($noResult);
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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
    
</body>

</html>