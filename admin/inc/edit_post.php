<?php
if (isset($_GET['id'])) {
    # code...
    $tablename = "post"; // tabel cần get trong mysql
    $tableReader = new TableReader($connectdb);
    $id = $_GET['id'];
    $query = "SELECT * FROM `post` WHERE `post_id` = $id;";
    $rows = $tableReader->getAllRows($tablename, $query);
    $rows = $tableReader->getAllRows($tablename, $query);
    foreach ($rows as $row) {
        $post_title = $row['post_title'];
        $post_danhmuc_id = $row['post_danhmuc_id'];
        $post_author =  $row['post_author'];
        $post_date = $row['post_date'];
        $post_content = $row['post_content'];
        $post_tags = $row['post_tags'];
        $post_status = $row['post_status'];
        $post_image = $row['post_image'];
    }
}
?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Post Title:</label>
        <input type="text" class="form-control" id="post_title" name="post_title" value="<?php echo $post_title ?>">
    </div>
    <div class="form-group">
        <label for="post_cat_id">Post Category ID:</label>
        <select name="id-danhmuc" id="">
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
    </div>
    <div class="form-group">
        <label for="post_auth">Post Author:</label>
        <input type="text" class="form-control" id="post_auth" name="post_auth" value="<?php echo $post_author ?>">
    </div>
    <div class="form-group">
        <label for="post_status">Post Status:</label>
        <select class="form-control" id="post_status" name="post_status">
            <option value="draft">Draft</option>
            <option value="published">Published</option>
        </select>
    </div>
    <div class="form-group">
        <label for="post_image">Post Image:</label>
        <?php echo "<img src='$post_image' style='width: 100px; height: 100px;'>"; ?>
        <input type="file" class="form-control-file" id="post_image" name="post_image">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags:</label>
        <input type="text" class="form-control" id="post_tags" name="post_tags" value="<?php echo $post_tags ?>">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content:</label>
        <textarea class="form-control" id="post_content" name="post_content" rows="5"><?php echo $post_content ?></textarea>
    </div>
    <button type="submit" name="updatepost" class="btn btn-success">Update</button>
</form>

<?php
if (isset($_POST['updatepost'])) {
    # code...

    if (isset($_FILES['post_image'])) {
        $image_name = $_FILES['post_image']['name'];
        $image_tmp = $_FILES['post_image']['tmp_name'];
        $file_path = "../uploads/$image_name"; // Đường dẫn đến tệp tin

        if (move_uploaded_file($image_tmp, $file_path)) {
            echo "Tải lên tệp tin thành công";
        } else {
            $file_path = "../uploads/Fineshop.png";
            echo "Tải lên tệp tin thất bại.";
        }
    } else {
        echo "Không có tệp tin được tải lên. Sử dụng hình ảnh mặc định!";
        $file_path = "../uploads/Fineshop.png";
    }

    $post_title = $_POST['post_title'];
    $post_iddanhmuc =  $_POST['id-danhmuc']; 
    $post_author = $_POST['post_auth'];
    $post_status = $_POST['post_status'];
    $post_tags = $_POST['post_tags'];
   
    $post_content = $_POST['post_content'];
    $query  = "UPDATE `post` SET `post_danhmuc_id` = '$post_iddanhmuc', `post_title` = '$post_title', `post_author` = '$post_author', `post_image` = '$file_path', `post_content` = '$post_content', `post_tags` = ' $post_tags' WHERE `post`.`post_id` = $id;";
$result = mysqli_query($connectdb, $query);
if ($result) {
    # code...
    echo "Update thành công";
}else {
    # code...
    echo "Update thất bại";
}
   

}
?>