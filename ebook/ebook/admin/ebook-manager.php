<!DOCTYPE html>
<html lang="zxx">


<?php 

include("./security.php");

include_once("./header/headfiles/head.php");

include("./db/db.php");



?>


<body class="crm_body_bg">


    <?php include("./sidebar/sidebar.php");  ?>

    <section class="main_content dashboard_part">

        <?php include("./header/nav/nav.php")  ?>

        <div class="main_content_iner ">
            <div class="container-fluid plr_30 body_white_bg pt_30">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="QA_section">
                            <div class="white_box_tittle list_header">
                                <h4>E Books List</h4>
                                <div class="box_right d-flex lms_block">
                                    <div class="serach_field_2">
                                        <div class="search_inner">
                                            <form method="POST" action="./ebook-manager.php">
                                                <div class="search_field">
                                                    <input type="text" name="search" placeholder="Search Book here... (Name, Author, Language, Description)">
                                                </div>
                                                <button type="submit" class="btn_1"> <i class="ti-search"></i> </button>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="QA_table ">

                                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
                                    <table class="table lms_table_active dataTable no-footer dtr-inline collapsed" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info" style="width: 701px;">
                                        <thead>
                                            <tr role="row">
                                                <th scope="col" class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 38px;" aria-sort="ascending" aria-label="title: activate to sort column descending">#</th>
                                                <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 71px;" aria-label="Category: activate to sort column ascending">Publish Date</th>
                                                <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 71px;" aria-label="Category: activate to sort column ascending">Uploaded By</th>
                                                <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 71px;" aria-label="Category: activate to sort column ascending">Book Name</th>
                                                <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 63px;" aria-label="Teacher: activate to sort column ascending">Author Name</th>
                                                <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 60px;" aria-label="Lesson: activate to sort column ascending">Language</th>
                                                <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 60px;" aria-label="Lesson: activate to sort column ascending">View-Read-Download</th>
                                                <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 60px;" aria-label="Lesson: activate to sort column ascending">Operations</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php

                                            if (isset($_POST['search'])) {
                                                // Escape the search string to prevent SQL injection attacks
                                                $search = mysqli_real_escape_string($conn, $_POST['search']);

                                                // Prepare a SQL SELECT statement with a LIKE clause to search for the given value in multiple columns
                                                $sql = "SELECT *
                                                        FROM book_details
                                                        WHERE book_name LIKE '%$search%'
                                                            OR book_author_name LIKE '%$search%'
                                                            OR book_publish_date LIKE '%$search%'
                                                            OR book_language LIKE '%$search%'
                                                            OR book_description LIKE '%$search%' ";

                                                // Execute the SQL statement
                                                $result = mysqli_query($conn, $sql);

                                                $count = 0;

                                                // Check if any rows were returned
                                                if (mysqli_num_rows($result) > 0) {
                                                    // Output the rows that were returned
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        $count++;
                                                        echo "<tr role='row' class='odd'>
                                                       <th scope='row' tabindex='0' class='sorting_1'> <a href='#' class='question_content'>" . $count . "</a></th>
                                                       <td>" . $row["book_publish_date"] . "</td>
                                                       <td>" . $row["book_name"] . "</td>
                                                       <td> " . $row["book_author_name"] . "</td>
                                                       <td> " . $row["book_language"] . "</td>
                                                       <td> " . $row["book_view"] ."-".$row['book_read']."-".$row['book_download']."</td>
                                                       <td> <div class='d-grid gap-2 d-md-block'>
                                                       <a href='" . $row["book_pdf_path"] . "' target='_blank'> <button class='btn btn-primary btn-sm' type='button'>View</button> </a> 
                                                       <a href='" . $row["book_pdf_path"] . "' target=''> <button class='btn btn-danger btn-sm' type='button'>Delete</button> </a>
                                                     </div> </td>
                                                   </tr>";
                                                    }
                                                }
                                            } else {
                                                // Prepare a SQL SELECT statement with a LIKE clause to search for the given value in multiple columns
                                                $sql = "SELECT * from book_details as bd LEFT JOIN user_data as ud ON bd.user_id = ud.user_id";

                                                // Execute the SQL statement
                                                $result = mysqli_query($conn, $sql);

                                                $count = 0;

                                                // Check if any rows were returned
                                                if (mysqli_num_rows($result) > 0) {
                                                    // Output the rows that were returned
                                                    while ($row = mysqli_fetch_assoc($result)) {

                                                        // echo "<pre>";
                                                        // print_r($row);

                                                        $count++;

                                                        $uploaded_by = "(Admin)";
                

                                                        if($row['user_id'] != null){
                                                            $uploaded_by = "(User - ".$row['user_email'].")";
                                                        }

                                      

                                                        echo "<tr role='row' class='odd' >
                                                       <th scope='row' tabindex='0' class='sorting_1'  > <a href='#' class='question_content' style='color:black;'>" . $count."</a></th>
                                                       <td>" . $row["book_publish_date"] . "</td>
                                                       <td>".$uploaded_by."</td>
                                                       <td>" . $row["book_name"] . "</td>
                                                       <td> " . $row["book_author_name"] . "</td>
                                                       <td> " . $row["book_language"] . "</td>
                                                       <td> " . $row["book_view"] ."-".$row['book_read']."-".$row['book_download']."</td>
                                                       <td> <div class='d-grid gap-2 d-md-block'>
                                                       <a href='" . $row["book_pdf_path"] . "' target='_blank'> <button class='btn btn-primary btn-sm' type='button'>View</button> </a> 
                                                       <a href='./task-manager.php?task=delete_ebook&ebook_id=" . $row["b_id"] . "' target=''> <button class='btn btn-danger btn-sm' type='button'>Delete</button> </a>
                                                     </div> </td>
                                                   </tr>";
                                                    }
                                                }
                                            }


                                            ?>


                                        </tbody>
                                    </table>
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