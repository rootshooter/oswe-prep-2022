
<?php
// Code to check if user came from localhost or not
include("isAdmin.php");
include("header.php");
?> <!-- contains the header.php + isAdmin.php code (cleaner code) -->

        <!-- Page content-->
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Post content-->
                    <article>
                        <!-- Post header-->
                        <header class="mb-4">
                            <!-- Post title-->
                            <h1 class="fw-bolder mb-1">Welcome to SecAura's Blog! (OSWE PREP)</h1>
                            <!-- Post meta content-->
                            <div class="text-muted fst-italic mb-2">Like and Subscribe!</div>
                            <!-- Post categories-->
                            <a class="badge bg-secondary text-decoration-none link-light" href="#!">Web Design</a>
                            <a class="badge bg-secondary text-decoration-none link-light" href="#!">Freebies</a>
                            <a class="badge bg-secondary text-decoration-none link-light" href="upload.php">upload(WIP)</a>
                        </header>
                        <!-- Preview image figure-->
                        <figure class="mb-4"><img class="img-fluid rounded" src="banner.PNG" alt="..." /></figure>
                    </article>
                    <h1>Comments Review Panel</h1>
                    <?php 
               

                // ---------------------------------------------------------------------------------
                // DB code
                include 'db.php';
                $conn = OpenCon();
                // ---------------------------------------------------------------------------------
                // Extract all coments, print them to the page
                if( $res = $conn->query("SELECT * FROM comments") ) {
                    while( $row = $res->fetch_assoc() ) {
                        echo '
                        <br>
                        
                        <div class="d-flex mb-4">   
                        
                            <div class="d-flex">
                            <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                            <div class="ms-3">
                                <div class="fw-bold">' . $row["name"] .' </div>
                                '. $row["usercomment"] .'
                            </div>';
                            if ($row['shown'] == 0){
                                echo '
                                <div class="ms-4">
                                <form method="get" action="">
                                    <button class="form-control btn-success" type="submit" name="approveID" value='.$row['id']. ' >Approve Comment</button>
                                </form>
                                </div> '; 
                            }else{
                                echo '
                            <div class="ms-4">
                            <form method="get" action="">
                                <button class="form-control btn-warning" type="submit" name="disableID" value='.$row['id']. ' >Disable Comment</button>
                            </form>
                            </div>';
                            }
                            echo '
                            <div class="ms-4">
                            <form method="get" action="">
                                <button class="form-control btn-danger" type="submit" name="deleteID" value='.$row['id']. ' >Delete Comment</button>
                            </form>
                            </div> 
                        </div>
                        </div> ';
                            
                    }
                }
                // ---------------------------------------------------------------------------------
                // code to handle the approving, disabling and deleting of comments
                if (isset($_REQUEST['approveID'])){
                    $conn->query("UPDATE comments set shown = 1 where id =" . $_REQUEST['approveID']);
                }
                
                if (isset($_REQUEST['disableID'])){
                    $conn->query("UPDATE comments set shown = 0 where id =" . $_REQUEST['disableID']);
                }

                if (isset($_REQUEST['deleteID'])){
                    $conn->query("Delete FROM comments where id =" . $_REQUEST['deleteID']);
                }


                // closes DB connection
                CloseCon($conn);

                

                ?>


                </div>



<?php include("footer.php");?><!-- contains the footer.php code (cleaner code) -->