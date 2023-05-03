<?php include('inc/admin-header.php') ?>


<div id="wrapper">

    <?php include('inc/admin-navbar.php') ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Post Page
                      
                        <a href="post.php?source=add-post">
                            <button class="btn btn-success">Add New Post</button>
                        </a>
                    </h1>
                    <?php //include('inc/view_all_posts.php') 
                    ?>
                    <?php
                    if (isset($_GET['source'])) {
                        # code...
                        $source = $_GET['source'];
                    } else {
                        # code...
                        $source = "";

                    }
                    switch ($source) {
                        case 'add-post':
                            # code...
                            include('inc/add_post.php');
                            break;
                        case 'edit-post':
                            # code...
                            include('inc/edit_post.php');
                            break;
                        default:
                            # code...
                            include('inc/view_all_posts.php');
                            break;
                    }

                    ?>


                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

</body>

</html>