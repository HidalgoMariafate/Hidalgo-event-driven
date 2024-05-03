<?php
$data = array(
    'postal_regCode' => "'" . $_POST['inp_region'] . "'",
    'postal_provCode' => "'" . $_POST['inp_province'] . "'",
    'postal_citymunCode' => "'" . $_POST['inp_ctymun'] . "'",
    'postal_code' => "'" . $_POST['inp_postalcode'] . "'",
   
);


save($data);

function save($data)
{
    include('../config/database.php');

    $attributes = implode(", ", array_keys($data));
    $values = implode(", ", array_values($data));
    $query = "INSERT INTO `ph_postalcode` ($attributes) VALUES ($values)";

    if($conn->query($query) === TRUE){
        header('location: ../postalCode.php?success');
    }else{
        header('location: ../postalCode.php?invalid');
    }

    $conn->close();
}
 