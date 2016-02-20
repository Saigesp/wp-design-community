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
		opn 		 = require('opn');


/* default
*  
***********************************/
gulp.task('default', function() {
  // place code for your default task here
});

/* Build
*  
***********************************/
gulp.task('build',['minjs', 'mincss', 'minimg', 'mintheme']);


/* Build dist
*  
***********************************/
gulp.task('mintheme', function(cb) {
	return gulp.src(devpath, {base: dev})
		.pipe(gulp.dest(dist, {overwrite: true}));
});

/* Build images
*  
***********************************/
gulp.task('minimg', function(cb) {
	return gulp.src([dev+'img/*/*.*', dev+'img/*.*', '!**/*.ai'])
		.pipe(gulp.dest(dist+'img/', {overwrite: true}));
});

/* Minimize JS
*  
***********************************/
gulp.task('minjs', function() {
  	return gulp.src([dev+'plugins/*/*.js', node +'*/dist/*.js', '!'+node +'*/dist/*.min.js'])
  		.pipe(rename({ suffix: '.min' }))
    	.pipe(uglify())
    	.pipe(gulp.dest(dist+'plugins/', {overwrite: true}));
});

/* Minimize CSS
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



/* Gulp Serve
*  
***********************************/
gulp.task('serve',['browser-sync']);

/* Wamperize
*  
***********************************/
gulp.task('wamp', ['build'], function(cb) {
	return gulp.src(distpath, {base: dist})
		.pipe(gulp.dest(wamp, {overwrite: true}));
});

/* Open browser
*  
***********************************/
/*gulp.task('open', function() {
  //opn(url);
  opn('http://localhost/'+project );
});*/


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