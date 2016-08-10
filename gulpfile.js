var gulp        = require('gulp');
var browserSync = require('browser-sync');
var sass        = require('gulp-sass');
var prefix      = require('gulp-autoprefixer');
var cp          = require('child_process');
var sourcemaps  = require('gulp-sourcemaps');


var dev_url     = "localhost:8888/wordpress"

/**
 * Browser sync for WP theme
 */
gulp.task('browser-sync', function() {
  var files = [
    '**/*.php',
    '**/*.{png,jpg,gif}',
    '**/**/*.css'
  ];

  browserSync.init(files, {
    // Read here http://www.browsersync.io/docs/options/
    proxy: dev_url,
    port: 8888,
    injectChanges: true
  });
});


/**
 * Compile files from _scss into css (for live injecting)
 */
gulp.task('sass', function() {
  return gulp.src('_sass/main.scss')
    .pipe(sass({
      onError: browserSync.notify,
      outputStyle: 'compressed'
    }))
    .pipe(gulp.dest('stylesheets'))
    .pipe(prefix(['last 15 versions', '> 1%', 'ie 8', 'ie 7'], { cascade: true }))
    .pipe(browserSync.reload({stream:true}))
    .pipe(gulp.dest('stylesheets'));
});

gulp.task('watch', function() {
  gulp.watch('_sass/*.scss', ['sass']);
});

gulp.task('default', ['browser-sync', 'watch']);
