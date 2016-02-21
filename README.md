# WP Design Community

Wordpress theme for communities.

Side project to develop a wordpress theme centered in user communities, to improve little organitzation's workflow. Currently mixing and cleaning old code.

Building with **node** and **gulp**.

----------

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
----------

## Gulp tasks
#### Build
 - Copy & minimize files from `/dev` to `/dist`
 - Copy & minimize files from `/dev` to `/wamp`

```
gulp build
```
Also exists `gulp build:dist` and `gulp build:wamp`

#### Build wamp folder with live preview

 - Copy & minimize files from `/dev` to `/wamp` (see [Configure with WAMP](#wamp_config) )
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
----------

## <a name="wamp_config"></a>Configure with WAMP
To develop locally a theme in Wordpress, yo had to set up a LAMP server (Linux, Apache, MySql & PHP). To do that, I recommend you use [WAMP](http://www.wampserver.com/en/)/[MAMP](https://www.mamp.info/en/)/[XAMPP](https://www.apachefriends.org/index.html). 

Set wamp folder in `gulpfile.js`:
```
wamp = 'C:/wamp/www/wp-design-community/wp-content/themes/wp-design-community/',
```