const mix = require("laravel-mix");
const glob = require("glob");
const path = require("path");

const scssFiles = glob.sync("resources/scss/**/*.scss");
const jsFiles = glob.sync("resources/js/**/*.js");

mix.webpackConfig({
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
        .vue();
});