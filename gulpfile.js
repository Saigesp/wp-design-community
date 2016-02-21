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

/* Build php & basic template files
*  
***********************************/
gulp.task('copy:phptodist', function() { return gulp.src(devpath, {base: dev}).pipe(gulp.dest(dist, {overwrite: true})); });
gulp.task('copy:phptowamp', function() { return gulp.src(devpath, {base: dev}).pipe(gulp.dest(wamp, {overwrite: true})); });

/* Build images
*  
***********************************/
gulp.task('min:imgtodist', function() { return gulp.src([dev+'img/*/*.*', dev+'img/*.*', '!**/RAW/**/*']).pipe(gulp.dest(dist+'img/', {overwrite: true})); });
gulp.task('min:imgtowamp', function() { return gulp.src([dev+'img/*/*.*', dev+'img/*.*', '!**/RAW/**/*']).pipe(gulp.dest(wamp+'img/', {overwrite: true})); });

/* Minimize & build JS
*  
***********************************/
gulp.task('min:jstodist', function() {
  	return gulp.src([dev+'plugins/*/*.js', node +'*/dist/*.js', '!'+node +'*/dist/*.min.js'])
  		.pipe(rename({ suffix: '.min' }))
    	.pipe(uglify())
    	.pipe(gulp.dest(dist+'plugins/', {overwrite: true}));
});

gulp.task('min:jstowamp', function() {
  	return gulp.src([dev+'plugins/*/*.js', node +'*/dist/*.js', '!'+node +'*/dist/*.min.js'])
  		.pipe(rename({ suffix: '.min' }))
    	.pipe(uglify())
    	.pipe(gulp.dest(wamp+'plugins/', {overwrite: true}));
});

/* Minimize & build CSS
*  
***********************************/
gulp.task('min:csstodist', function () {
	return 	gulp.src([dev+'plugins/*/*.css', node +'*/dist/*.css', '!'+node +'*/dist/*.min.css'])
			.pipe(rename({ suffix: '.min' }))
			.pipe(minifycss({ maxLineLen: 80 }))
			.pipe(gulp.dest(dist+'plugins/', {overwrite: true}));	
});

gulp.task('min:csstowamp', function () {
	return 	gulp.src([dev+'plugins/*/*.css', node +'*/dist/*.css', '!'+node +'*/dist/*.min.css'])
			.pipe(rename({ suffix: '.min' }))
			.pipe(minifycss({ maxLineLen: 80 }))
			.pipe(gulp.dest(wamp+'plugins/', {overwrite: true}));	
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


/* Clean directories
*
***********************************/
gulp.task('clean',['clean:dist', 'clean:wamp']);

gulp.task('clean:dist', [], function() {
  console.log("Clean all files in dist folder");
  return gulp.src(dist+'*', { read: false }).pipe(rimraf());
});

gulp.task('clean:wamp', [], function() {
  console.log("Clean all files in wamp folder");
  return gulp.src(wamp+'*', { read: false }).pipe(rimraf());
});




/* Build (Create /dist)
*  
***********************************/
gulp.task('build',['build:dist', 'build:wamp']);
gulp.task('build:dist',['min:jstodist', 'min:csstodist', 'min:imgtodist', 'copy:phptodist']);
gulp.task('build:wamp',['min:jstowamp', 'min:csstowamp', 'min:imgtowamp', 'copy:phptowamp']);



/* Build & synchronize
*  
***********************************/
gulp.task('browser',['build:wamp'], function() {
	var files = [
					'**/*.php',
					'**/*.{png,jpg,gif}'
				];
	browserSync.init(files, {
		proxy: url,
		tunnel: true,
		injectChanges: true
	});
});


/* Browser sync
*  
***********************************/
gulp.task('browser:sync', function() {
	var files = [
					'**/*.php',
					'**/*.{png,jpg,gif}'
				];
	browserSync.init(files, {
		proxy: url,
		tunnel: true,
		injectChanges: true

	});
});


/* Serve (Create wamp folder, watch for /dev changes)
*  
***********************************/
gulp.task('server',['browser'], function(){
 	gulp.watch(dev+'style.css', ['update:style']); 
 	gulp.watch(dev+'*.php', ['update:php', browserSync.reload]);
});

/* Server (Only watch for /dev changes)
*  
***********************************/
gulp.task('server:up',['browser:sync'], function(){
 	gulp.watch(dev+'style.css', ['update:style']); 
 	gulp.watch(dev+'*.php', ['update:php', browserSync.reload]);
});
