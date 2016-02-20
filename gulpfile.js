// Project configuration
var project 	= 'wp-design-community', 
	url 		= 'http://localhost/wp-design-community/',
	local_port 	= 5000,
	bower 		= './bower_components/',
	node 		= './node_modules/',
	dev 		= './dev/',
	dist 		= './dist/',
	wamp 		= 'C:/wamp/www/wp-design-community/wp-content/themes/wp-design-community/',
	devpath 	= [
				dev+'*.php',
				dev+'plugins/**/*.*',
				dev+'style.css',
				dev+'screenshot.png',
			],
	distpath 	= [
				//dist+'*.php',
				dist+'**/*.*'
			];

// Load plugins
var 	gulp         = require('gulp'),
		browserSync  = require('browser-sync'), // Asynchronous browser loading on .scss file changes
		reload       = browserSync.reload,
		autoprefixer = require('gulp-autoprefixer'), // Autoprefixing magic
		minifycss    = require('gulp-uglifycss'),
		gulpFilter   = require('gulp-filter'),
		uglify       = require('gulp-uglify'),
		imagemin     = require('gulp-imagemin'),
		newer        = require('gulp-newer'),
		rename       = require('gulp-rename'),
		concat       = require('gulp-concat'),
		notify       = require('gulp-notify'),
		cmq          = require('gulp-combine-media-queries'),
		runSequence  = require('run-sequence'),
		plugins      = require('gulp-load-plugins')({ camelize: true }),
		ignore       = require('gulp-ignore'), // Helps with ignoring files and directories in our run tasks
		rimraf       = require('gulp-rimraf'), // Helps with removing files and directories in our run tasks
		zip          = require('gulp-zip'), // Using to zip up our packaged theme into a tasty zip file that can be installed in WordPress!
		plumber      = require('gulp-plumber'), // Helps prevent stream crashing on errors
		cache        = require('gulp-cache'),
		sourcemaps   = require('gulp-sourcemaps'),
		postcss 	 = require('gulp-postcss'),
		mqpacker 	 = require('css-mqpacker'),
		csswring 	 = require('csswring'),
		del 		 = require('del'),
		es           = require('event-stream');


/* default
*  
***********************************/
gulp.task('default', function() {
  // place code for your default task here
});

/* Build (Create /dist)
*  
***********************************/
gulp.task('build',['minjs', 'mincss', 'minimg', 'mintheme']);


/* Server (Create wamp folder, watch for /dev changes)
*  
***********************************/
gulp.task('serve',['browser-sync'], function(){
 	gulp.watch(dev+'style.css', ['update:style']); 
 	gulp.watch(dev+'*.php', ['update:php', browserSync.reload]);
});


/* Build php & basic template files
*  
***********************************/
gulp.task('mintheme', function() {
	return gulp.src(devpath, {base: dev})
		.pipe(gulp.dest(dist, {overwrite: true}));
});

/* Build images
*  
***********************************/
gulp.task('minimg', function() {
	return gulp.src([dev+'img/*/*.*', dev+'img/*.*', '!**/*.ai'])
		.pipe(gulp.dest(dist+'img/', {overwrite: true}));
});

/* Minimize & build JS
*  
***********************************/
gulp.task('minjs', function() {
  	return gulp.src([dev+'plugins/*/*.js', node +'*/dist/*.js', '!'+node +'*/dist/*.min.js'])
  		.pipe(rename({ suffix: '.min' }))
    	.pipe(uglify())
    	.pipe(gulp.dest(dist+'plugins/', {overwrite: true}));
});

/* Minimize & build CSS
*  
***********************************/
gulp.task('mincss', function () {
	return 	gulp.src([dev+'plugins/*/*.css', node +'*/dist/*.css', '!'+node +'*/dist/*.min.css'])
			//.pipe(reload({stream:true}))
			.pipe(rename({ suffix: '.min' }))
			.pipe(minifycss({
				maxLineLen: 80
			}))
			.pipe(gulp.dest(dist+'plugins/', {overwrite: true}));	
});

/* Copy to WAMP folder
*  
***********************************/
gulp.task('wamp', ['build'], function() {
	return gulp.src(distpath, {base: dist})
		.pipe(gulp.dest(wamp, {overwrite: true}));
});








/* Live Reload Style
*
***********************************/
gulp.task('update:style', function() {
	return gulp.src(dev+'style.css', {base: dev})
		.pipe(gulp.dest(wamp, {overwrite: true}));
});

/* Live Reload PHP
*
***********************************/
gulp.task('update:php', function() {
	return gulp.src(dev+'*.php', {base: dev})
		.pipe(gulp.dest(wamp, {overwrite: true}));
});


/* Browser sync
*  
***********************************/
gulp.task('browser-sync',['wamp'], function() {
	var files = [
					'**/*.php',
					'**/*.{png,jpg,gif}'
				];
	browserSync.init(files, {

		// Read here http://www.browsersync.io/docs/options/
		proxy: url,
		//port: local_port,

		// Tunnel the Browsersync server through a random Public URL
		// tunnel: true,

		// Attempt to use the URL "http://my-private-site.localtunnel.me"
		// tunnel: "ppress",

		// Inject CSS changes
		//injectChanges: true

	});
});