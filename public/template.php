<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="author" content="Webarto" />
    <title>Instagraph - Instagram with PHP and ImageMagick</title>
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Lobster&subset=latin,latin-ext">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
    <script type="text/javascript" src="/js/main.js"></script>
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
  </body>
  </html>