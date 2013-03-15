<?php

/**
 * Instagram filters with PHP and ImageMagick
 *
 * @package    Instagraph
 * @url        http://instagraph.me (hosted by http://site5.com)
 * @author     Dejan Marjanovic <dm@php.net>
 * @copyright  Webarto
 * @license    http://creativecommons.org/licenses/by-nc/3.0/ CC BY-NC
 */
class Instagraph
{

  public $_input = null;
  public $_output = null;
  public $_prefix = 'IMG';
  private $_width = null;
  private $_height = null;
  private $_tmp = null;

  public function setInput($path)
  {
    if (file_exists($path))
    {
      $this->_input = $path;
      list($this->_width, $this->_height) = getimagesize($path);
      if($this->_width > 720)
      {
        $this->resize(720, 480);
      }
      return true;
    }
    return false;
  }

  public function setOutput($path)
  {
    $this->_output = $path;
    return true;
  }

  public function process($filter)
  {
    $method = 'filter' . $filter;
    if (method_exists($this, $method))
    {
      $this->tempfile();
      $this->{$method}();
      $this->output();
      return true;
    }
    return false;
  }

  public function tempfile()
  {
    # copy original file and assign temporary name
    $this->_tmp = tempnam('/tmp', 'INST');
    copy($this->_input, $this->_tmp);
  }

  public function output()
  {
    # rename working temporary file to output filename
    copy($this->_tmp, $this->_output);
  }

  public function execute($command)
  {
    # remove newlines and convert single quotes to double to prevent errors
    $command = str_replace(array("\n", "'"), array('', '"'), $command);
    # replace multiple spaces with one
    $command = preg_replace('#(\s){2,}#is', ' ', $command);
    # escape shell metacharacters
    $command = escapeshellcmd($command);
    # execute convert program
    return shell_exec($command);
  }

  /** ACTIONS */

  public function resize($w, $h)
  {
    $this->execute("convert $this->_input -resize {$w}x{$h} -unsharp 1.5×1.0+1.5+0.02 $this->_input");
  }

  public function colortone($color, $level, $type = 0)
  {
    $args[0] = $level;
    $args[1] = 100 - $level;
    $negate = $type == 0 ? '-negate' : '';
    $this->execute("convert
        {$this->_tmp} -set colorspace RGB
        ( -clone 0 -fill $color -colorize 100% )
        ( -clone 0 -colorspace gray $negate )
        -compose blend -define compose:args=$args[0],$args[1] -composite
        {$this->_tmp}");
  }

  public function border($color = 'black', $width = 20)
  {
    $this->execute("convert $this->_tmp -bordercolor $color -border {$width}x{$width} $this->_tmp");
  }

  public function frame($frame)
  {
    $frame = dirname(realpath(__FILE__)) . '/' . $frame;
    $this->execute("convert $this->_tmp ( $frame -resize {$this->_width}x{$this->_height}! -unsharp 1.5×1.0+1.5+0.02 ) -flatten $this->_tmp");
  }

  public function vignette($color_1 = 'none', $color_2 = 'black', $crop_factor = 1.5)
  {
    $crop_x = floor($this->_width * $crop_factor);
    $crop_y = floor($this->_height * $crop_factor);
    $this->execute("convert
        ( {$this->_tmp} )
        ( -size {$crop_x}x{$crop_y}
        radial-gradient:$color_1-$color_2
        -gravity center -crop {$this->_width}x{$this->_height}+0+0 +repage )
        -compose multiply -flatten
        {$this->_tmp}");
  }

  /** FILTER METHODS */

  public function filterGotham()
  {
    $this->execute("convert $this->_tmp -modulate 120,10,100 -fill #222b6d -colorize 20 -gamma 0.5 -contrast -contrast $this->_tmp");
    $this->border($this->_tmp);
  }

  public function filterToaster()
  {
    $this->colortone('#330000', 100, 0);
    $this->execute("convert $this->_tmp -modulate 150,80,100 -gamma 1.2 -contrast -contrast $this->_tmp");
    $this->vignette('none', 'LavenderBlush3');
    $this->vignette('#ff9966', 'none');
  }

  public function filterNashville()
  {
    $this->colortone('#222b6d', 100, 0);
    $this->colortone('#f7daae', 100, 1);
    $this->execute("convert $this->_tmp -contrast -modulate 100,150,100 -auto-gamma $this->_tmp");
    $this->frame('Assets/Frames/Nashville');
  }

  public function filterLomo()
  {
    $command = "convert $this->_tmp -channel R -level 33% -channel G -level 33% $this->_tmp";
    $this->execute($command);
    $this->vignette();
  }

  public function filterKelvin()
  {
    $this->execute("convert
        ( $this->_tmp -auto-gamma -modulate 120,50,100 )
        ( -size {$this->_width}x{$this->_height} -fill rgba(255,153,0,0.5) -draw 'rectangle 0,0 {$this->_width},{$this->_height}' )
        -compose multiply
        $this->_tmp");
    $this->frame('Assets/Frames/Kelvin');
  }

  public function filterTiltShift()
  {
    $this->execute("convert
        ( $this->_tmp -gamma 0.75 -modulate 100,130 -contrast )
        ( +clone -sparse-color Barycentric '0,0 black 0,%h white' -function polynomial 4,-4,1 -level 0,50% )
        -compose blur -set option:compose:args 5 -composite
        $this->_tmp");
  }

}
