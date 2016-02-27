# WP Design Community

Wordpress theme for communities.

Side project to develop a wordpress theme centered in user communities, to improve little organitzation's workflow. Currently mixing and cleaning old code.

Building with **node**, **gulp** and **[WAMP](#wamp_config)**

## Install
Clone files to your wordpress theme directory:
```
git clone https://github.com/Saigesp/wp-design-community.git
```
Navigate to the theme folder:
```
cd wp-design-community
```
Install dependencies (be sure you're in sudo/admin mode):
```
npm install
```
Build (Inject plugins && minimize files)
```
gulp build
```

## <a name="wamp_config"></a>Configure with WAMP
To develop locally a theme in Wordpress, yo need setup a local server based on LAMP (Linux, Apache, MySql & PHP). To do that, is strongly recommended to use [WAMP](http://www.wampserver.com/en/)/[MAMP](https://www.mamp.info/en/)/[XAMPP](https://www.apachefriends.org/index.html). 

## Gulp tasks
#### Server
 - Start browsersync in your wamp project's folder.
 - Watch for changes in and update refresh the page.

```
gulp server
```

#### Build && Inject new files

 - Minimize and inject JS & CSS files from plugins to `header.php` and `footer.php`.

```
gulp build
```

#### Build dist

 - Copy theme files to `/dist` folder.

```
gulp dist
```

#### Generate favicon

 - Generate favicon and place files it in `/dev` && `/dist`.
 - Inject file's tags in `header.php` && `/dist/header.php`.
 - See [Real Favicon Generator](http://realfavicongenerator.net/) for more info.

```
gulp favicon
```

## Theme dependencies

#### Recommended Wordpress Plugins
 - WP Subtitle
 - Disqus Comment System
 - WP User Avatar
 - Events Manager

#### Others scripts (injected)
 - jQuery
 - Imagesloaded
 - Imagefill.js
 - Flickity
 - Masonry
 - Medium editor
 - Selection-sharer
 - Infinite Ajax Scroll
