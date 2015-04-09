var gulp            = require('gulp'),
sass            = require('gulp-sass'),
autoprefixer    = require('gulp-autoprefixer'),
minifycss       = require('gulp-minify-css'),
rename          = require('gulp-rename'),
concat          = require('gulp-concat'),
notify          = require('gulp-notify'),
livereload      = require('gulp-livereload'),
lr              = require('tiny-lr'),
coffee          = require ('gulp-coffee'),
uglify          = require ('gulp-uglify'),
cache			= require('gulp-cache'),
server          = lr();

var options = {
    BOWER_SOURCE    : "app/assets/bower_resources",
    // SASS / CSS
    SASS_SOURCE     : "app/assets/sass/*.scss",
    SASS_DEST       : "public/assets/css",
    // JavaScript
    COFFEE_SOURCE   : "app/assets/coffee/*.coffee",
    COFFEE_DEST     : "public/assets/js",
    // Live reload
    LIVE_RELOAD_PORT: 35729
};

gulp.task('styles', function() {
    return gulp.src(options.SASS_SOURCE)
    .pipe(sass({
        style: 'expanded'
    }))
    .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 9', 'ios 6', 'android 4'))
    .pipe(rename({
        suffix: '.min'
    }))
    .pipe(minifycss())
    .pipe(gulp.dest(options.SASS_DEST))
    .pipe(livereload(server))
    //.pipe(notify({ message: 'Style task completed.' }))
    ;
});

gulp.task('coffee', function() {
    return gulp.src(options.COFFEE_SOURCE)
    .pipe(coffee({
        bare: true
    }))
    .pipe(gulp.dest('app/assets/js'))
    .pipe(uglify())
    .pipe(gulp.dest(options.COFFEE_DEST+'/min'));
});

gulp.task('watch', function() {
    server.listen(options.LIVE_RELOAD_PORT, function (e) {
        if (e) {
            return console.log(e)
        };

        gulp.watch( [options.COFFEE_SOURCE] , ['coffee'] );
        gulp.watch( [options.SASS_SOURCE] , ['styles']);
        gulp.watch( [options.COFFEE_DEST+'/min/*.js'], ['jsMerge']);
    });
});


//js
gulp.task('jsMerge', ['jsHeadMerge', 'jsFootMerge']);

gulp.task('jsHeadMerge', function() {
    return gulp.src([
        options.BOWER_SOURCE +'/foundation/js/vendor/jquery.js',
        options.BOWER_SOURCE +'/foundation/js/vendor/modernizr.js'
        ])
    .pipe(concat("header.js"))
    .pipe(uglify())
    .pipe(gulp.dest(options.COFFEE_DEST));
});

gulp.task('jsFootMerge', function() {
    return gulp.src([
        options.BOWER_SOURCE +'/foundation/js/foundation.min.js',        
        options.COFFEE_DEST +'/min/app.js'
         
        ])
    .pipe(concat("footer.js"))
    .pipe(uglify())
    .pipe(gulp.dest(options.COFFEE_DEST));
});