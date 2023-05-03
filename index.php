<?php 
include('inc/header.php');
include('func.php') ;
?>

<body>

<?php include('inc/navbar.php') ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>
                <?php include('post_blog.php') ?>

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
                        <form action="search.php" method="post">
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
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
                            <?php  
                    $tablename = "danhmuc"; // tabel cần get trong mysql
                    $tableReader = new TableReader($connectdb);
                    $query = "SELECT * FROM `$tablename`";
                    $rows = $tableReader->getAllRows($tablename , $query);
                    foreach ($rows as $row) {
                        $title_danhmuc = $row['title_danhmuc']; // Thay 'id' bằng tên cột chứa ID trong bảng
                        echo "<li><a href='#'>{$title_danhmuc}</a></li>";
                    }
                            ?>
                            </ul>
                        </div>
                       
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <div class="well">
                    <h4>Side Widget Well</h4>
                    <p><a href="admin">AdminCP</a></p>
                </div>

            </div>

        </div>
        <!-- /.row -->

        <hr>

        <?php include('inc/footer.php') ?>
    </div>
    <!-- /.container -->
</body>

</html>
