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

var wamp_inject_path_slice = wamp.length + 3; //Change it to adjust the url of injected scripts
var dist_inject_path_slice = dist.length - 2;
var favicon_data_file = dev+'faviconData.json';
var favicon_master_img = dev+'img/default/logo600x600.png';
var favicon_output_path = dev+'img/favicon/';
var favicon_icon_path = '<?php echo get_stylesheet_directory_uri(); ?>/img/favicon/'; //Prepared to wordpress

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
		inject 		 = require('gulp-inject');
		cache        = require('gulp-cache'),
		sourcemaps   = require('gulp-sourcemaps'),
		postcss 	 = require('gulp-postcss'),
		mqpacker 	 = require('css-mqpacker'),
		csswring 	 = require('csswring'),
		del 		 = require('del'),
		es           = require('event-stream'),
		realFavicon  = require ('gulp-real-favicon'),
		fs 			 = require('fs');

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

/* Minimize & build CSS
*  
***********************************/
gulp.task('min:csstodist',['copy:phptodist'], function () {
	return 	gulp.src([dev+'plugins/*/*.css', node +'*/dist/*.css', '!'+node +'*/dist/*.min.css'])
			.pipe(rename({ suffix: '.min' }))
			.pipe(minifycss({ maxLineLen: 80 }))
			.pipe(gulp.dest(dist+'plugins/', {overwrite: true}));	
});

gulp.task('min:csstowamp',['copy:phptowamp'], function () {
	return 	gulp.src([dev+'plugins/*/*.css', node +'*/dist/*.css', '!'+node +'*/dist/*.min.css'])
			.pipe(rename({ suffix: '.min' }))
			.pipe(minifycss({ maxLineLen: 80 }))
			.pipe(gulp.dest(wamp+'plugins/', {overwrite: true}));	
});


/* Inject CSS plugins files
*  
***********************************/
gulp.task('inject:cssondist',['min:csstodist'], function () {
	return gulp.src(dist+'header.php')
	  .pipe(inject(
	    gulp.src([dist+'plugins/**/*.css'], {read: false}), {
	      transform: function (filepath) {
	      //  if (filepath.slice(-5) === '.docx') {
	          return '<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>' + filepath.slice(dist_inject_path_slice) + '"/>';
	      //  }
	        // Use the default transform as fallback: 
	        //return inject.transform.apply(inject.transform, arguments);
	      }
	    }
	  ))
	  .pipe(gulp.dest(dist));
});

gulp.task('inject:cssonwamp',['min:csstowamp'], function () {
	return gulp.src(wamp+'header.php')
	  .pipe(inject(
	    gulp.src([wamp+'plugins/**/*.css'], {read: false}), {
	      transform: function (filepath) {
	          return '<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>' + filepath.slice(wamp_inject_path_slice) + '"/>';
	      }
	    }
	  ))
	  .pipe(gulp.dest(wamp));
});


/* Minimize & build JS
*  
***********************************/
gulp.task('min:jstodist',['inject:cssondist'], function() {
  	return gulp.src([dev+'plugins/*/*.js', node +'*/dist/*.js', '!'+node +'*/dist/*.min.js'])
  		.pipe(rename({ suffix: '.min' }))
    	.pipe(uglify())
    	.pipe(gulp.dest(dist+'plugins/', {overwrite: true}));
});

gulp.task('min:jstowamp',['inject:cssonwamp'], function() {
  	return gulp.src([dev+'plugins/*/*.js', node +'*/dist/*.js', '!'+node +'*/dist/*.min.js'])
  		.pipe(rename({ suffix: '.min' }))
    	.pipe(uglify())
    	.pipe(gulp.dest(wamp+'plugins/', {overwrite: true}));
});


/* Inject CSS plugins files
*  
***********************************/
gulp.task('inject:jsondist',['min:jstodist'], function () {
	return gulp.src(dist+'footer.php')
	  .pipe(inject(
	    gulp.src([dist+'plugins/**/*.js'], {read: false}), {
	      transform: function (filepath) {
	          return '<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>' + filepath.slice(dist_inject_path_slice) + '"></script>';
	      }
	    }
	  ))
	  .pipe(gulp.dest(dist));
});

gulp.task('inject:jsonwamp',['min:jstowamp'], function () {
	return gulp.src(wamp+'footer.php')
	  .pipe(inject(
	    gulp.src([wamp+'plugins/**/*.js'], {read: false}), {
	      transform: function (filepath) {
	          return '<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>' + filepath.slice(wamp_inject_path_slice) + '"></script>';
	      }
	    }
	  ))
	  .pipe(gulp.dest(wamp));
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


/* Build (Create /dist)
*  
***********************************/
gulp.task('build',['build:dist', 'build:wamp']);
gulp.task('build:dist',['inject:jsondist', 'min:imgtodist']);
gulp.task('build:wamp',['inject:jsonwamp', 'min:imgtowamp']);


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


/* Create favicon
*  
***********************************/
gulp.task('generate-favicon', function(done) {
	realFavicon.generateFavicon({
		masterPicture: favicon_master_img,
		dest: favicon_output_path,
		iconsPath: favicon_icon_path,
		design: {
			ios: {
				pictureAspect: 'backgroundAndMargin',
				backgroundColor: '#ffffff',
				margin: '49%'
			},
			desktopBrowser: {},
			windows: {
				pictureAspect: 'noChange',
				backgroundColor: '#da532c',
				onConflict: 'override'
			},
			androidChrome: {
				pictureAspect: 'backgroundAndMargin',
				margin: '42%',
				backgroundColor: '#ffffff',
				themeColor: '#ffffff',
				manifest: {
					name: 'WP-DC',
					display: 'browser',
					orientation: 'notSet',
					onConflict: 'override',
					declared: true
				}
			},
			safariPinnedTab: {
				pictureAspect: 'silhouette',
				themeColor: '#d55b5b'
			}
		},
		settings: {
			scalingAlgorithm: 'Mitchell',
			errorOnImageTooSmall: false
		},
		markupFile: favicon_data_file
	}, function() {
		done();
	});
});

/* Inject the favicon markups in your HTML pages.
*  
***********************************/
gulp.task('favicon', ['generate-favicon'], function() {
	gulp.src([dev+'header.php'])
		.pipe(realFavicon.injectFaviconMarkups(JSON.parse(fs.readFileSync(favicon_data_file)).favicon.html_code))
		.pipe(gulp.dest(dev));
});

/* Clean directories
*
***********************************/
gulp.task('clean:dist', [], function() {
  console.log("Clean all files in dist folder");
  return gulp.src(dist+'*', { read: false }).pipe(rimraf());
});

gulp.task('clean:favicon', [], function() {
  console.log("Clean all files in dev/img/favicon folder");
  return gulp.src(dev+'img/favicon/*', { read: false }).pipe(rimraf());
});