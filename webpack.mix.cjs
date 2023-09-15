const mix = require("laravel-mix");
const glob = require("glob");
const path = require("path");

const scssFiles = glob.sync("resources/scss/**/*.scss");
const jsFiles = glob.sync("resources/js/**/*.js");

mix.webpackConfig({
    mode: 'production', // 设置为 'production'
    stats: {
        children: true,
    },
});

scssFiles.forEach(file => {
    const relativePath = path.relative("resources/scss", file);
    const fileNameWithoutExtension = path.basename(relativePath, ".scss");
    mix.sass(file, `public/css/${path.dirname(relativePath)}/${fileNameWithoutExtension}.css`);
});

jsFiles.forEach(file => {
    const relativePath = path.relative("resources/js", file);
    const fileNameWithoutExtension = path.basename(relativePath, ".js");
    mix.js(file, `public/js/${path.dirname(relativePath)}/${fileNameWithoutExtension}.js`)
        .vue()
        .sourceMaps();
});

// mix.setPublicPath('public')
//     .setResourceRoot('../') // Turns assets paths in css relative to css file
//     .vue()
//     .sass('resources/sass/frontend/app.scss', 'css/frontend.css')
//     .sass('resources/sass/backend/app.scss', 'css/backend.css')
//     .js('resources/js/frontend/app.js', 'js/frontend.js')
//     .js('resources/js/backend/app.js', 'js/backend.js')
//     .extract([
//         'alpinejs',
//         'jquery',
//         'bootstrap',
//         'popper.js',
//         'axios',
//         'sweetalert2',
//         'lodash'
//     ])
//     .sourceMaps();

// if (mix.inProduction()) {
//     mix.version();
// } else {
//     // Uses inline source-maps on development
//     mix.webpackConfig({
//         devtool: 'inline-source-map'
//     });
// }
