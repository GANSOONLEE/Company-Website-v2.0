
/*
 | ---------------------------------------------------------
 |
 |                        Setup 設定
 |
 | ---------------------------------------------------------
 */

const mix = require("laravel-mix");
const tailwindcss = require("tailwindcss");
const { ProvidePlugin } = require("webpack");
const path = require('path');
const minify = require('html-minifier').minify;

mix.webpackConfig({
    stats: {
        children: true,
    },
});

/*
 | ---------------------------------------------------------
 |
 |                        mix 編譯
 |
 | ---------------------------------------------------------
 */

mix.sass('resources/scss/app.scss', 'public/css')
    .options({
        processCssUrls: false,
        postCss: [ tailwindcss('./tailwind.config.cjs') ],
    });

mix.js('resources/js/app.js', 'public/js')
    .sourceMaps();

// 复制其他不需要编译的 JS 文件
// mix.copy('resources/js/frontend/product-detail.js', 'public/js/frontend/product-detail.js');

// 在开发环境启用 source maps
if (!mix.inProduction()) {
    mix.sourceMaps();
}

// 在生产环境版本化文件
if (mix.inProduction()) {
    mix.version();
}

/*
 | ---------------------------------------------------------
 |
 |                  export module 輸出模塊
 |
 | ---------------------------------------------------------
 */

module.exports = {
    entry: './resources/app.js',
    output: {
        path: path.resolve(__dirname, 'public'),
        filename: 'app.js'
    },
    plugins: [

    ],
    resolve: {
        extensions: [".jsx", ".js"]
    },
};