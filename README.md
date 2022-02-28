UberGallery - The simple PHP photo gallery
==========================================
Created by, [Chris Kankiewicz](http://www.ChrisKankiewicz.com)


Introduction
------------
UberGallery is an easy to use, simple to manage, web photo gallery written in PHP and distributed
under the [MIT License](http://www.opensource.org/licenses/mit-license.php). UberGallery
**does not** require a database and supports JPEG, GIF and PNG file types. Simply upload your images
and UberGallery will automatically generate thumbnails and output standards compliant XHTML markup
on the fly.

Please read the [original readme](https://github.com/UberGallery/UberGallery/blob/master/README.md) for more info, as the rest of this readme
will pretain to my fork!

Freakmoch fork "SuberGallery"
------------

This fork takes ubergallery and, instead of making it it's own themed page with a standalone page, allows you 
to incorperate your gallery into your own layouts/themes. (It probably could already do that but I couldn't figure it
out lol)

This also abuses the script to allow the use of having *multiple galleries* using subdirectories in
your gallery folder and allowing pagination to work on everything. You can see how this functions on my websites,
[eternal-anime.org](https://eternal-anime.org/gallery.php) and [kinotabi.info](https://kinotabi.info/gallery.php)


I originally made this a stand-alone php file, but I realized I had more involved config as I updated this for
my own site, so I just forked UberGallery itself.


Features
--------
  * Simple first time installation
  * Database-less configuration
  * Include galleries within pre-existing sites
  * Create multiple galleries with a single installation
  * Easily customize your gallery styles via CSS
  * Install and update the gallery easily wth Git (optional)
  * Have multiple subgalleries

Limits
--------

   * UberGallery cannot handle any GIFs above 3MB or extremely large (>5MB jpg/png files. (Yes, I have tested these limits
for my fansites lol) I reccommend you use something like PhotoScape to scale down.
   * Loading more than 100 images in no-pagination mode will make your gallery lag, or hardly load, so please be careful with this.
   * Currently gallery paths are grabbed via the php GET method. Someday I will chnage this to be better.

Requirements
------------
UberGallery requires PHP 5.2+ and the PHP-GD image library to work properly. For more information on
PHP and the PHP-GD image library, please visit [http://php.net](http://php.net).


Simple Installation
-------------------
  1. Copy `resources/sample.galleryConfig.ini` to `resources/galleryConfig.ini` and modify the settings
to your liking.

  2. Upload `index.php`, `resources/` and `gallery-images/` to your web server.

  3. Go into index.php and configure the path to your gallery folder. 

  4. Upload images to the `gallery-images/` directory.

  5. Make the `resources/cache/` directory writable by the web server:

    ```
    chmod 777 /path/to/resources/cache
    ```

  6. Open your web browser and load the page where you installed UberGallery.

License
-------
UberGallery is distributed under the terms of the
[MIT License](http://www.opensource.org/licenses/mit-license.php).
Copyright © 2013 [Chris Kankiewicz](http://www.chriskankiewicz.com)
