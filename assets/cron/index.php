<?php
use Phppot\DataSource;

require_once 'DataSource.php';
$db = new DataSource();
$conn = $db->getConnection();



    $fileName = 'new_plates_20201122_000003.csv';



        $file = fopen($fileName, "r");

        while (($column = fgetcsv($file, 100000000, ",")) !== FALSE) {

            $prefix = "";
            if (isset($column[0])) {
                $prefix = mysqli_real_escape_string($conn, $column[0]);
            }
            $numbers = "";
            if (isset($column[1])) {
                $numbers = mysqli_real_escape_string($conn, $column[1]);
            }
            $letters = "";
            if (isset($column[2])) {
                $letters = mysqli_real_escape_string($conn, $column[2]);
            }
            $price = "";
            if (isset($column[3])) {
                $price = mysqli_real_escape_string($conn, $column[3]);
            }

            $sqlInsert = "INSERT into new_plates_20201122_000003 (prefix,numbers,letters,price)
                   values (?,?,?,?)";
            $paramType = "issss";
            $paramArray = array(
                $prefix,
                $numbers,
                $letters,
                $price
            );
            $insertId = $db->insert($sqlInsert, $paramType, $paramArray);

            if (! empty($insertId)) {
                $type = "success";
                $message = "CSV Data Imported into the Database";
            } else {
                $type = "error";
                $message = "Problem in Importing CSV Data";
            }
        }


?>