<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>BookTopia</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Use Minified Plugins Version For Fast Page Load -->
    <link rel="stylesheet" type="text/css" media="screen" href="css/plugins.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/main.css">
    <link rel="shortcut icon" type="image/x-icon" href="image/favicon.ico">
</head>

<body data-new-gr-c-s-check-loaded="14.1098.0" data-gr-ext-installed="">


    <?php

    include("./header/header.php");
    include("../admin/db/db.php");


    ?>

    <style>
       .demo-bg{
            opacity: 0.2;
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 5500px;
            pointer-events: none;

            background-image: url("./image/bg.jpg");
             background-repeat: repeat;
        }
    </style>

    <main class="inner-page-sec-padding-bottom">
        <div src="./image/bg.jpg" class="demo-bg" alt=""></div>
        <div class="container">
            <section>
                <div class="container">
                    <div class="row justify-content">

                        <?php

                        $sql = "";


                        if (isset($_GET['search'])) {

                            // Escape the search string to prevent SQL injection attacks
                            $search = mysqli_real_escape_string($conn, $_GET['search']);


                            if (isset($_REQUEST['smart_search'])) {


                                $sql = "SELECT *
                                FROM book_details
                                WHERE book_text LIKE '%$search%'";
                            } else {


                                // Prepare a SQL SELECT statement with a LIKE clause to search for the given value in multiple columns
                                $sql = "SELECT *
            FROM book_details
            WHERE book_name LIKE '%$search%'
                OR book_author_name LIKE '%$search%'
                OR book_publish_date LIKE '%$search%'
                OR book_language LIKE '%$search%'
                OR book_description LIKE '%$search%'";
                            }


                            // Execute the SQL statement
                            $result = mysqli_query($conn, $sql);
                        } else {
                            $sql = "SELECT * from book_details";
                        }





                        // Execute the SQL statement
                        $result = mysqli_query($conn, $sql);

                        $count = mysqli_num_rows($result);

                        ?>

                        <div class="feature-box h-100" style="border-radius:10px;">
                            <div class="icon">
                                <i class="fas fa-book"></i>
                            </div>
                            <div class="text">
                                <h4> <strong><?php echo $count; ?> </strong> E-BOOKS FOUND!</h4>
                            </div>
                        </div>


                        <hr>

                        <?php

                        // Check if any rows were returned
                        if (mysqli_num_rows($result) > 0) {
                            // Output the rows that were returned
                            while ($row = mysqli_fetch_assoc($result)) {
                                $count++;
                        ?>



                                <div class="col-md-8 col-lg-6 col-xl-3" style="margin-top:10px !important;">
                                    <div class="card text-black" style="border-radius:10px; box-shadow:0px 0px 4px #62ab00">
                                        <i class="fa fa-book fa-lg pt-3 pb-1 px-3">
                                            <h5 class="d-inline"><?php echo $row["book_publish_date"]; ?></h5>
                                        </i>
                                        <img src="<?php echo $row["book_cover_page_path"]; ?>" class="card-img-top" height="200" width="200" />
                                        <div class="card-body">
                                            <div class="text-center">
                                                <h5 class="card-title"><?php echo $row["book_name"]; ?></h5>
                                                <p class="text-muted mb-4">Author: <?php echo $row["book_author_name"]; ?></p>
                                            </div>
                                            <div>
                                                <div class="d-flex justify-content-between">
                                                    <span>Views</span><span><?php echo $row["book_view"]; ?></span>
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <span>Reads</span><span><?php echo $row["book_read"]; ?></span>
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <span>Downloads</span><span><?php echo $row["book_download"]; ?></span>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-center total font-weight-bold mt-4">
                                                <a href="./product-details.php?product_id=<?php echo $row["b_id"]; ?>" class="btn btn-outlined--primary">Explore Now!</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                        <?php

                            }
                        }

                        ?>




                    </div>
                </div>

            </section>
        </div>
    </main>




    <br>
    <br>


    <?php
    include("./footer/footer.php");
    include("./footer/scripts.php");

    ?>




</body>

</html>