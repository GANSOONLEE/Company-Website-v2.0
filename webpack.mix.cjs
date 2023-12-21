
/*
 | ---------------------------------------------------------
 |
 |                        Setup 設定
 |
 | ---------------------------------------------------------
 */

const mix = require("laravel-mix");
const tailwindcss = require("tailwindcss");
const reactRefresh = require("react-refresh");

mix.webpackConfig({
    stats: {
        children: true,
    },
    resolve: {
        extensions: ['.j,s', '.jsx']
    },
    plugins: [
        reactRefresh(),
    ]
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
    .react()
    .sourceMaps();

// 复制其他不需要编译的 JS 文件
// mix.copy('resources/js/ajax-scripts.js', 'public/js/ajax-scripts.js');

// 在开发环境启用 source maps
if (!mix.inProduction()) {
    mix.sourceMaps();
}

// 在生产环境版本化文件
if (mix.inProduction()) {
    mix.version();
}
