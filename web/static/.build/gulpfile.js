/*********************************
 * Requires
 *********************************/

const path = require('path'),
    autoprefixer = require('autoprefixer'),
    gulp = require('gulp'),
    notify = require('gulp-notify'),
    plumber = require('gulp-plumber'),
    sass = require('gulp-sass'),
    sourcemaps = require('gulp-sourcemaps'),
    rename = require('gulp-rename'),
    cssnano = require('cssnano'),
    nunjucksRender = require('gulp-nunjucks-render'),

    // webpack
    webpack = require('webpack'),
    webpackStream = require('webpack-stream'),
    webpackConf = require('./webpack.config.js'),
    named = require('vinyl-named'),
    critical = require('critical').stream,

    // postcss
    postcss = require('gulp-postcss'),
    inlineSvg = require('postcss-inline-svg'),
    dataPacker = require('postcss-data-packer'),
    objectFitImages = require('postcss-object-fit-images'),
    mergeRules = require('postcss-merge-rules'),
    combineMediaQueries = require('postcss-combine-media-query')


    // browsersync
    browserSync = require('browser-sync').create();

const { series, parallel } = require('gulp');

/*********************************
 * Config
 *********************************/

const rootPath = '../',
    conf = {
        autoprefixer: ["last 2 versions", "> 1%"],
        webserver: {
            port: 8000,
            root: rootPath,
            proxy: 'https://conecto.dev',
            certs: {
                key: rootPath + ".build/certs/localhost.key",
                cert: rootPath + ".build/certs/localhost.crt"
            }
        },
        paths: (function () {
            return {
                root: rootPath,
                scss: rootPath + '.build/_scss/',
                css: rootPath + 'css/',
                modules: rootPath + '.build/_js/',
                js: rootPath + 'js/',
                njk: rootPath + '.build/_njk/',
                twig: rootPath + '.build/_twig/',
                images: rootPath + 'images/',
                icons: rootPath + '.build/_images/svg/'
            }
        })(),
        notify: {
            sound: false,
            soundOnError: true,
            icons: (function () {
                const notifyIconPath = 'resources/';
                return {
                    cancel: notifyIconPath + 'cancel.png',
                    error: notifyIconPath + 'error.png',
                    hint: notifyIconPath + 'hint.png',
                    question: notifyIconPath + 'question.png',
                    success: notifyIconPath + 'success.png',
                    warning: notifyIconPath + 'warning.png'
                }
            })()
        }
    },
    taskConf = {
        html: {
            pathPattern: [
                conf.paths.njk + '**/*.+(html|nunjucks|njk)',
                '!' + conf.paths.njk + '*/**/*'
            ],
            pathPatternServe: conf.paths.njk + '**/*.+(html|nunjucks|njk)',
            nunjucksRender: {}
        },
        scss: {
            pathPattern: conf.paths.scss + '**/*.scss',
            sourcemaps: {
                path: '../maps'
            },
            postCSS: {
                pre: [
                    inlineSvg({path: conf.paths.images}),
                    objectFitImages()
                ],
                pack: [
                    dataPacker({
                        dest: {
                            path: function (opts) {
                                return conf.paths.css + path.basename(opts.from, '.css') + '.data.css';
                            }
                        }
                    })
                ],
                post: [
                    cssnano({
                        preset: ['advanced', {
                            discardUnused: false, // deactivated because potentially unsafe
                            mergeIdents: false, // deactivated because potentially unsafe
                            reduceIdents: false, // deactivated because potentially unsafe
                            zindex: false, // deactivated because potentially unsafe
                           /* autoprefixer: {
                                add: true,
                                browsers: conf.autoprefixer
                            }*/
                        }]
                    }),
                    autoprefixer(),
                    mergeRules(),
                    combineMediaQueries(),

                ]
            }
        },
        js: {
            pathPattern: conf.paths.modules + '**/*.js',
            pathPatternMain: conf.paths.modules + 'main.js',
            sourcemaps: {
                path: '../maps'
            },
        },
    };

/*********************************
 * Common functions
 *********************************/

// success message
const onSuccess = (title, message) => {
    var title = title || 'Info',
        message = message || 'Dateien verarbeitet';
    return notify({
        appID: 'gulpfile.js',
        onLast: true,
        title: title,
        message: message,
        sound: conf.notify.sound,
        icon: conf.notify.icons.success
    });
};

// error message
const onError = (error, title, that) => {
    var that = that || this,
        title = title || 'Fehler';
    notify.onError({
        title: title,
        message: '<%= error.message %>',
        sound: conf.notify.soundOnError,
        icon: conf.notify.icons.error
    })(error);
    that.emit('end');
};

/*********************************
 * Tasks
 *********************************/

// HTML Task
const html = () => {
    return gulp.src(taskConf.html.pathPattern)
        // error handling
        .pipe(plumber({ errorHandler:
            function(err) { onError(err, "HTML Error", this); }
        }))
        .pipe(nunjucksRender({
            path: [conf.paths.njk],
            ext: '.html'
        }))
        // output files in app folder
        .pipe(gulp.dest(conf.paths.root))
        .pipe(onSuccess('HTML', 'Files written'));
};

// SASS-Production Task
const scss = () => {
    return gulp.src(taskConf.scss.pathPattern)
        // error handling
        .pipe(plumber({ errorHandler:
                function(err) { onError(err, "SCSS Error", this); }
        }))
        .pipe(sourcemaps.init())
        .pipe(sass.sync())
        .pipe(postcss(taskConf.scss.postCSS.pre)) // inline-svg, object-fit polyfill
        .pipe(postcss(taskConf.scss.postCSS.pack)) //
        .pipe(gulp.dest(conf.paths.css)) // write unminified files
        .pipe(postcss(taskConf.scss.postCSS.post)) // postCSS minify, autoprefix (???), media query packer
        .pipe(rename({ extname: '.min.css' }))
        .pipe(sourcemaps.write(taskConf.scss.sourcemaps.path))
        .pipe(gulp.dest(conf.paths.css)) // write minified files
        .pipe(browserSync.stream({match: '**/*.css'}))
        .pipe(onSuccess('SCSS', 'Files done'));
};


// Main JS Task
const mainJs = () => {
    return gulp.src(taskConf.js.pathPatternMain)
    //return gulp.src(taskConf.js.pathPattern)
        // error handling
        .pipe(plumber({ errorHandler:
                function(err) { onError(err, "JS Error", this); }
        }))
        .pipe(named())
        .pipe(webpackStream(webpackConf), webpack)
        .pipe(gulp.dest(conf.paths.js))
        .pipe(onSuccess('JS', 'Modules done'));
};

const js = gulp.series(mainJs);

// Browser Reload Task for full page reload
const browserReload = done => {
    browserSync.reload();
    done();
};

// Serve/BrowserSync Task
const serve = () => {
    browserSync.init({
        server: conf.webserver.root,
        port: conf.webserver.port,
        //proxy: conf.webserver.proxy, // use either 'server' or 'proxy'
        https: {
            key: conf.webserver.certs.key,
            cert: conf.webserver.certs.cert
        }
    });

    gulp.watch(taskConf.scss.pathPattern, gulp.series('scss'));
    gulp.watch(taskConf.js.pathPattern, gulp.series(mainJs, 'browserReload'));
    gulp.watch(taskConf.html.pathPatternServe, gulp.series('html', 'browserReload'));
};

// Build Task
const build = gulp.series(scss, js, html);

exports.browserReload = browserReload;
exports.html = html;
exports.scss = scss;
exports.js = js;
exports.serve = serve;
exports.build = build;

exports.default = serve;