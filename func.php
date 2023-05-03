<?php include('inc/db.php') ?>
<?php

function getID()
{
    $queryString = "SELECT * FROM danhmuc";
    global $connectdb;
    $resultString = mysqli_query($connectdb, $queryString);
    while ($row = mysqli_fetch_assoc($resultString)) {
        # code...
        $id = $row["id_danhmuc"];
        echo "<option value='$id'>$id</option>";
    }
}

function getAllFrom($tablename, $idname)
{
    global $connectdb;
    $getAllFrom = "SELECT * FROM `$tablename`";
    $query = mysqli_query($connectdb, $getAllFrom);
    $result = array();
    while ($rows = mysqli_fetch_assoc($query)) {
        $id = $rows[$idname];
        $result[] = $id;
    }
    return $result;
}
class TableReader
{
    private $connectdb;

    public function __construct($db)
    {
        $this->connectdb = $db;
    }

    public function getAllRows($tablename, $query)
    {
        $result = mysqli_query($this->connectdb, $query);

        $rows = array(); // Mảng để lưu các hàng

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $rows[] = $row; // Thêm hàng vào mảng
            }
        } else {
            echo "Query failed: " . mysqli_error($this->connectdb);
        }

        return $rows; // Trả về mảng chứa các hàng
    }
    public function insertData($tablename, $data)
    {
        $columns = implode(", ", array_keys($data));
        $values = "'" . implode("', '", array_values($data)) . "'";
        
        // Kiểm tra nếu giá trị là số hoặc null, không cần bao quanh bằng dấu nháy đơn
        $values = preg_replace("/'(null|\d+)'/", '$1', $values);
        
        $query = "INSERT INTO $tablename ($columns) VALUES ($values)";
    
        $result = mysqli_query($this->connectdb, $query);
    
        if ($result) {
            echo "Data inserted successfully.";
        } else {
            echo "Insert query failed: " . mysqli_error($this->connectdb);
        }
    }
    
    public function deleteData($tablename, $rowname, $value)
    {
        $query = "DELETE FROM $tablename WHERE $rowname = $value";
        $result = mysqli_query($this->connectdb, $query);

        if ($result) {
            echo "Data deleted successfully.";
        } else {
            echo "Delete query failed: " . mysqli_error($this->connectdb);
        }
    }
    public function updateData($tablename, $rowname, $new_title, $id)
    {
        $query = "UPDATE `$tablename` SET `$rowname` = '$new_title' WHERE `id_danhmuc` = $id";
        $result = mysqli_query($this->connectdb, $query);

        if ($result) {
            echo "Data updated successfully.";
        } else {
            echo "Update query failed: " . mysqli_error($this->connectdb);
        }
    }
}








?>
