/**
 * Establish our gulp/node plugins for this project.
 */

var gulp        = require('gulp'),

  // Sass/Compass/related CSSy things
  sass          = require('gulp-ruby-sass'),
  autoprefixer  = require('gulp-autoprefixer'),
  minifycss     = require('gulp-minify-css'),
  sourcemaps    = require('gulp-sourcemaps'),

  // File system
  rename        = require('gulp-rename'),
  del           = require('del');

/**
 * Now, let's do things.
 */

// Styles
gulp.task('sass', function() {
	return sass(__dirname + '/wp-content/themes/responsive-wp/sass', {
		sourcemap: true,
		require: [ 'breakpoint', 'susy' ]
	})
	.on('error', sass.logError)
	.pipe(sourcemaps.init())
	.pipe(autoprefixer({
		browsers: ['last 2 versions']
	}))
	.pipe(sourcemaps.write())
    .pipe(sourcemaps.write('.', {
      includeContent: false,
      sourceRoot: 'source'
    }))
	.pipe(gulp.dest(__dirname + '/wp-content/themes/responsive-wp'))
	.pipe(rename({suffix: '.min'}))
	.pipe(minifycss())
	.pipe(gulp.dest(__dirname + '/wp-content/themes/responsive-wp'));
});

// Clean
gulp.task('clean', function() {
	del( [__dirname + '/wp-content/themes/responsive-wp/style.css', __dirname + '/wp-content/themes/responsive-wp/style.min.css'], function( err ) {
		console.log( 'CSS deleted.' );
	});
});

// Watch: watch our .scss files and do things when they change
gulp.task('watch', function() {
	gulp.watch( __dirname + '/wp-content/themes/responsive-wp/**/*.scss', ['sass'] );
});

// Default: clean & styles
gulp.task('default', ['clean'], function() {
	gulp.start('sass');
});
