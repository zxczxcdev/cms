<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Post Title:</label>
        <input type="text" class="form-control" id="post_title" name="post_title">
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
        <input type="text" class="form-control" id="post_auth" name="post_auth">
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
        <input type="file" class="form-control-file" id="post_image" name="post_image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags:</label>
        <input type="text" class="form-control" id="post_tags" name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content:</label>
        <textarea class="form-control" id="post_content" name="post_content" rows="5"></textarea>
    </div>

    <button type="submit" name="addpost" class="btn btn-primary">Submit</button>
</form>
<?php

if (isset($_POST['addpost'])) {
    $post_title = $_POST['post_title'];
    $post_cat_id = $_POST['id-danhmuc'];
    $post_auth = $_POST['post_auth'];
    $post_status = $_POST['post_status'];
    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];

    $post_date = date('d-m-y');

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
        echo "Không có tệp tin được tải lên.";
        $file_path = null;
    }

    $query = "INSERT INTO `post` (`post_id`, `post_danhmuc_id`, `post_title`, `post_author`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comment_count`, `post_status`) VALUES ('', '$post_cat_id', '$post_title', '$post_auth', '$post_date', '$file_path', '$post_content', '$post_tags', '0', '$post_status');";
    $result = mysqli_query($connectdb, $query);
    if ($result) {
        echo "Data inserted successfully.";
    } else {
        echo "Insert query failed: " . mysqli_error($connectdb);
    }
}

?>