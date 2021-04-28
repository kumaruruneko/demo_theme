// Load plugins
const autoprefixer = require("gulp-autoprefixer");
const browsersync = require("browser-sync").create();
const cleanCSS = require("gulp-clean-css");
const gulp = require("gulp");
const header = require("gulp-header");
const plumber = require("gulp-plumber");
const rename = require("gulp-rename");
const sass = require("gulp-sass");
const sourcemaps = require("gulp-sourcemaps");
const uglify = require("gulp-uglify");



// Copy third party libraries from /node_modules into /vendor
gulp.task('vendor', function (cb) {

  // Bootstrap
  gulp.src([
    './src/build/node_modules/bootstrap/dist/**/*',
    '!./src/build/node_modules/bootstrap/dist/css/bootstrap-grid*',
    '!./src/build/node_modules/bootstrap/dist/css/bootstrap-reboot*'
  ])
    .pipe(gulp.dest('./src/build/vendor/bootstrap'))

  // Font Awesome
  gulp.src([
    './src/build/node_modules/@fortawesome/**/*',
  ])
    .pipe(gulp.dest('./build/vendor'))

  // jQuery
  gulp.src([
    './src/build/node_modules/jquery/dist/*',
    '!./src/build/node_modules/jquery/dist/core.js'
  ])
    .pipe(gulp.dest('./src/build/vendor/jquery'))

  // jQuery Easing
  gulp.src([
    './src/build/node_modules/jquery.easing/*.js'
  ])
    .pipe(gulp.dest('./src/build/vendor/jquery-easing'))

  // Magnific Popup
  gulp.src([
    './src/build/node_modules/magnific-popup/dist/*'
  ])
    .pipe(gulp.dest('./src/build/vendor/magnific-popup'))

  cb();

});

// CSS task
function css() {
  return gulp
    .src("./scss/*.scss")
    .pipe(plumber())
    .pipe(sourcemaps.init())
    .pipe(sass({
      outputStyle: "expanded"
    }))
    .on("error", sass.logError)
    .pipe(autoprefixer({
      browsers: ['last 2 versions'],
      cascade: false
    }))
    .pipe(gulp.dest("../src/css"))
    // .pipe(rename({
    //   suffix: ".min"
    // }))
    .pipe(cleanCSS())
    .pipe(sourcemaps.write("./"))
    .pipe(gulp.dest("../src/css"))
    .pipe(browsersync.stream());
}

// JS task
function js() {
  return gulp
    .src([
      './js/*.js',
      '!./js/*.min.js'
    ])
    .pipe(uglify())
    .pipe(rename({
      suffix: '.min'
    }))
    .pipe(gulp.dest('../src/js'))
    .pipe(browsersync.stream());
}

// Tasks
gulp.task("css", css);
gulp.task("js", js);

// BrowserSync
function browserSync(done) {
  browsersync.init({
    proxy: "http://customtemplate-clone.local/"
  });
  done();
}

// BrowserSync Reload
function browserSyncReload(done) {
  browsersync.reload();
  done();
}

// Watch files
function watchFiles() {
  gulp.watch("./scss/**/*", css);
  gulp.watch(["./build/js/**/*.js", "!./js/*.min.js"], js);
  gulp.watch("../**/*.php", browserSyncReload);
  gulp.watch("../page/**/*.php", browserSyncReload);
}

gulp.task("dev", gulp.parallel('vendor', css, js));

// dev task
gulp.task("default", gulp.parallel(watchFiles, browserSync));
