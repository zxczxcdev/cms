<?php include('inc/admin-header.php') ?>

<div id="wrapper">

    <?php include('inc/admin-navbar.php') ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-xs-6">
                    <h1 class="page-header">
                        Danh mục
                        <small>Subheading</small>
                    </h1>
                    <h2>Thêm danh mục</h2>
                    <form action="danhmuc.php" method="post">
                        <input type="text" name="title_danhmuc" placeholder="Tên danh mục muốn thêm mới" style="width: 300px;">
                        <input type="submit" name="add_danhmuc" value="Thêm danh mục">
                    </form>

                    <h2>Sửa danh mục</h2>
                    <form action="danhmuc.php" method="post">
                        <select name="id" id="">
                            <?php
                            $tablename = "danhmuc"; // tabel cần get trong mysql
                            $tableReader = new TableReader($connectdb);
                            $query = "SELECT * FROM `$tablename`";
                            $rows = $tableReader->getAllRows($tablename, $query);
                            foreach ($rows as $row) {
                                $title_danhmuc = $row['title_danhmuc']; // Thay 'id' bằng tên cột chứa ID trong bảng
                                $id_danhmuc = $row['id_danhmuc']; // Thay 'id' bằng tên cột chứa ID trong bảng
                                echo "<option value='$id_danhmuc'>$id_danhmuc</option>";
                            }
                            ?>
                        </select>
                        <input type="text" name="edit_title_danhmuc" placeholder="Tên danh mục muốn sửa" style="width: 300px;"><br>
                        <input type="submit" name="edit_danhmuc" value="Sửa danh mục">
                    </form>

                    <?php
                    if (isset($_POST['edit_danhmuc'])) {
                        # code...
                        $ten_danhmuc_moi = $_POST['edit_title_danhmuc'];
                        $id_danhmuc = $_POST['id'];
                        $tableReader->updateData('danhmuc', 'title_danhmuc', $ten_danhmuc_moi, $id_danhmuc);
                    }




                    if (isset($_POST['add_danhmuc'])) {
                        # code...
                        $title_danhmuc = $_POST['title_danhmuc'];
                        if ($title_danhmuc == "" || empty($title_danhmuc)) {
                            # code...
                            echo "<h4>Không được để trống!!!</h4>";
                        } else {
                            # code...
                            $tableReader = new TableReader($connectdb);
                            // Thực hiện chèn dữ liệu vào bảng
                            $tablename = "danhmuc";
                            $data = array(
                                // "id_danhmuc" => "null",
                                "title_danhmuc" => "$title_danhmuc",
                                // Các cột và giá trị khác...
                            );
                            $tableReader->insertData($tablename, $data);
                        }
                    }

                    ?>
                </div>

                <h1 class="page-header">

                    <small>Data danh mục</small>
                </h1>


                <div class="col-xs-6">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Title</th>
                            </tr>
                        </thead>
                        <tbody>



                            <?php
                            $tablename = "danhmuc"; // tabel cần get trong mysql
                            $tableReader = new TableReader($connectdb);
                            $query = "SELECT * FROM `$tablename`";
                            $rows = $tableReader->getAllRows($tablename, $query);
                            foreach ($rows as $row) {
                                $title_danhmuc = $row['title_danhmuc']; // Thay 'id' bằng tên cột chứa ID trong bảng
                                $id_danhmuc = $row['id_danhmuc']; // Thay 'id' bằng tên cột chứa ID trong bảng

                                echo "<tr>";
                                echo "<td>{$id_danhmuc}</td>";
                                echo "<td>{$title_danhmuc}  </td>";
                                echo "<td><a href='danhmuc.php?delete={$id_danhmuc}'>Xoá</a></td>";
                            }
                            ?>
                            <?php
                            if (isset($_GET['delete'])) {
                                # code... delete danh mục
                                $id_danhmuc = $_GET['delete'];
                                $tablename = "danhmuc";
                                $rowname = "id_danhmuc";
                                $value = $id_danhmuc;
                                $tableReader->deleteData($tablename, $rowname, $value);
                                //header("Location: danhmuc.php");
                            }



                            ?>
                            <!-- <td>123</td>
                                    <td>bcd</td> -->

                        </tbody>
                    </table>

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