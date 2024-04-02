<!DOCTYPE html>
<html lang="zxx">


<?php 
include("./security.php");

        
require_once("../vendor/autoload.php");
use Smalot\PdfParser\Parser;

include_once("./header/headfiles/head.php"); ?>


<?php
include("./db/db.php");

if(isset($_POST['publish_book'])){


    $book_name =  mysqli_real_escape_string($conn,trim($_POST['book_name'])) ;
    $author_name =  mysqli_real_escape_string($conn,trim($_POST['author_name']));
    $book_language = mysqli_real_escape_string($conn,trim($_POST['book_language']));
    $book_publish_date = $_POST['book_publish_date'];
    $book_publish_date = date('Y-m-d', strtotime($book_publish_date));



    // echo "<script> alert('$book_publish_date') </script>";
    $book_description = mysqli_real_escape_string($conn,trim($_POST['book_description']));
    $book_cover_image = $_FILES['book_cover_image'];
    $book_pdf = $_FILES['book_pdf'];


    $upload_dir = "../uploads/";

    $image_dir = $upload_dir . "cover/";
    $pdf_dir = $upload_dir . "pdf/";
    
    
    // Get info about the uploaded image file
    $image_name = $_FILES['book_cover_image']['name'];
    $image_size = $_FILES['book_cover_image']['size'];
    $image_tmp = $_FILES['book_cover_image']['tmp_name'];
    $image_type = $_FILES['book_cover_image']['type'];
    $image_ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
    
    // Get info about the uploaded PDF file
    $pdf_name = $_FILES['book_pdf']['name'];
    $pdf_size = $_FILES['book_pdf']['size'];
    $pdf_tmp = $_FILES['book_pdf']['tmp_name'];
    $pdf_type = $_FILES['book_pdf']['type'];
    $pdf_ext = strtolower(pathinfo($pdf_name, PATHINFO_EXTENSION));


        // Load the PDF file
        // require('./libraries/class.pdf2text.php');
        // $a = new PDF2Text();
        // $a->setFilename($pdf_tmp);
        // $a->decodePDF();
        // $output_book =  mysqli_real_escape_string($conn,trim((preg_replace('/\s\s+/', ' ', $a->output()))));




        $parser = new Parser(); // Create a new instance of the parser
        $pdf = $parser->parseFile($pdf_tmp); // Parse the PDF file
        // $output_book = mysqli_real_escape_string($conn,trim((preg_replace('/\s\s+/', ' ',$pdf->getText())))); // Extract the text content from the PDF file
        $output_book = mysqli_real_escape_string($conn,$pdf->getText()); // Extract the text content from the PDF file

        
        // die();
    
    // Generate unique names for the uploaded files to avoid overwriting
    $image_name_new = uniqid('', true) . '.' . $image_ext;
    $pdf_name_new = uniqid('', true) . '.' . $pdf_ext;
    
    $cover_path = $image_dir . $image_name_new;
    // Move the uploaded image file to the cover directory
    move_uploaded_file($image_tmp, $cover_path);
    
    $pdf_path = $pdf_dir . $pdf_name_new;
    // Move the uploaded PDF file to the pdf directory
    move_uploaded_file($pdf_tmp, $pdf_path);



    $query = "INSERT INTO book_details (book_name, book_author_name, book_language, book_publish_date, book_description, book_cover_page_path, book_pdf_path, book_text)
    VALUES ('$book_name', '$author_name', '$book_language', '$book_publish_date', '$book_description', '$cover_path', '$pdf_path', '$output_book');
    ";

    $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
    if($result){
        echo "<script> alert('Book Published Successfully!') </script>";
    }

}

?>


<body class="crm_body_bg">


    <?php include("./sidebar/sidebar.php");  ?>

    <section class="main_content dashboard_part">

        <?php include("./header/nav/nav.php")  ?>


        <div class="main_content_iner ">


            <h2>Upload E-Book</h2>
            <br>

            <div class="container-fluid plr_30 body_white_bg pt_10" style="box-shadow:0px 0px 50px rgba(0,0,0,0.2); border-radius:10px;">
                <div class="row justify-content-center">
                    <div class="col-lg-12">

                        <div class="white_box mb_20">

                            <form method="POST" autocomplete="off" action="./upload-e-book.php" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlInput1">Book Name</label>
                                    <input type="text" class="form-control" name="book_name" placeholder="Book Name" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlInput1">Author Name</label>
                                    <input type="text" class="form-control" name="author_name" placeholder="Author Name" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlInput1">Language</label>
                                    <input type="text" class="form-control" name="book_language" placeholder="Language" required>
                                </div>

                                <div class="mb-3">
                                    <div class="input_wrap common_date_picker form-control mb_20">
                                        <label class="form-label" for="#">Publish Date</label>
                                        <input class="input_form" id="start_datepicker"  name="book_publish_date" placeholder="Pick a Publish Date" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlInput1">Description</label>
                                    <textarea placeholder="Book Description" class="form-control" name="book_description" required></textarea>
                                </div>


                                <div class="input-group mb-3">
                                    <label class="input-group-text" for="inputGroupFile02">Book Cover Page</label>
                                    <input type="file" class="form-control" id="inputGroupFile02" name="book_cover_image" accept="image/*" required>
                                </div>

                                <div class="input-group mb-3">
                                    <label class="input-group-text" for="inputGroupFile03">Book PDF</label>
                                    <input type="file" class="form-control" name="book_pdf" accept="application/pdf" id="inputGroupFile03" required>
                                </div>


                                <input type="submit" name="publish_book" class="btn btn-primary btn-lg" value="Publish">

                            </form>
                        </div>
                    </div>

                </div>
            </div>



            <?php include("./footer/footer.php");  ?>

    </section>

    <?php include("./footer/footer-scripts.php");  ?>

</body>

</html>