/*
* Base Gulp.js workflow
* for simple front-end projects
* author: Aaron John Schlosser
* url: http://www.aaronschlosser.com
*/

var gulp 				= require("gulp"),
	gutil 				= require("gulp-util"),
	watch 				= require("gulp-watch"),
	compass 			= require("gulp-compass"),
	autoprefix  	= require('gulp-autoprefixer'),
	jade 			    = require("gulp-jade-php"),
	lint					= require("gulp-jshint"),
	uglify				= require("gulp-uglify"),
	plumber				= require("gulp-plumber")

var paths = {
	styles: {
		src: "./scss/*.scss",
		dest: "./"
	},
	templates: {
		src: "./templates/*.jade",
		dest: "./"
	},
	lint: {
		src: "./js/source/*.js"
	},
	uglify: {
		src: "./js/source/*.js",
		dest: "./js/min"
	}
};

function handleError(err) {
  console.log(err.toString());
  this.emit('end');
}

gulp.task("styles", function() {
	return gulp.src(paths.styles.src)
		.pipe(plumber())
		.pipe(compass({
			css: "./",
			sass: "scss",
			image: "images"
		}))
		.on('error', handleError)
		.pipe(autoprefix({browsers: ['> 1%', 'last 2 versions', 'Firefox ESR', 'Opera 12.1'],cascade: false}))
		.pipe(plumber.stop())
		//.pipe(gulp.dest(paths.styles.dest));
});

gulp.task("templates", function() {
  gulp.src(paths.templates.src)
  	.pipe(plumber())
	.pipe(jade({pretty:true}))
	.pipe(plumber.stop())
	.pipe(gulp.dest(paths.templates.dest));
});

gulp.task("lint", function() {
	gulp.src(paths.lint.src)
	.pipe(lint())
	.pipe(lint.reporter('default'))
	.pipe(plumber.stop())
});

gulp.task("uglify", function(){
	gulp.src(paths.uglify.src)
		.pipe(plumber())
		.pipe(uglify())
		.pipe(plumber.stop())
		.pipe(gulp.dest(paths.uglify.dest));
});

gulp.task("default", function() {
	gulp.watch(paths.styles.src, ["styles"]);
	gulp.watch(paths.templates.src, ["templates"]);
	gulp.watch(paths.lint.src, ["lint"]);
	gulp.watch(paths.uglify.src, ["uglify"]);
});
