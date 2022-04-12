var gulp = require('gulp');
var sass = require('gulp-sass')(require('node-sass'));
var jshint = require('gulp-jshint');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var sort = require('gulp-sort');
var wppot = require('gulp-wp-pot');
var gettext = require('gulp-gettext');

gulp.task('default', function() {	 
	console.log('Use the following commands');
	console.log('--------------------------');
	console.log('gulp compile-css    to compile the custom.scss to custom.css');
	console.log('gulp compile-js     to compile the custom.js to custom.min.js');
	console.log('gulp watch          to continue watching the files for changes.');
	console.log('gulp wordpress-lang to compile the lsx-starter-child-theme.pot, en_EN.po and en_EN.mo');
});

gulp.task('sass', function(done) {
	return gulp.src('assets/css/custom.scss')
		.pipe(sass())
		.pipe(gulp.dest('assets/css')),
		done();
});

gulp.task('compile-css', gulp.series( ['sass'] , function(done) {
	done();
}));

gulp.task('js', function(done) {
	return gulp.src('assets/js/custom.js')
		.pipe(jshint())
		.pipe(jshint.reporter('fail'))
		.pipe(concat('custom.min.js'))
		.pipe(uglify())
		.pipe(gulp.dest('assets/js')),
		done();
});

gulp.task('compile-js', gulp.series( ['js'] , function(done) {
	done();
}));

gulp.task('watch-css', function (done) {
	done();
	return gulp.watch('assets/css/***.scss', gulp.series('compile-css'));
});

gulp.task('watch-js', function (done) {
	done();
	return gulp.watch('assets/js/custom.js', gulp.series('compile-js'));
});

gulp.task('watch', gulp.series( ['watch-css', 'watch-js'] , function(done) {
	done();
}));

gulp.task('wordpress-pot', function(done) {
	return gulp.src('**/*.php')
		.pipe(sort())
		.pipe(wppot({
			domain: 'lsx-starter-child-theme',
			package: 'lsx-starter-child-theme',
			team: 'LightSpeed <webmaster@lsdev.biz>'
		}))
		.pipe(gulp.dest('languages/lsx-starter-child-theme.pot')),
		done();
});

gulp.task('wordpress-po', function(done) {
	return gulp.src('**/*.php')
		.pipe(sort())
		.pipe(wppot({
			domain: 'lsx-starter-child-theme',
			package: 'lsx-starter-child-theme',
			team: 'LightSpeed <webmaster@lsdev.biz>'
		}))
		.pipe(gulp.dest('languages/en_EN.po')),
		done();
});

gulp.task('wordpress-po-mo', gulp.series( ['wordpress-po'], function(done) {
	return gulp.src('languages/en_EN.po')
		.pipe(gettext())
		.pipe(gulp.dest('languages')),
		done();
}));

gulp.task('wordpress-lang', gulp.series( ['wordpress-pot', 'wordpress-po-mo'] , function(done) {
	done();
}));
