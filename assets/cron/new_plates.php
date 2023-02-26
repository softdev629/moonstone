<html>
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Data Import</title>
<head>
<body>
<?php

$servername = "cureandsimple-cluster.cluster-cuvfbgw1bxdj.eu-west-2.rds.amazonaws.com";
$username = "root";
$password = "Cureandsimpl3!";
$dbname = "moonstone";

$total_count=0;
$old_total_count=0;

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error)
{
die("Connection failed: " . $conn->connect_error);
}
echo 'c';

/* change character set to utf8 */
if (!mysqli_set_charset($conn, "utf8")) {
    printf("Error loading character set utf8: %s\n", mysqli_error($conn));
    exit();
} else {
    printf("Current character set: %s\n", mysqli_character_set_name($conn));
}
$total_count=0;
$old_total_count=0;
$fields = array("prefix","numbers","letters","price");
$file = 'new_plates_20201122_000003.csv';
print($file);
$data=array();
        if(file_exists($file)){

            $csv_file = fopen($file, "r");
            if ($csv_file) {

                $size = filesize($file);
                while (($getData = fgetcsv($csv_file, $size, ",")) !== FALSE)
                {  

                 print($getData);   
                    if (count($getData) > 1) {

                        for ($i=0, $j=count( $fields ); $i<$j; $i++ ) {
                            $vals[$fields[$i]] = trim(addslashes(preg_replace('/"/', "", getData[$i])));
                        }
                         
                        
                        //update data
                        if($vals['prefix']!="" && $vals['prefix']!="prefix")
                        {

                            $prefix=$vals['prefix'];
                            $letters=$vals['letters'];
                            $numbers=$vals['numbers'];
                            $plates_numbers=$vals['prefix'].' '.$vals['numbers'].' '.$vals['letters'];
                            $plate_id=md5($plates_numbers);
                            $price=$vals['price'];
                            
                            $CheckPlateRecord = $conn->query("SELECT `id` FROM `new_plates` WHERE `plate_id` = '".$plate_id."'");
                            if($CheckPlateRecord->num_rows==0)
                            {

                                $AddRecord = "INSERT INTO `new_plates` (
                                `number`,
                                plate_id, 
                                price
                                ) 
                                VALUES (
                                '".$plates_numbers."',
                                '".$plate_id."',
                                '".$price."'
                                  )";
                                $conn->query($AddRecord);
                                $id = $conn->insert_id;
                                $NumberList[]=$id;
                            }
                            
                        }


                    }
 
     
                   
                }

            }
            echo "<pre>";
            print_r($NumberList);
            die();
        }else{
            echo "no file exists";
        }  
 
 
 ?>


