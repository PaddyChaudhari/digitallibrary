<!DOCTYPE html>
<html lang="zxx">


<?php 
include("./security.php");


include_once("./header/headfiles/head.php");


include("./db/db.php");

$query = "SELECT COUNT(b_id) as total_row ,SUM(book_read) as total_book_read, SUM(book_view) as total_book_view, SUM(book_download) as total_book_download FROM book_details";

$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

$res = mysqli_fetch_assoc($result);

$total_books_count = 0;

if ($result) {
    // it return number of rows in the table.
    $row = mysqli_num_rows($result);

    if ($row) {
        $total_books_count = $row;
    }
    // close the result.
    mysqli_free_result($result);
}



?>


<body class="crm_body_bg">


    <?php include("./sidebar/sidebar.php");  ?>

    <section class="main_content dashboard_part">

        <?php include("./header/nav/nav.php")  ?>

        <div class="main_content_iner ">
            <div class="container-fluid plr_30 body_white_bg pt_30">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="single_element">
                            <div class="quick_activity">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="quick_activity_wrap">
                                            <div class="single_quick_activity">
                                                <h4>Total Ebooks</h4>
                                                <h3><span class="counter"> <?php echo $res['total_row']; ?></span> </h3>
                                                <!-- <p>Saved 25%</p> -->
                                            </div>
                                            <div class="single_quick_activity">
                                                <h4>Total Views</h4>
                                                <h3><span class="counter"><?php echo $res['total_book_view']; ?></span> </h3>
                                                <!-- <p>Saved 25%</p> -->
                                            </div>
                                            <div class="single_quick_activity">
                                                <h4>Total Reads</h4>
                                                <h3><span class="counter"><?php echo $res['total_book_read']; ?></span> </h3>
                                                <!-- <p>Saved 25%</p> -->
                                            </div>
                                            <div class="single_quick_activity">
                                                <h4>Total Downloads</h4>
                                                <h3><span class="counter"><?php echo $res['total_book_download']; ?></span> </h3>
                                                <!-- <p>Saved 65%</p> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>

        <?php include("./footer/footer.php");  ?>

    </section>

    <?php include("./footer/footer-scripts.php");  ?>

</body>

</html>