

var gulp = require('gulp'),
    sass = require('gulp-sass'),
    browserSync = require('browser-sync'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglifyjs'),
    cssnano = require('gulp-cssnano'),
    rename = require('gulp-rename'),
    del = require('del'),
    imagemin = require('gulp-imagemin'),
    pngquant = require('imagemin-pngquant'),
    cache = require('gulp-cache'),
    autoprefixer = require('gulp-autoprefixer'),
	//sassmixins = require('gulp-sass-to-postcss-mixins'),
	importCss = require('gulp-import-css'),
	nano = require('gulp-cssnano'),
	uncss = require('gulp-uncss');
	var map = require('map-stream');
var uniqueFilterFn = function(item, idx, all) {
 return idx === all.indexOf(item);
};



gulp.task('img', function(){
	return gulp.src('app/img/**/*')
	.pipe(cache(imagemin({
		interlaced: true,
		progressive: true,
		svgoPlugins: [{removeViewBox: false}],
		une: [pngquant()]
	})))
	.pipe(gulp.dest('dist/img'));
});



gulp.task('scripts', function(){
		return gulp.src([
				'app/libs/jquery/dist/jquery.min.js',
				'app/libs/magnific-popup/dist/jquery.magnific-popup.min.js'
			])
		.pipe(concat('libs.min.js'))
		.pipe(uglify())
		.pipe(gulp.dest('app/js'))
});

gulp.task('css-libs',['sass'], function(){
		return gulp.src('app/css/libs.css')
		.pipe(cssnano())
		.pipe(rename({suffix:'.min'}))
		.pipe(gulp.dest('app/css'));
});

 gulp.task('browser-sync', function(){
 		browserSync({
 			server: {
 				baseDir:'app'
 			},
 			notify: false,
 			open: false
 		});
 });

 
 
 
 
 
 
 
 
 
 
 gulp.task('sass', function(){ // Создаем таск Sass
	return gulp.src('app/sass/**/*.scss') // Берем источник
		//.pipe(importCss())
		.pipe(sass()) // Преобразуем Sass в CSS посредством gulp-sasss
		.pipe(autoprefixer(['last 15 versions', '> 1%', 'ie 8', 'ie 7'], { cascade: true })) // Создаем префиксы
		.pipe(gulp.dest('app/css')) // Выгружаем результата в папку app/css
		.pipe(browserSync.reload({stream: true})) // Обновляем CSS на странице при изменении
});
 
 
gulp.task('webpack', ['sass'], function() {
  return  gulp.src('app/css/*.css')
.pipe(map(function(file, cb) {
 // convert file buffer into a string
 var contents = file.contents.toString();
 // split it by lines
 var lines = contents.split();
 // apply the unique filter
 var uniqueLines = lines.filter(uniqueFilterFn);
 // join unique list into lines
 var output = uniqueLines.join('\n');
 // convert string back into buffer
 var buffer = new Buffer(output, 'binary');
 // replace the file contents
 file.contents = buffer;
 // continue
 return cb(null, file);
}))
.pipe(concat('main.css'))
.pipe(gulp.dest('app/css'));
});





 
 
 
 
 