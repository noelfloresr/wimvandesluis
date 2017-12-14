var gulp = require('gulp'),
    sass = require('gulp-sass'),
    autoprefixer = require('gulp-autoprefixer'),
    concat = require('gulp-concat'),
    plumber = require('gulp-plumber'),
    rename = require('gulp-rename'),
    cssnano = require('gulp-cssnano'),
    sourcemaps = require('gulp-sourcemaps'),
    browserSync = require('browser-sync').create(),
    uglify = require('gulp-uglify');

var path = {
    srcjs: './src/js/',
    srcsass: './src/sass/',
    distjs: './dist/js/',
    distcss: './dist/css/'
};

var scripts = [
    path.srcjs + 'sofy-sharer.js',
    path.srcjs + 'slick.js',
    path.srcjs + 'main.js',
    // path.srcjs + 'team.js'
];

gulp.task('sass', function(){
    return gulp.src(path.srcsass + 'main.scss')
        .pipe(plumber())
        .pipe(sourcemaps.init({ loadMaps: true }))
        .pipe(sass().on('error', sass.logError))
        .pipe(autoprefixer({browsers: ['last 3 version', '> 5%', 'ie > 8', 'ios > 5']}))
        .pipe(gulp.dest(path.distcss))
        .pipe(rename({ suffix: '.min' }))
        .pipe(sourcemaps.write(undefined, { sourceRoot: null }))
        .pipe(cssnano())
        .pipe(gulp.dest(path.distcss))
});

gulp.task('scripts', function(){
    return gulp.src(scripts)
        .pipe(plumber())
        .pipe(concat('scripts.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest(path.distjs))
});

gulp.task('browser-sync', function(){
    browserSync.init({
        //Put the staging/local url below
        proxy: "http://wp.wimvandesluis.nl/"
    });
    gulp.watch(path.srcjs + '**/*.js', ['scripts']).on('change', browserSync.reload);;
    gulp.watch(path.srcsass + '**/*.scss', ['sass']).on('change', browserSync.reload);;
});

gulp.task('default', ['browser-sync']);