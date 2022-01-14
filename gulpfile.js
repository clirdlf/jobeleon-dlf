const gulp = require('gulp');
const browserSync = require('browser-sync').create();
// const sass = require('gulp-sass');
const prefix = require('gulp-autoprefixer');

const sass = require('gulp-sass')(require('sass'));

const dev_url = "localhost:8888/jobs"


function style() {
  return gulp.src('_sass/**/*.scss')
  .pipe(sass({
    // outputStyle: 'compressed',
    outputStyle: 'expanded',
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
  gulp.watch('**/*/*.php').on('change',browserSync.reload);
  gulp.watch('js/**/*.js').on('change', browserSync.reload);
}
exports.style = style;
exports.watch = watch;












// // const cp = require('child_process');
// // const sourcemaps = require('gulp-sourcemaps');

// // https://www.npmjs.com/package/gulp-sass
// const sass = require('gulp-sass')(require('sass'));

// const server = browserSync.create();
// const dev_url = "localhost:8888/jobs2"

// // sass.compiler = require('dart-sass');

// // BrowserSync
// function browser_sync(done) {
//   browserSync.init(files, {
//     server: {
//       proxy: dev_url,
//       port: 8888,
//       injectChanges: true
//     }
//   });
//   done();
// }

// function browserSyncReload(done) {
//   browserSync.reload();
//   done();
// }

// /**
//  * Browser sync for WP theme
//  */
// gulp.task('browser-sync',  function() {
//   // var files = [
//   //   '**/*.php',
//   //   '**/*.{png,jpg,gif}',
//   //   '**/**/*.css'
//   // ];

//   browserSync.init(files, {
//     // Read here http://www.browsersync.io/docs/options/
//     proxy: dev_url,
//     port: 8888,
//     injectChanges: true
//   });
// });

// function style() {
//   return gulp.src('./_sass/**/*.scss')
//     .pipe(sass({
//       // outputStyle: 'compressed',
//       outputStyle: 'expanded',
//     }).on('error', sass.logError))
//     .pipe(gulp.dest('./stylesheets'))
//     .pipe(browserSync.stream());
// }

// function watch() {
//   browserSync.init({
//     proxy: dev_url,
//     port: 8888,
//     injectChanges: true
//   });

//   gulp.watch('./_sass/**/*.scss', style);
//   gulp.watch('**/*.{png,jpg,gifphp}', browserSyncReload);

// }


// /**
//  * Compile files from _scss into css (for live injecting)
//  */
// // gulp.task('sass', function() {
// //   return gulp.src('./_sass/**/*.scss')
// //     .pipe(sass({
// //       // outputStyle: 'compressed',
// //       outputStyle: 'expanded',
// //     }).on('error', sass.logError))
// //     .pipe(gulp.dest('./stylesheets'))
// //     .pipe(browserSync.stream());
// // });

// // gulp.task('watch', function() {
// //   // gulp.watch('_sass/**/*.scss', gulp.series('sass'));
// //   gulp.watch('_sass/**/*.scss', sass);
// //   gulp.watch('**/*.php', browserSync.reload);
// //   gulp.watch('**/*.js').on('change', browserSync.reload);
// // });

// // gulp.task('default', gulp.series('browser-sync', 'watch'));

// exports.style = style;
// exports.watch = watch;