# WP Design Community

Wordpress theme for communities.

Side project to develop a wordpress theme centered in user communities, to improve little organitzation's workflow. Currently mixing and cleaning old code.

Building with **node** and **gulp**.



## Install
Clone files to your git local folder:
```
git clone https://github.com/Saigesp/wp-design-community.git
```
Navigate to the root path:
```
cd wp-design-community
```
Install dependencies (be sure you're in sudo/admin mode):
```
npm install
```

### <a name="wamp_config"></a>Configure with WAMP
To develop locally a theme in Wordpress, yo need setup a local server based on LAMP (Linux, Apache, MySql & PHP). To do that, is strongly recommended to use [WAMP](http://www.wampserver.com/en/)/[MAMP](https://www.mamp.info/en/)/[XAMPP](https://www.apachefriends.org/index.html). 

Set wamp folder in `gulpfile.js`:
```
wamp = 'C:/wamp/www/wp-design-community/wp-content/themes/wp-design-community/',
```

## Gulp tasks
#### Server
 - Copy & minimize files from `/dev` to `/wamp` (see [Configure with WAMP](#wamp_config))
 - Inject JS & CSS files from plugins in `header.php` and `footer.php`
 - Start browser sync in `/wamp`
 - Watch for changes in `/dev` and update `/wamp`

```
gulp server
```
`gulp server:up` to start browser sync in `/wamp` and watch for changes.

#### Build dist

 - Copy & minimize files from `/dev` to `/dist` || `/wamp`.
 - Inject JS & CSS files from plugins in `header.php` and `footer.php`

```
gulp build:dist
gulp build:wamp
```

#### Generate favicon

 - Generate favicon from `/dev/img/favicon.png` and place it in `/dev` && `/dist` && `/wamp`.
 - Inject file's in `/dev/header.php`.
 - See [Real Favicon Generator](http://realfavicongenerator.net/) for more info.

```
npm build:favicon
```

## Theme dependencies

#### Recommended Wordpress Plugins
 - WP Subtitle
 - Disqus Comment System
 - WP User Avatar

#### Others scripts (injected)
 - jQuery
 - Imagesloaded
 - Imagefill.js
 - Flickity
 - Masonry
 - Medium editor
 - Selection-sharer
 - Infinite Ajax Scroll
