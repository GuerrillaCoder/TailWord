module.exports = {
    // parser: require('postcss-comment'),
    plugins: [
        // require('postcss-easy-import')({
        //     path: ["src/css", "src/css/inc"]
        // }),
        require('precss'),
        require('tailwindcss'),
        require('autoprefixer'),

    ]
}