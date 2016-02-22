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


## Gulp tasks
#### Build
 - Copy & minimize files from `/dev` to `/dist`
 - Copy & minimize files from `/dev` to `/wamp`
 - Inject JS & CSS files from plugins in `header.php` and `footer.php`

```
gulp build
```
Also exists `gulp build:dist` and `gulp build:wamp`

#### Build wamp folder with live preview

 - Copy & minimize files from `/dev` to **only** `/wamp` (see [Configure with WAMP](#wamp_config))
 - Inject JS & CSS files from plugins in `header.php` and `footer.php`
 - Start browser sync in `/wamp`
 - Watch for changes in `/dev` and update `/wamp`

```
gulp server
```

#### Only live preview

 - Start browser sync in `/wamp`
 - Watch for changes in `/dev` and update `/wamp`

```
gulp server:up
```

#### Generate favicon

 - Generate real favicon files from `/dev/img/favicon.png` and place it in `/dev/img/favicon/`.
 - Inject file's link tags in `/dev/header.php`.
 - See [Real Favicon Generator](http://realfavicongenerator.net/) for more info.

```
gulp favicon
```
Also `npm build:favicon` is same as below, but it affects `/dist` && `/wamp` (not only `/dev`).


## <a name="wamp_config"></a>Configure with WAMP
To develop locally a theme in Wordpress, yo had to set up a LAMP server (Linux, Apache, MySql & PHP). To do that, I recommend you use [WAMP](http://www.wampserver.com/en/)/[MAMP](https://www.mamp.info/en/)/[XAMPP](https://www.apachefriends.org/index.html). 

Set wamp folder in `gulpfile.js`:
```
wamp = 'C:/wamp/www/wp-design-community/wp-content/themes/wp-design-community/',
```