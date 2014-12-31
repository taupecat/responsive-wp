/**
 * Establish our gulp/node plugins for this project.
 */

var gulp			= require('gulp'),

	// Sass/Compass/related CSSy things
	sass			= require('gulp-ruby-sass'),
	autoprefixer	= require('gulp-autoprefixer'),
	minifycss		= require('gulp-minify-css'),
	sourcemaps		= require('gulp-sourcemaps'),

	// File system
	concat			= require('gulp-concat'),
	rename			= require('gulp-rename'),
	del				= require('del'),

	// Notifications and error handling
	gutil			= require('gulp-util');


/**
 * Set our source and destination variables
 */

var project			= 'responsive-wp',
	theme_dir		= __dirname + '/wp-content/themes/' + project,
	sass_dir		= theme_dir + '/sass',
	css_dir			= theme_dir + '/css';


/**
 * Now, let's do things.
 */


// Styles
gulp.task('styles', function() {
	return gulp.src(sass_dir + '/*.scss')
		.pipe(sass({
			bundleExec: true,
			require: 'breakpoint'
		}))
		.on( 'error', gutil.log )
		.pipe(sourcemaps.init({loadMaps: true}))
		.pipe(autoprefixer({
			browsers: ['last 2 versions', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4']
		}))
		.pipe(sourcemaps.write())
		.pipe(gulp.dest(css_dir))
		.pipe(rename({suffix: '.min'}))
		.pipe(minifycss())
		.pipe(gulp.dest(css_dir));
});


// Clean
gulp.task('clean', function() {
	del( [css_dir], function( err ) {
		console.log( 'CSS directory deleted.' );
	});
});


// Default: clean and styles
gulp.task('default', ['clean'], function() {
	gulp.start('styles');
});


// Watch: watch our .scss files and do things when they change
gulp.task('watch', function() {
	gulp.watch( sass_dir + '/**/*.scss', ['styles'] );
});
