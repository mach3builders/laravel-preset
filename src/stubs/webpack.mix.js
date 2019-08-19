const mix = require('./node_modules/laravel-mix');

mix.js('resources/assets/js/app.js', 'public/assets/js')
    .sass('resources/assets/sass/app.scss', 'public/assets/css');

if (mix.inProduction()) {
    mix.version();
}

// mix.browserSync({
//     proxy: 'project.test',
// });
