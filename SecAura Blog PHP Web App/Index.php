<?php include("header.php");?> <!-- contains the header.php code (cleaner code) -->

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
                        </header>
                        <!-- Preview image figure-->
                        <figure class="mb-4"><img class="img-fluid rounded" src="banner.PNG" alt="..." /></figure>
                    </article>
                    <!-- Comments section-->
                    <section class="mb-5">
                        <div class="card bg-light">
                            <div class="card-body">



                                <!-- Comment form-->
                                <form class="mb-4" method="POST">
                                <div class="input-group mb-3">
                                    <input name="comment" type="text" class="form-control" placeholder="My comment" aria-label="My comment" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <input name="name" type="text" class="form-control" placeholder="Name" aria-label="Name" aria-describedby="basic-addon2">
                                        <button class="form-control btn-outline-primary" type="submit">Submit Comment</button>
                                    </div>
                                    </div>
                                </form>
                                
                                <?php 
                                // ---------------------------------------------------------------------------------
                                // DB code
                                include 'db.php';
                                $conn = OpenCon();

                                if (isset( $_REQUEST['name']) && isset( $_REQUEST['comment'])){
                                    $conn->query("INSERT INTO comments (name, usercomment) values ('" . $_REQUEST['name'] . "','" . $_REQUEST['comment']. "' )");
                                    echo '
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                Added comment :)
                                
                                </div>';
                                }

                                // ---------------------------------------------------------------------------------
                                //include sample comments
                                include("comments.html");

                                if( $res = $conn->query("SELECT * FROM comments where shown = True") ) {
                                    while( $row = $res->fetch_assoc() ) {
                                        echo '
                                        <br>
                                        <div class="d-flex mb-4">   
                                            <div class="d-flex">
                                            <div class="flex-shrink-0"><img class="rounded-circle" src="head.PNG" alt="..." /></div>
                                            <div class="ms-3">
                                                <div class="fw-bold">' . $row["name"] .' </div>
                                                '. $row["usercomment"] .'
                                            </div>
                                        </div>
                                        ';
                                    }
                                }
                                // ---------------------------------------------------------------------------------


                                CloseCon($conn);

                                ?>

            






                                
                            </div>
                        </div>
                    </section>
                </div>



<?php include("footer.php");?><!-- contains the footer.php code (cleaner code) -->