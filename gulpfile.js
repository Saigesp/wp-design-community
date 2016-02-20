// Project configuration
var project 	= 'wp-design-community', 
	url 		= 'http://localhost/wp-design-community/', // Local Development URL for BrowserSync. 
	bower 		= './bower_components/',
	node 		= './node_modules/',
	dist 		= './dist/', // Files that you want to package into a zip go here
	buildInclude 	= [
				// include common file types
				'./*.php',
				'./*.html',
				'./*.css',
				
				'./*.svg',
				'./*.ttf',
				'./*.otf',
				'./*.eot',
				'./*.woff',
				'./*.woff2',

				// include specific files and folders
				'screenshot.png',

				// exclude files and folders
				'!./node_modules/**/*',
				'!./.git/**/*',
				'!./bower_components/**/*',
				'./.gitignore',
				'./gulpfile.js',
				'./README.md',
				'./package.json',

			];

// Load plugins
var 	gulp         = require('gulp'),
		browserSync  = require('browser-sync'), // Asynchronous browser loading on .scss file changes
		reload       = browserSync.reload,
		autoprefixer = require('gulp-autoprefixer'), // Autoprefixing magic
		minifycss    = require('gulp-uglifycss'),
		filter       = require('gulp-filter'),
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
gulp.task('build',['minjs', 'mincss', 'minimg'], function(){
	gulp.src('./*.*', { read: false })
		.pipe(gulp.dest(dist, {overwrite: true}))
		.pipe(notify({ message: 'Build complete', onLast: true }));

	//buildInclude
});


/* Open browser
*  
***********************************/
gulp.task('open', function() {
  opn( 'http://localhost/wp-design-community/');
});


/* Build images
*  
***********************************/
gulp.task('minimg', function(cb) {
	var not_raw = filter(['*', '!./img/RAW']);
	gulp.src('./img/**', { read: false })
		//.pipe(not_raw)
		.pipe(gulp.dest(dist+'img/', {overwrite: true}));
});


/* Minimize JS
*  
***********************************/
gulp.task('minjs', function() {
  return gulp.src(['./js/*.js', node+'*/dist/*.min.js'])
    .pipe(uglify())
    .pipe(gulp.dest(dist+'js', {overwrite: true}));
});


/* Minimize CSS
*  
***********************************/
gulp.task('mincss', function () {
	return 	gulp.src('css/*.css')
			//.pipe(reload({stream:true}))
			.pipe(rename({ suffix: '.min' }))
			.pipe(minifycss({
				maxLineLen: 80
			}))
			.pipe(gulp.dest(dist+'css', {overwrite: true}));
			// .pipe(reload({stream:true}))
			
});




/**
 * Scripts: Vendors
 *
 * Look at src/js and concatenate those files, send them to assets/js where we then minimize the concatenated file.
*/
gulp.task('vendorsJs', function() {
	return 	    gulp.src(['./assets/js/vendor/*.js', bower+'**/*.js'])
			.pipe(concat('vendors.js'))
			.pipe(gulp.dest('./assets/js'))
			.pipe(rename( {
				basename: "vendors",
				suffix: '.min'
			}))
			.pipe(uglify())
			.pipe(gulp.dest('./assets/js/'));
});


/**
 * Scripts: Custom
 *
 * Look at src/js and concatenate those files, send them to assets/js where we then minimize the concatenated file.
*/

gulp.task('scriptsJs', function() {
	return 	    gulp.src('./assets/js/custom/*.js')
			.pipe(concat('custom.js'))
			.pipe(gulp.dest('./assets/js'))
			.pipe(rename( {
				basename: "custom",
				suffix: '.min'
			}))
			.pipe(uglify())
			.pipe(gulp.dest('./assets/js/'));
});