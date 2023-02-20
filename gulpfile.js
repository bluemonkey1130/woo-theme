// https://github.com/thecodercoder/frontend-boilerplate/blob/master/gulpfile.js
// Importing specific gulp API functions lets us write them below as series() instead of gulp.series()
const {gulp, series, watch, src, dest, parallel} = require("gulp")
/******** Import Gulp plugins.*********/
const autoprefixer = require('autoprefixer');
const babel = require("gulp-babel")
const cleanCSS = require('gulp-clean-css');
const concat = require('gulp-concat');
const cssnano = require('cssnano');
const notify = require('gulp-notify');
const plumber = require("gulp-plumber")
const postcss = require('gulp-postcss');
const rename = require('gulp-rename');
const replace = require('gulp-replace');
const sass = require('gulp-dart-sass');
const sourcemaps = require('gulp-sourcemaps');
const uglify = require('gulp-uglify');
const mysqlDump = require('mysqldump');

/******** Error Reporting  *********/
let onError = function (err) {
    notify.onError({
        title: "Gulp",
        subtitle: "Failure!",
        message: "Error: <%= error.message %>",
        sound: "Basso"
    })(err);
    this.emit('end');
};

/******** Directory Mapping *********/
const dirs = {
    src: 'assets',
    dest: 'assets'
};
const sassPath = {
    src: `${dirs.src}/scss/global.scss`,
    dest: `${dirs.dest}`
}
const jsPath = {
    src: `${dirs.src}/js/_components/*.js`,
    dest: `${dirs.dest}`
};

/******** JavaScript Tasks *********/
function jsDeps(done) {
    const files = [
        "node_modules/jquery/dist/jquery.js",
        "node_modules/jquery-ui/dist/jquery-ui.js",
        "node_modules/slick-carousel/slick/slick.min.js",
        "node_modules/modal-video/js/jquery-modal-video.js",
        "./assets/JS/_vendor/jquery.ihavecookies.min.js",
        "./assets/JS/_vendor/jquery.magnific-popup.js",
        "./assets/JS/_vendor/gsap.min.js",
        "./assets/JS/_vendor/ScrollToPlugin.min.js",
        "./assets/JS/_vendor/ScrollTrigger.min.js",
    ]
    return (
        src(files)
            .pipe(plumber({errorHandler: onError}))
            .pipe(concat("main.deps.js"))
            .pipe(dest("./tmp"))
    )
}

function jsBuild(done) {
    return (
        src(jsPath.src)
            .pipe(plumber({errorHandler: onError}))
            .pipe(concat("main.build.js"))
            .pipe(babel({presets: [["@babel/env", {modules: false}]]}))
            .pipe(dest("./tmp"))
    )
}

function jsConcat(done) {
    const files = ["./tmp/main.deps.js", "./tmp/main.build.js"]
    return (
        src(files)
            .pipe(plumber({errorHandler: onError}))
            .pipe(concat("scripts.min.js"))
            // .pipe(uglify())
            .pipe(dest(jsPath.dest))
    )
}

exports.js = series(jsDeps, jsBuild, jsConcat)
exports.jsbuild = jsBuild

/******** SCSS Tasks *********/

sass.compiler = require('sass');
function scssTask() {
    return src(sassPath.src)
        .pipe(plumber({errorHandler: onError}))
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(postcss([autoprefixer()]))
        // .pipe(postcss([ autoprefixer(), cssnano() ]))
        .pipe(rename('index.css'))
        .pipe(sourcemaps.write('.'))
        .pipe(dest(sassPath.dest))
}

exports.scss = scssTask


function scssWooTask() {
    return src('assets/scss/_woocommerce/index.scss')
        .pipe(plumber({errorHandler: onError}))
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(postcss([autoprefixer()]))
        // .pipe(postcss([ autoprefixer(), cssnano() ]))
        .pipe(rename('woo.css'))
        .pipe(sourcemaps.write('.'))
        .pipe(dest(sassPath.dest))
}

exports.scssWooTask = scssWooTask

function scssProd() {
    return src(sassPath.src)
        .pipe(plumber({errorHandler: onError}))
        .pipe(sass().on('error', sass.logError))
        .pipe(postcss([autoprefixer()]))
        .pipe(cleanCSS({compatibility: 'ie8'}))
        .pipe(rename('index.css'))
        .pipe(dest(sassPath.dest))
}

exports.scssProd = scssProd

/******** Watch Tasks *********/
function watchStylesTask() {
    watch('assets/SCSS/**/*.scss',
        // series([scssTask]));
        series([scssProd]));
}

exports.watchStyles = watchStylesTask

function watchWooStylesTask() {
    watch('assets/SCSS/_woocommerce/*.scss',
        series([scssWooTask]));
}

exports.watchWooStylesTask = watchWooStylesTask

function watchScriptsTask() {
    watch('assets/JS/_components/*.js',
        series(jsDeps, jsBuild, jsConcat),
    )
}

exports.watchScripts = watchScriptsTask

/******** Database Dump Task *********/
function dumpDatabaseTask() {
    return new Promise(function (resolve, reject) {
        mysqlDump({
            connection: {
                host: '127.0.0.1',
                user: 'root',
                password: '',
                database: 'craft_grid',
            },
            dumpToFile: './storage/dump.sql',
        });
        resolve();
    });
};

exports.dumpDatabase = dumpDatabaseTask

/******** Default Task *********/
exports.default = series(
    parallel(scssTask, series(jsDeps, jsBuild, jsConcat)),
    parallel(watchStylesTask, watchScriptsTask)
);
