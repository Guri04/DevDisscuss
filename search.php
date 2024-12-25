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

    <!-- Search Results -->
   <div class="container my-3">
       <h1 class="py-3">Search Results for "<?php echo $_GET['search']?>" </h1>
  <?php
   $noResult=true;
//   $query= $_GET["search"];
 $query = mysqli_real_escape_string($conn, $_GET["search"]);
 $sql = "SELECT * FROM `threads` where match (thread_title, thread_desc) against ('$query')";
 $result = mysqli_query($conn,$sql);
  $result2 = mysqli_real_escape_string($conn, $sql);
 while($row = mysqli_fetch_assoc($result)){
    $title = $row['thread_title'];
        $desc = $row['thread_desc'];
        $thread_id = $row['thread_id'];
        $url="thread.php?threadid=".$thread_id;
        $noResult=false;
        $query2 = str_replace("<","&lt;",$query);
        $query2 = str_replace(">","&gt;",$query);
        $query2 = htmlspecialchars($query, ENT_QUOTES, 'UTF-8');
        echo '<div class="result">
        <h3><a href="'.$url.'"class="text-dark">'.$title.'</a></h3>
        <p>'.htmlspecialchars($desc, ENT_QUOTES, 'UTF-8').'</p>
    </div>';
  
 }
 if($noResult){
    echo '<div class="alert alert-success" role="alert">
  <div class="container">
    <h1 class="display-4">No Results Found!</h1>
    <p class="lead">Suggestions: <ul>
            <li>Make sure that all words are spelled correctly.</li>
            <li>Try different keywords.</li>
            <li>Try more general keywords.</li></ul>
            </p> 
            </div>
</div>';
}
 

?>
    </div>

    <?php include 'partials/_footer.php'; ?>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
    
</body>

</html>