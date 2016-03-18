/*
 * Gulp tasks for compiling CSS and JavaScript.
 */



// Polyfill promises

require('es6-promise').polyfill()



var autoprefixer = require('autoprefixer')
  , browserify = require('browserify')
  , browserifyShim = require('browserify-shim')
  , buffer = require('vinyl-buffer')
  , del = require('del')
  , gulp = require('gulp')
  , postcss = require('gulp-postcss')
  , sass = require('gulp-sass')
  , source = require('vinyl-source-stream')
  , uglify = require('gulp-uglify')



// Change 'themeName' if you rename your theme

var themeName = 'starter'
  , srcPath = './public/app/themes/' + themeName + '/assets'
  , trgPath = './public/app/themes/' + themeName + '/assets/build'



// Removed compiled JavaScript

gulp.task('clean:js', function () {
    return del([trgPath + '/js/**'])
})



// Compile JavaScript with Browserify

gulp.task('build:js', ['clean:js'], function () {
    return browserify(srcPath + '/js/main.js')
        .transform(browserifyShim, { global: true })
        .bundle()
        .pipe(source('main.js'))
        .pipe(buffer())
        .pipe(uglify())
        .pipe(gulp.dest(trgPath + '/js'))
})



// Remove compiled CSS

gulp.task('clean:css', function () {
    return del([trgPath + '/css/**'])
})



// Compile Sass

gulp.task('build:css', ['clean:css'], function () {
    return gulp.src(srcPath + '/css/main.scss')
        .pipe(sass({
            includePaths: './node_modules/bootstrap/scss'
          , outputStyle: 'compressed'
        }).on('error', sass.logError))
        .pipe(postcss([
            autoprefixer({
                browsers: ['last 2 versions']
            })
        ]))
        .pipe(gulp.dest(trgPath + '/css'))
})



// Main build task. Compile everything

gulp.task('build', ['build:js', 'build:css'])



// Watch assets in development

gulp.task('watch', function () {
    gulp.watch(srcPath + '/js/**', ['build:js'])
    gulp.watch(srcPath + '/css/**', ['build:css'])
})



// Default task is build

gulp.task('default', ['build'])
