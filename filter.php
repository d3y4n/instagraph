<?php

require 'instagraph.php';

try
{
    $filter = $_GET['filter'];
    if( ! in_array($filter, array('lomo', 'nashville', 'kelvin', 'toaster', 'gotham', 'tilt_shift')))
        $filter = 'nashville'; // if method not in array, default it
    
    $instagraph = Instagraph::factory('input.jpg', 'output.jpg');
}
catch (Exception $e) 
{
    echo $e->getMessage();
    die;
}

$instagraph->$filter(); // name of the filter from class

header('Location: index.html'); // redirect to index

?>