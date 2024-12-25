<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dev-Discuss - Fourms</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
      <style>
        .card-img-top {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .card-body {
            display: flex;
            flex-direction: column;
        }
        .card-body .btn {
            margin-top: auto;
        }
        .card {
            height: 100%;
        }
          @media (min-width: 1200px) {
            .col-xl-custom {
                flex: 0 0 20%;
                max-width: 20%;
            }
    </style>  
</head>

<body>
    <!-- files included -->
    <?php include 'partials/dbconnect.php'; ?>
    <?php include 'partials/_header.php'; ?>


    <!-- Slider -->
    <div id="carouselExampleIndicators" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner" style="object-fit: cover;  overflow: hidden;">
            <div class="carousel-item active">
                <img src="/img/Slide_1.jpg" class="d-block w-100" height="400vh" alt="..." style="object-fit: cover;  overflow: hidden;">
            </div>
            <div class="carousel-item">
                <img src="/img/Slide_2.jpg" class="d-block w-100" height="400vh" alt="..." style="object-fit: cover;  overflow: hidden;">
            </div>
            <div class="carousel-item">
                <img src="/img/Slide_3.jpg" class="d-block w-100" height="400vh" alt="..." style="object-fit: cover;  overflow: hidden;">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!-- categories con -->
    <div class="con my-5">
        <h2 class="text-center">
            Welcome to Dev-Discuss categories
        </h2>
        <div class="row gx-5 gy-5 mx-3 my-3">
            <!-- fetch all categories -->
            <?php
            $sql = "SELECT * FROM `categories`";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['cat_id'];
                $cat = $row['cat_name'];
                $desc = $row['cat_description'];
                 $image = ($cat == 'C#') ? 'CSharp' : $cat;
                echo '<div class="col-xl-custom col-lg-3 col-md-6">
                        <div class="card bg-dark">
                            <img src="/img/' . $image . '.jpg" class="card-img-top" alt="' . $cat . '">
                            <div class="card-body">
                                <h5 class="card-title text-light"><a href="/threadlist.php?catid=' . $id . '" class="text-decoration-none text-light">' . $cat . '</a></h5>
                                <p class="card-text text-light">' . substr($desc, 0, 50) . '...</p>
                                <a href="/threadlist.php?catid=' . $id . '" class="btn btn-primary">Let\'s Discuss</a>
                            </div>
                        </div>
                    </div>';
            }
            ?>
        </div>
    </div>
    <?php include 'partials/_footer.php'; ?>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
</body>

</html>