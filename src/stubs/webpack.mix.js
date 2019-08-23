const mix = require('./node_modules/laravel-mix');
let rootDir = 'assets/';

mix.options({
    fileLoaderDirs: {
        // images: rootDir+'img',
        fonts: rootDir+'fonts'
    }
})
.js('resources/assets/js/app.js', rootDir+'js/')
.sass('resources/assets/sass/app.scss', rootDir+'css/');

if (mix.inProduction()) {
    mix.version();
}

// mix.browserSync({
//     proxy: 'project.test',
// });
