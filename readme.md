# [Instagraph](http://instagraph.me) - Instagram with ImageMagick & PHP

In this repository, I’ll demonstrate you how to create vintage (just like Instagram does) photos effects with PHP and ImageMagick. Wait? What? Yes, you can do this very thing with PHP and ImageMagick, and that’s just scratching the surface of allmighty Imagemagick!

## In Few Short Lines

- Requires PHP 5.3 + Imagemagick (not Imagick extension)
- Features Lomo, Nasvhille, Kelvin, Toaster, Gotham, Tilt-Shift
- ???
- I don't own a "smartphone" so I can't use real Instagram app to compare

## Example Usage

```php
<?php

$instagraph = new Instagraph;
$instagraph->setInput('sucks.jpg');
$instagraph->setOutput('rocks.jpg');
$instagraph->process('toaster');
# You can see changes in output file now
```

## Demo

Demo application is included, it looks like:

![Demo](http://i.imgur.com/cEWW6gw.jpg)

Live demo will be up soon on: [Instagraph.me](http://instagraph.me)

##### Virtual Host for Apache

```php
Listen *:1337

<VirtualHost *:1337>
ServerName Instagraph
DocumentRoot /var/www/instagraph/public
    <Directory "/var/www/instagraph/public">
        Options Indexes FollowSymLinks Includes ExecCGI
        AllowOverride All
        Order allow,deny
        Allow from all
    </Directory>
</VirtualHost>
```

If on Windows, just replace `/var/www/` with e.g. `C:\www\`.

## Contributing to Instagraph

Contributions are welcome, if you have ideas or filters, or
even better, some code for them, please open up Issue or Pull Request. 

## License

Instagraph is open-sourced software licensed under the MIT License.