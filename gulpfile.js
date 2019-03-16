const gulp = require('gulp');
const browserSync = require('browser-sync');
const sass = require('gulp-sass');
const prefix = require('gulp-autoprefixer');
const cp = require('child_process');
const sourcemaps = require('gulp-sourcemaps');

const server = browserSync.create();

const dev_url = "localhost:8888/wordpress"

sass.compiler = require('node-sass');

// BrowserSync
function browser_sync(done) {
  browserSync.init(files, {
    server: {
      proxy: dev_url,
      port: 8888,
      injectChanges: true
    }
  });
  done();
}

function browserSyncReload(done) {
  browsersync.reload();
  done();
}


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
// gulp.task('sass', function() {
//   return gulp.src('_sass/main.scss')
//     .pipe(sass({
//       onError: browserSync.notify,
//       outputStyle: 'compressed'
//     }))
//     .pipe(gulp.dest('stylesheets'))
//     .pipe(prefix(['last 15 versions', '> 1%', 'ie 8', 'ie 7'], { cascade: true }))
//     .pipe(browserSync.reload({stream:true}))
//     .pipe(gulp.dest('stylesheets'));
// });
gulp.task('sass', function() {
  return gulp.src('./_sass/main.scss')
    .pipe(sass({
      outputStyle: 'compressed',
    }).on('error', sass.logError))
    .pipe(prefix({
      browsers: ['last 2 versions'],
      cascade: false
    }))
    .pipe(gulp.dest('./stylesheets'))
    .pipe(browsersync.stream());
});

gulp.task('watch', function() {
  gulp.watch('_sass/**.scss', gulp.series('sass'));
});

gulp.task('default', gulp.series('browser-sync', 'watch'));