<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Author</th>
            <th>Title</th>
            <th>Danh mục</th>
            <th>Status</th>
            <th>Image</th>
            <th>Comments</th>
            <th>Date</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>


        <?php
        $tableReader = new TableReader($connectdb);
        $query = "SELECT * FROM `post`";
        $rows = $tableReader->getAllRows('post', $query);
        foreach ($rows as $row) {

            $post_id  = $row['post_id'];
            $post_danhmuc_id = $row['post_danhmuc_id'];
            $post_title  = $row['post_title'];
            $post_author  = $row['post_author'];
            $post_image  = $row['post_image'];
            $post_content  = $row['post_content'];
            $post_tags  = $row['post_tags'];
            $post_comment_count = $row['post_comment_count'];
            $post_status  = $row['post_status'];
            $post_date  = $row['post_date'];

            $tablename2 = "danhmuc"; // tabel cần get trong mysql
            $tableReader2 = new TableReader($connectdb);
            $query = "SELECT * FROM `$tablename2` WHERE `id_danhmuc` = $post_danhmuc_id";
            $rows = $tableReader->getAllRows($tablename2, $query);
            foreach ($rows as $row) {
                $title_danhmuc = $row['title_danhmuc']; // Thay 'id' bằng tên cột chứa ID trong bảng
            }

            echo "<tr><td>$post_id</td>
                        <td>$post_author</td>
                        <td>$post_title</td>
                        
                        <td>$title_danhmuc</td>
                        <td>$post_status</td>
                        <td><img src='$post_image' style='width: 50px; height: 50px;'></td>
                        <td>$post_comment_count </td>
                        <td>$post_date</td>
                        <td>
                        <a href='post.php?source=edit-post&id=$post_id'><button class='btn btn-primary'>Edit</button></a></td>
                        <td><form method='post' action=''>
                            <input type='hidden' name='deletepost' value='$post_id' />
                            <button type='submit' class='btn btn-danger'>Delete</button>
                        </form>
                       
                       
                       
                 

                    </td></tr>";
        }
        // Bổ sung phần xử lý xóa bài viết
        if (isset($_POST['deletepost'])) {
            $post_id = $_POST['deletepost']; // Lấy ID của bài viết được gửi đi

            // Thực hiện xóa bài viết từ ID
            $query = "DELETE FROM `post` WHERE `post_id` = $post_id";
            $result = $connectdb->query($query);

            // Kiểm tra kết quả xóa
            if ($result) {
                echo "<span class='badge text-bg-danger'>Bài viết đã được xóa thành công</span> ";
            } else {
                echo "<span class='badge text-bg-danger'>Xảy ra lỗi trong quá trình xóa bài viết</span>";
            }
        }
        ?>
        <!-- <td>1</td>
                                <td>Admin</td>
                                <td>tiêu đề</td>
                                <td>danh mục</td>
                                <td>draft</td>
                                <td>Ảnh</td>
                                <td>cmta</td>
                                <td>ngày</td> -->

    </tbody>

</table>