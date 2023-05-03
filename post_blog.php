<?php
$tablename = "post"; // tabel cần get trong mysql
$tableReader = new TableReader($connectdb);
$query = "SELECT * FROM `$tablename`";
$rows = $tableReader->getAllRows($tablename, $query);

foreach ($rows as $row) {

    $post_title = $row['post_title']; // Thay 'id' bằng tên cột chứa ID trong bảng
    echo " <h2><a href='#'>{$post_title}</a> </h2>";

    $post_author = $row['post_author']; // Thay 'id' bằng tên cột chứa ID trong bảng
    echo "<p class='lead'>by <a href='#'>{$post_author}</a></p>";

    $post_date = $row['post_date']; // Thay 'id' bằng tên cột chứa ID trong bảng
    echo " <p><span class='glyphicon glyphicon-time'></span> {$post_date}</p><hr>";
    $post_image = $row['post_image']; // Thay 'id' bằng tên cột chứa ID trong bảng
    $cleaned_file_path = str_replace("../", "", $post_image);
    echo "<img class='img-responsive' src='{$cleaned_file_path}' style='width: 900px; height: 300px;'><hr>";
    $post_content = $row['post_content']; // Thay 'id' bằng tên cột chứa ID trong bảng
    echo "<p>{$post_content}
                        </p>
                        <a class='btn btn-primary' href='#'>Read More <span class='glyphicon glyphicon-chevron-right'></span></a><hr>";
}
