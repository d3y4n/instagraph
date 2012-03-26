<?php

require 'instagraph.php';

try
{
$instagraph = Instagraph::factory('input.jpg', 'output.jpg');
}
catch (Exception $e) 
{
    echo $e->getMessage();
    die;
}

$instagraph->toaster(); // name of the filter

?>