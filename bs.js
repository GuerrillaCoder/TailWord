var browserSync = require('browser-sync');

var domain = "http://localhost:6677/";

browserSync({
    proxy: domain,
    logLevel: "debug",
    logConnections: true,
    files: ['dist/**/*.css', 'dist/**/*.js'],
    // serveStatic: [{
    //     route: '/wp-content/themes/tailwindcss/dist/',
    //     dir: 'dist'
    // }],
    serveStatic: ['./dist/'],
    port: 10111,
    // reloadDelay: 1000, //remove or lower this is you are on mac
    rewriteRules: [
        {
            match: new RegExp('/wp-content/themes/tailwindcss/dist/admin.css'),
            fn: function () {
                return '/admin.css';
            }
        },
        {
            match: new RegExp('/wp-content/themes/tailwindcss/dist/admin-vendor.css'),
            fn: function () {
                return '/admin-vendor.css';
            }
        },
        {
            match: new RegExp('/wp-content/themes/tailwindcss/dist/main.css'),
            fn: function () {
                return '/main.css';
            }
        },
        {
            match: new RegExp('/wp-content/themes/tailwindcss/dist/vemdor.css'),
            fn: function () {
                return '/vemdor.css';
            }
        },
        {
            match: new RegExp('/wp-content/themes/tailwindcss/dist/bundle.js'),
            fn: function () {
                return '/bundle.js';
            }
        }
    ]
});

