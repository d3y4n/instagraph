<?php

$output = NULL;

if( ! empty($_GET['url']) AND ! empty($_GET['filter']))
{
  
  $filename = basename($_GET['url']);
  $filepath = 'public/images/input/' . $filename . '.jpg';
  
  if( ! file_exists($filepath))
  {
    $retval = file_put_contents($filepath, file_get_contents($_GET['url']));
    if($retval == false)
    {
      die('Unable to fetch image from given URL. Aborting.');
    }
  }

  $output = 'public/images/output/' . $filename . '.jpg';
  
  $instagraph = new Instagraph;
  $instagraph->setInput($filepath);
  $instagraph->setOutput($output);
  $instagraph->process($_GET['filter']);

}

if(isset($_GET['__ajax']))
{
  echo $output;
  die;
}

require ROOT . 'public/template.php';
