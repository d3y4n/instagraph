<?php
require '../bootstrap.php';
$output = NULL;

if( !empty($_GET['url']) && !empty($_GET['filter'])) {
    $filter = $_GET['filter'];
    $filename = sha1( basename($_GET['url']) );
    $filepath = ROOT . 'public/images/input/' . $filename . '.jpg';

    if( ! file_exists($filepath)) {
        $retval = file_put_contents($filepath, file_get_contents($_GET['url']));
        if($retval === false) {
            die('Unable to fetch image from given URL. Aborting.');
        }
    }
    $output = ROOT.'public/images/output/'.$filename.'_'.$filter.'.jpg';

    $instagraph = new Instagraph;
    $instagraph->setInput($filepath);
    $instagraph->setOutput($output);
    $instagraph->process($filter);
}

if (isset($_GET['__ajax']) OR isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
    $output = '/images/output/'.basename($output);
    header('Location: ' . $output, TRUE, 302);
    die;
}

require ROOT . 'public/template.php';