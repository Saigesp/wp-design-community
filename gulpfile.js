// Project configuration
var project = 'wp-design-community',
    url = 'http://localhost/wp-design-community/',
    local_port = 5000,
    bower = './bower_components/',
    node = './node_modules/',
    dev = './dev/',
    dist = './dist/',
    wamp = 'C:/wamp/www/wp-design-community/wp-content/themes/wp-design-community/',
    dev_basic_files = [
        dev + '*.php',
        dev + 'plugins/**/*',
        '!' + dev + 'plugins/**/*.css',
        '!' + dev + 'plugins/**/*.js',
        dev + 'screenshot.png',
    ],
    min_files_css = [ // CSS Archives to minimize
        dev + 'plugins/**/*.css',
        '!' + dev + 'plugins/**/*.min.css'
    ],
    min_files_js = [ // JS Archives to minimize
        dev + 'plugins/**/*.js',
        '!' + dev + 'plugins/**/*.min.js',
        node + '*/src/jquery-ias.js',
        node + '*/js/jquery-imagefill.js'
    ],
    node_files_css = [ // CSS Archives to copy
        node + '*/dist/**/*.min.css',
    ],
    node_files_js = [ // JS Archives to copy
        node + '*/dist/**/*.min.js',
        node + 'imagesloaded/imagesloaded.pkgd.min.js'

    ];

var wamp_inject_path_slice = wamp.length + 3; //Change it to adjust the url of injected scripts
var dist_inject_path_slice = dist.length - 2;
var favicon_data_file = dev + 'faviconData.json';
var favicon_master_img = dev + 'img/favicon.png';
var favicon_output_path = dev + 'img/favicon/';
var favicon_icon_path = '<?php echo get_stylesheet_directory_uri(); ?>/img/favicon/'; //Prepared to wordpress

// Load plugins
var gulp = require('gulp'),
    browserSync = require('browser-sync'), // Asynchronous browser loading on .scss file changes
    reload = browserSync.reload,
    autoprefixer = require('gulp-autoprefixer'), // Autoprefixing magic
    minifycss = require('gulp-uglifycss'),
    gulpFilter = require('gulp-filter'),
    uglify = require('gulp-uglify'),
    imagemin = require('gulp-imagemin'),
    newer = require('gulp-newer'),
    rename = require('gulp-rename'),
    concat = require('gulp-concat'),
    notify = require('gulp-notify'),
    cmq = require('gulp-combine-media-queries'),
    runSequence = require('run-sequence'),
    plugins = require('gulp-load-plugins')({ camelize: true }),
    ignore = require('gulp-ignore'), // Helps with ignoring files and directories in our run tasks
    rimraf = require('gulp-rimraf'), // Helps with removing files and directories in our run tasks
    zip = require('gulp-zip'), // Using to zip up our packaged theme into a tasty zip file that can be installed in WordPress!
    plumber = require('gulp-plumber'), // Helps prevent stream crashing on errors
    inject = require('gulp-inject');
	cache = require('gulp-cache'),
    sourcemaps = require('gulp-sourcemaps'),
    postcss = require('gulp-postcss'),
    mqpacker = require('css-mqpacker'),
    csswring = require('csswring'),
    del = require('del'),
    es = require('event-stream'),
    realFavicon = require('gulp-real-favicon'),
    fs = require('fs')
    series = require('stream-series')
    replace = require('gulp-replace');

/* default
 *  
 ***********************************/
gulp.task('default', function() {
    // place code for your default task here
});



/* Clean /dist
 *
 ***********************************/
gulp.task('clean:dist', function() {
    console.log("Clean all files in dist folder");
    return gulp.src(dist + '*', { read: false }).pipe(rimraf());
});

/* Copy PHP && dev_basic_files from /dev 
 *  
 ***********************************/
gulp.task('copy:phptodist', ['clean:dist'], function() {
    return gulp.src(dev_basic_files, { base: dev }).pipe(gulp.dest(dist, { overwrite: true })); });
gulp.task('copy:phptowamp', function() {
    return gulp.src(dev_basic_files, { base: dev }).pipe(gulp.dest(wamp, { overwrite: true })); });

/* Copy CSS from node_modules
 *  
 ***********************************/
gulp.task('copy:nodecsstodist', function() {
    return gulp.src(node_files_css, { base: node }).pipe(gulp.dest(dist+'plugins/', { overwrite: true })); });
gulp.task('copy:nodecsstowamp', function() {
    return gulp.src(node_files_css, { base: node }).pipe(gulp.dest(wamp+'plugins/', { overwrite: true })); });

/* Copy JS from node_modules
 *  
 ***********************************/
gulp.task('copy:nodejstodist', function() {
    return gulp.src(node_files_js, { base: node }).pipe(gulp.dest(dist+'plugins', { overwrite: true })); });
gulp.task('copy:nodejstowamp', function() {
    return gulp.src(node_files_js, { base: node }).pipe(gulp.dest(wamp+'plugins', { overwrite: true })); });

/* Copy images from /dev
 *  
 ***********************************/
gulp.task('copy:imgtodist', function() {
    return gulp.src([dev + 'img/**/*', '!'+dev+'img/RAW/**/*']).pipe(gulp.dest(dist + 'img/', { overwrite: true })); });
gulp.task('copy:imgtowamp', function() {
    return gulp.src([dev + 'img/**/*', '!'+dev+'img/RAW/**/*']).pipe(gulp.dest(wamp + 'img/', { overwrite: true })); });





/* Copy & minimize CSS from /dev && node_modules
 *  
 ***********************************/
gulp.task('min:csstodist', ['copy:phptodist'], function() {
    return gulp.src(min_files_css)
        .pipe(rename({ suffix: '.min' }))
        .pipe(minifycss({ maxLineLen: 80 }))
        //.pipe(rename({dirname: ''}))
        .pipe(gulp.dest(dist + 'plugins/', { overwrite: true }));
});

gulp.task('min:csstowamp', ['copy:phptowamp'], function() {
    return gulp.src(min_files_css)
        .pipe(rename({ suffix: '.min' }))
        .pipe(minifycss({ maxLineLen: 80 }))
        .pipe(gulp.dest(wamp + 'plugins/', { overwrite: true }));
});


var vendorStream = gulp.src(['./src/vendors/*.js'], {read: false});
 
var appStream = gulp.src(['./src/app/*.js'], {read: false});
 
gulp.src('./src/index.html')
  .pipe(inject(series(vendorStream, appStream))) // This will always inject vendor files before app files 
  .pipe(gulp.dest('./dist'));




/* Inject CSS from /dist || /wamp to header.php
 *  
 ***********************************/
gulp.task('inject:cssondist', ['min:csstodist', 'copy:nodecsstodist'], function() {
    return gulp.src(dist + 'header.php')
        .pipe(inject(
            gulp.src([dist + 'plugins/**/*.css'], { read: false }), {
                transform: function(filepath) {
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

gulp.task('inject:cssonwamp', ['min:csstowamp', 'copy:nodecsstowamp'], function() {
    return gulp.src(wamp + 'header.php')
        .pipe(inject(
            gulp.src([wamp + 'plugins/**/*.css'], { read: false }), {
                transform: function(filepath) {
                    return '<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>' + filepath.slice(wamp_inject_path_slice) + '"/>';
                }
            }
        ))
        .pipe(gulp.dest(wamp));
});


/* Copy & minimize JS from /dev && node_modules
 *  
 ***********************************/
gulp.task('min:jstodist', ['inject:cssondist'], function() {
    return gulp.src(min_files_js)
        .pipe(rename({ suffix: '.min' }))
        .pipe(uglify())
        .pipe(gulp.dest(dist + 'plugins/', { overwrite: true }));
});

gulp.task('min:jstowamp', ['inject:cssonwamp'], function() {
    return gulp.src(min_files_js)
        .pipe(rename({ suffix: '.min' }))
        .pipe(uglify())
        .pipe(gulp.dest(wamp + 'plugins/', { overwrite: true }));
});


/* Inject CSS from /dist || /wamp to footer.php
 *  
 ***********************************/
gulp.task('inject:jsondist', ['min:jstodist', 'copy:nodejstodist'], function() {
	var firstStream = gulp.src([dist + 'plugins/**/jquery.min.js'], { read: false });
	var lastStream = gulp.src([dist + 'plugins/**/*.js', '!'+ dist + 'plugins/**/jquery.min.js'], { read: false });
    return gulp.src(dist + 'footer.php')
        .pipe(inject( series(firstStream, lastStream), {
                        transform: function(filepath) {
                            return '<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>' + filepath.slice(dist_inject_path_slice) + '"></script>';
                        }
                    } ))
        .pipe(gulp.dest(dist));
});

gulp.task('inject:jsonwamp', ['min:jstowamp', 'copy:nodejstowamp'], function() {
	var firstStream = gulp.src([wamp + 'plugins/**/jquery.min.js'], { read: false });
	var lastStream = gulp.src([wamp + 'plugins/**/*.js', '!'+ wamp + 'plugins/**/jquery.min.js'], { read: false });
    return gulp.src(wamp + 'footer.php')
        .pipe(inject( series(firstStream, lastStream), {
                        transform: function(filepath) {
                            return '<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>' + filepath.slice(wamp_inject_path_slice) + '"></script>';
                        }
                    } ))
        .pipe(gulp.dest(wamp));
});

/* Copy dev/style.css to /wamp
 *
 ***********************************/
gulp.task('copy:styletowamp', function() {
    return gulp.src(dev + 'style.css', { base: dev })
        .pipe(gulp.dest(wamp, { overwrite: true }));
});

/* Copy PHP files from /dev to /wamp
 *
 ***********************************/
gulp.task('copy:phptowamp', function() {
    return gulp.src(dev + '*.php', { base: dev })
        .pipe(gulp.dest(wamp, { overwrite: true }));
});


/* Create /dist && /wamp
 *  
 ***********************************/
gulp.task('build:dist', ['inject:jsondist', 'copy:imgtodist']);
gulp.task('build:wamp', ['inject:jsonwamp', 'copy:imgtowamp', 'copy:styletowamp']);


/* Create /wamp && open browser && watch /dev
 *  
 ***********************************/
gulp.task('server:build', ['build:wamp'], function() {
    var files = [
        dev+'**/*.php',
        dev+'**/*.js',
        dev+'**/*.{png,jpg,gif}'
    ];
    browserSync.init(files, {
        proxy: url,
        tunnel: true,
        injectChanges: true
    });
});


/* Open browser && watch /dev
 *  
 ***********************************/
gulp.task('server:up', function() {
    var files = [
        dev+'**/*.php',
        dev+'**/*.js',
        dev+'**/*.{png,jpg,gif}'
    ];
    browserSync.init(files, {
        proxy: url,
        tunnel: true,
        injectChanges: true

    });
});


/* Create /wamp && open browser && watch /dev && update extrafiles
 *  
 ***********************************/
gulp.task('server', ['server:build'], function() {
    gulp.watch(dev+'style.css', ['copy:styletowamp']); 
});


/* Clean favicon on /dev && /dist
 *
 ***********************************/
gulp.task('clean:favicon', [], function() {
    console.log("Clean all files in dev/img/favicon folder");
    return gulp.src([dev + 'img/favicon/**/*', dist + 'img/favicon/**/*'], { read: false }).pipe(rimraf());
});



/* Create favicon on /dev
 *  
 ***********************************/
gulp.task('generate-favicon', ['clean:favicon'], function(done) {
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

/* Copy favicon from /dev to /dist || /wamp
 *  
 ***********************************/
gulp.task('copy:favicontodist', ['generate-favicon'], function() {
    return gulp.src([dev + 'img/favicon/**/*']).pipe(gulp.dest(dist + 'img/', { overwrite: true })); });
gulp.task('copy:favicontowamp', ['copy:favicontodist'], function() {
    return gulp.src([dev + 'img/favicon/*']).pipe(gulp.dest(wamp + 'img/', { overwrite: true })); });



/* Copy favicon && Inject markup in /dev && /dist && /wamp
 *  
 ***********************************/
gulp.task('build:favicon', ['copy:favicontodist', 'copy:favicontowamp'], function() {
    gulp.src([dev + 'header.php', dist + 'header.php', wamp + 'header.php'])
        .pipe(realFavicon.injectFaviconMarkups(JSON.parse(fs.readFileSync(favicon_data_file)).favicon.html_code))
        .pipe(replace('</div></body></html>', '')) // Fix to separate in two php files
        .pipe(gulp.dest(dev));
});


/* Copy favicon && Inject markup in /dev && /dist && /wamp
 *  
 ***********************************/
gulp.task('favicon', ['generate-favicon'], function() {
    gulp.src(dev + 'header.php')
        .pipe(realFavicon.injectFaviconMarkups(JSON.parse(fs.readFileSync(favicon_data_file)).favicon.html_code))
        .pipe(replace('</div></body></html>', '')) // Fix to separate in two php files
        .pipe(gulp.dest(dev));
});