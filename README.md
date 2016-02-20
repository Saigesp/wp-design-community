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
Build `/dev` to `/dist`
```
gulp build
```
#### Build & live preview

 - Build `/dev` to `/dist`
 - Build `/dev` to `wamp folder` (see [Configure with WAMP](#wamp_config) )
 - Watch for changes in `/dev` and update `wamp folder`
```
gulp serve
```
----------

## <a name="wamp_config"></a>Configure with WAMP
Set wamp folder in `gulpfile.js`:
```
wamp = 'C:/wamp/www/wp-design-community/wp-content/themes/wp-design-community/',
```