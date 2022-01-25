const gulp = require('gulp');
const browserSync = require('browser-sync').create();
const prefix = require('gulp-autoprefixer');

const sass = require('gulp-sass')(require('sass'));

const dev_url = "localhost:8888/jobs2"


function style() {
  return gulp.src('_sass/**/*.scss')
  .pipe(sass({
    outputStyle: 'compressed',
    // outputStyle: 'expanded',
  }).on('error', sass.logError))
  .pipe(gulp.dest('./stylesheets'))
  .pipe(browserSync.stream());
}

function watch() {
  browserSync.init( {
    // Read here http://www.browsersync.io/docs/options/
    proxy: dev_url,
    port: 8888,
    injectChanges: true
  });
  gulp.watch('**/*.scss', style)
  gulp.watch('**/**/*.php').on('change',browserSync.reload);
  gulp.watch('js/**/*.js').on('change', browserSync.reload);
}
exports.style = style;
exports.watch = watch;
