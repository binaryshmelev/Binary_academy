var gulp = require('gulp');
var connect = require('gulp-connect');
var jade = require('gulp-jade');
var rjs = require('gulp-requirejs');
// add required packages

gulp.task('connect', function() {
	connect.server({
		port: 47,
		livereload: true,
		root: ['dist', 'dist/html']
	});
});

gulp.task('jade', function() {
	gulp.src('src/jade/*.jade')
		.pipe(jade())
		.pipe(gulp.dest('dist/html'))
		.pipe(connect.reload());
});

gulp.task('sass', function() {
	// implement sass task
});

gulp.task('requireJS', function() {
	// implement bundle.js file uglification
	rjs({
		baseUrl: 'src/js',
		name: '../../node_modules/almond/almond',
		include: ['app'],
		insertRequire: ['app'],
		out: 'bundle.js',
		wrap: true
	})
	.pipe(gulp.dest('dist/js'))
	.pipe(connect.reload());
});

gulp.task('watch', function() {
	gulp.watch('src/jade/*.jade', ['jade']);
	// add watch for .sass and .js files
});

gulp.task('default', ['requireJS', 'jade', 'sass', 'connect', 'watch']);