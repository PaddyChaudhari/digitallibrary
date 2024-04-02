<?php 


include("./security.php");

include("./db/db.php");

if(isset($_REQUEST['task'])){
    $task = $_REQUEST['task'];

    if($task == "delete_ebook" && isset($_REQUEST['ebook_id'])){
        $ebook_id = $_REQUEST['ebook_id'];

        $query = "SELECT book_pdf_path, book_cover_page_path FROM book_details where b_id = $ebook_id";
        $result = mysqli_query($conn,$query);

        if(mysqli_num_rows($result) > 0){

            $file_path = mysqli_fetch_assoc($result);

            if (file_exists($file_path['book_pdf_path']) || file_exists($file_path['book_cover_page_path'])) {
                unlink($file_path['book_pdf_path']);
                unlink($file_path['book_cover_page_path']);
            }

            $query = "DELETE FROM book_details where b_id = $ebook_id";
            mysqli_query($conn,$query);
        }

       

        $previous_page = $_SERVER['HTTP_REFERER'];

        // Redirect to the previous page
        header("Location: $previous_page");
        exit;

    }

}else{
    echo "ACCESS FORBIDDEN!";
}


?>