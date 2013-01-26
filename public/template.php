<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="Webarto" />
    <title>
      Instagraph - Instagram with PHP and ImageMagick
    </title>

<style type="text/css">
@import url(http://fonts.googleapis.com/css?family=Lobster&subset=latin,latin-ext);
*{margin:0;padding:0;}
body
{
  color: #fff;
  font-size: 14px;
  font-family: Lobster, Helvetica, Arial, sans-serif;
  background-image: url(http://themes.trendywebstar.com/Smallish/images/header-patterns/header-pattern-01.png), url(http://themes.trendywebstar.com/Smallish/images/background-patterns/body-bg-33.jpg);
  background-repeat: repeat, repeat;
}
input{padding:10px;background:rgba(255,255,255,0.1) url(http://instagraph.me/static/gfx/paper.png) repeat;min-width:480px;border:0;font-family: Lobster, Helvetica, Arial, sans-serif;color:#fff;font-size:1.5em;border:3px solid #4b1805;border-radius:8px;}
h1,h2,h3{text-shadow: 0 0 10px #000;margin: 10px 0;}
.wrapper{margin:0 auto; width:960px;}
.dark-shadow{box-shadow: 0 0 20px #000;}
#filters img{margin:10px;cursor:pointer;}
.center{text-align:center;}
#content, #footer{margin:20px 0;}
a{color:#fff;text-shadow: 0 0 10px #fff;text-decoration:none;}
</style>

    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
    <script type="text/javascript">
      
    </script>
  </head>
  
  <body>
    <div class="wrapper">
      <div id="content" class="center">
        <form action="" method="post" enctype="multipart/form-data">
          <input type="hidden" name="filter" value="" />
          <h1>
            1. Enter Image URL
          </h1>
          <input type="text" name="url" value="https://pbs.twimg.com/media/A8S4f4PCQAA-BT2.jpg" class="dark-shadow" />
          <h1>
            2. Select Filter (click &amp; wait)
          </h1>
          <div id="filters">
            <img data-filter="lomo" alt="" src="/static/gfx/lomo.png" />
            <img data-filter="nashville" alt="" src="/static/gfx/nashville.png" />
            <img data-filter="kelvin" alt="" src="/static/gfx/kelvin.png" />
            <img data-filter="toaster" alt="" src="/static/gfx/toaster.png" />
            <img data-filter="gotham" alt="" src="/static/gfx/gotham.png" />
            <img data-filter="tiltshift" alt="" src="/static/gfx/tilt_shift.png" />
          </div>
          <h1>
            3. Result
          </h1>
          <div>
            <img class="dark-shadow" id="result" alt="" src="" />
          </div>
        </form>
      </div>
    </div>
    <div id="footer" class="center">
      <div class="wrapper">
        <h2>
          Created by
          <a href="http://webarto.com">&#9733;Webarto</a>
        </h2>
      </div>
    </div>
    <script type="text/javascript">
      
      $('#filters img').addClass('dark-shadow');
      
      $('#filters img').click(function(e) {
        e.preventDefault();
        $(this).css('opacity', 1);
        
        var url = $('input[name=url]').val();
        
        if ( ! url)
        {
          alert('URL is missing!');
          return;
        }
        
        var filter = $(this).data('filter');
        $('input[name=filter]').val(filter);
        
        $('#result').attr('src', '/index.php?__ajax=1&url=' + url + '&filter=' + filter);
        
      });

      $('#filters img').each(function(index) {
        var rand = Math.floor(Math.random() * 15);
        if (index % 2 == 0) rand *= -1;
        $(this).css('-moz-transform', 'rotate(' + rand + 'deg)');
        $(this).css('-webkit-transform', 'rotate(' + rand + 'deg)');
        $(this).css('transform', 'rotate(' + rand + 'deg)');
      });

      $('input[type=file]').addClass('upload');
    
    </script>
  </body>
</html>