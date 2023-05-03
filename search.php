<?php
include('inc/header.php');
include('func.php');
?>

<body>

    <?php include('inc/navbar.php') ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    Trang tìm kiếm
                    <small>Secondary Text</small>
                </h1>
                <?php
                if (isset($_POST['search'])) {
                    # code...
                    $search = $_POST['search'];
                    $query = "SELECT * FROM `post` WHERE `post_tags` LIKE '%$search%';";
                    $search_query = mysqli_query($connectdb, $query);
                    if (!$search_query) {
                        # code...
                        die('Lỗi truy vấn');
                    }
                    $count = mysqli_num_rows($search_query);
                    if ($count > 0) {
                        # code...
                        echo "<h1>có kết quả</h1>";

                        $tablename = "post"; // tabel cần get trong mysql
                        $tableReader = new TableReader($connectdb);
                        $rows = $tableReader->getAllRows($tablename, $query);

                        foreach ($rows as $row) {

                            $post_title = $row['post_title']; // Thay 'id' bằng tên cột chứa ID trong bảng
                            echo " <h2><a href='#'>{$post_title}</a> </h2>";

                            $post_author = $row['post_author']; // Thay 'id' bằng tên cột chứa ID trong bảng
                            echo "<p class='lead'>by <a href='#'>{$post_author}</a></p>";

                            $post_date = $row['post_date']; // Thay 'id' bằng tên cột chứa ID trong bảng
                            echo " <p><span class='glyphicon glyphicon-time'></span> {$post_date}</p><hr>";

                            $post_image = $row['post_image']; // Thay 'id' bằng tên cột chứa ID trong bảng
                            echo " <img class='img-responsive' src='{$post_image}' alt=''><hr>";

                            $post_content = $row['post_content']; // Thay 'id' bằng tên cột chứa ID trong bảng
                            echo "<p>{$post_content}
                            </p>
                            <a class='btn btn-primary' href='#'>Read More <span class='glyphicon glyphicon-chevron-right'></span></a><hr>";
                        }
                    } else {
                        # code...
                        echo "<h1>Không có kết quả</h1>";
                    }
                }

                ?>

                <!-- Pager -->
                <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">

                <!-- Blog Search Well -->

                <div class="well">
                    <h4>Blog Search</h4>
                    <div class="input-group">
                        <form action="" method="post">
                            <input name="search" type="text" class="form-control">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit" name="submit">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </span>
                    </div>
                    </form>
                    <!-- /.input-group -->
                </div>

                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.col-lg-6 -->
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.col-lg-6 -->
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <div class="well">
                    <h4>Side Widget Well</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
                </div>

            </div>

        </div>
        <!-- /.row -->

        <hr>

        <?php include('inc/footer.php') ?>
    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>