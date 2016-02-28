// Project configuration
var project = 'wp-design-community',
    url = 'http://localhost/wp-design-community/',
    local_port = 5000,
    bower = './bower_components/',
    node = './node_modules/',
    dev = './',
    dist = './dist/',
    dev_basic_files = [
        dev + '*.php',
        dev + 'style.css',
        dev + 'plugins/**/*',
        dev + 'img/**/*',
        '!'+dev+'img/RAW/**/*',
        dev + 'screenshot.png'
    ],
    min_files_css = [ // CSS Archives to minimize
        dev + 'plugins/**/*.css',
        '!' + dev + 'plugins/**/*.min.css',
        bower + '*/chosen.css'
    ],
    min_files_js = [ // JS Archives to minimize
        dev + 'plugins/**/*.js',
        '!' + dev + 'plugins/**/*.min.js',
        node + '*/src/jquery-ias.js',
        node + '*/js/jquery-imagefill.js',
        bower + '*/chosen.jquery.js'
    ],
    css_minimized_files = [ // CSS Archives to copy
        node + 'flickity/*/flickity.min.css',
        node + 'medium-editor/dist/*/medium-editor.min.css',
        node + 'medium-editor/dist/css/*/flat.min.css'
    ],
    js_minimized_files = [ // JS Archives to copy
        node + '*/dist/**/*.min.js',
        node + 'imagesloaded/imagesloaded.pkgd.min.js'

    ];

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
    uglify = require('gulp-uglify'),
    rename = require('gulp-rename'),
    notify = require('gulp-notify'),
    rimraf = require('gulp-rimraf'), // Helps with removing files and directories in our run tasks
    inject = require('gulp-inject');
	//cache = require('gulp-cache'),
    //sourcemaps = require('gulp-sourcemaps'),
    //postcss = require('gulp-postcss'),
    es = require('event-stream'),
    realFavicon = require('gulp-real-favicon'),
    fs = require('fs')
    series = require('stream-series')
    replace = require('gulp-replace');

/* default
 *  
 ***********************************/
gulp.task('default', function() {

});



/* Clean /dist
 *
 ***********************************/
gulp.task('clean:dist', function() {
    console.log("Clean all files in dist folder");
    return gulp.src(dist + '*', { read: false }).pipe(rimraf());
});

/* Copy PHP && dev_basic_files to /dist 
 *  
 ***********************************/
gulp.task('copy:basicfiles:dist', ['clean:dist'], function() {
    return gulp.src(dev_basic_files, { base: dev }).pipe(gulp.dest(dist, { overwrite: true })); });

/* Copy CSS minimized from modules
 *  
 ***********************************/
gulp.task('copy:cssminimized:dev', function() {
    return gulp.src(css_minimized_files, { base: node }).pipe(gulp.dest(dev+'plugins/', { overwrite: true })); });

/* Copy JS minimized from modules
 *  
 ***********************************/
gulp.task('copy:jsminimized:dev', function() {
    return gulp.src(js_minimized_files, { base: node }).pipe(gulp.dest(dev+'plugins/', { overwrite: true })); });

/* Copy & minimize CSS from /dev && node_modules
 *  
 ***********************************/
gulp.task('min:csstominimize:dev', function() {
    return gulp.src(min_files_css)
        .pipe(rename({ suffix: '.min' }))
        .pipe(minifycss({ maxLineLen: 80 }))
        .pipe(gulp.dest(dev + 'plugins/', { overwrite: true }));
});

/* Inject CSS to header.php
 *  
 ***********************************/
gulp.task('inject:css:dev', ['min:csstominimize:dev', 'copy:cssminimized:dev'], function() {
    return gulp.src(dev + 'header.php')
        .pipe(inject(
            gulp.src([dev + 'plugins/**/*.css'], { read: false }), {
                transform: function(filepath) {
                    //  if (filepath.slice(-5) === '.docx') {
                    return '<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>' + filepath + '"/>';
                    //  }
                    // Use the default transform as fallback: 
                    //return inject.transform.apply(inject.transform, arguments);
                }
            }
        ))
        .pipe(gulp.dest(dev));
});

/* Copy & minimize JS from /dev && node_modules
 *  
 ***********************************/
gulp.task('min:jstominimize:dev', function() {
    return gulp.src(min_files_js)
        .pipe(rename({ suffix: '.min' }))
        .pipe(uglify())
        .pipe(gulp.dest(dev + 'plugins/', { overwrite: true }));
});


/* Inject JS to footer.php
 *  
 ***********************************/
gulp.task('inject:js:dev', ['min:jstominimize:dev', 'copy:jsminimized:dev'], function() {
	var firstStream = gulp.src([dev + 'plugins/**/imagesloaded.pkgd.min.js'], { read: false });
	var lastStream = gulp.src([dev + 'plugins/**/*.min.js', '!'+ dev + 'plugins/**/imagesloaded.pkgd.min.js'], { read: false });
    return gulp.src(dev + 'footer.php')
        .pipe(inject( series(firstStream, lastStream), {
                        transform: function(filepath) {
                            return '<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>' + filepath + '"></script>';
                        }
                    } ))
        .pipe(gulp.dest(dev))
        .pipe(notify({ message: 'Build dev complete', onLast: true }));
});


/* Create /dev
 *  
 ***********************************/
gulp.task('build', ['inject:js:dev', 'inject:css:dev']);



/* Create /dist
 *  
 ***********************************/
gulp.task('dist', ['copy:basicfiles:dist']);



/* Open browser && watch /dev
 *  
 ***********************************/
gulp.task('upserver', function() {
    var files = [
        dev+'*.css'
    ];
    browserSync.init(files, {
        proxy: url,
        tunnel: false
    });
});


/* Open browser && watch /dev && update extrafiles
 *  
 ***********************************/
gulp.task('server', ['upserver'], function() {
    gulp.watch(dev+'style.css', ['notify',browserSync.reload]); 
    gulp.watch(dev+'*.php', ['notify',browserSync.reload]); 
});




gulp.task('serve', ['server', 'build']);




/* Notify changes
 *  
 ***********************************/
gulp.task('notify', function() {
    return gulp.src(dev+'*.php')
        .pipe(notify({ message: 'Changes detected', onLast: true }));
});








/* Clean favicon on /dev && /dist
 *
 ***********************************/
gulp.task('clean:favicon', [], function() {
    console.log("Clean all files in dev && dist folder");
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

/* Copy favicon from /dev to /dist
 *  
 ***********************************/
gulp.task('copy:favicontodist', ['generate-favicon'], function() {
    return gulp.src([dev + 'img/favicon/**/*']).pipe(gulp.dest(dist + 'img/', { overwrite: true })); });



/* Copy favicon && Inject markup in /dev && /dist
 *  
 ***********************************/
gulp.task('favicon', ['copy:favicontodist'], function() {
    gulp.src([dev + 'header.php', dist + 'header.php'])
        .pipe(realFavicon.injectFaviconMarkups(JSON.parse(fs.readFileSync(favicon_data_file)).favicon.html_code))
        .pipe(replace('</div></body></html>', '')) // Fix to separate in two php files
        .pipe(replace('</div></body>', '')) // Fix to separate in two php files
        .pipe(gulp.dest(dev));
});