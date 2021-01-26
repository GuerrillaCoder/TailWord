const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const CopyPlugin = require('copy-webpack-plugin');
const IgnoreEmitPlugin  = require('ignore-emit-webpack-plugin');

module.exports = [
    {
        entry: {
            'bundle': './src/ts/index.tsx',
        },
        mode: 'development',
        devtool: 'inline-source-map',
        module: {

            rules: [
                {
                    test: /\.tsx?$/,
                    use: 'ts-loader',
                    exclude: /node_modules/,
                },
            ],
        },
        resolve: {
            extensions: ['.tsx', '.ts', '.js', '.jsx'],
        },
        output: {
            filename: '[name].js',
            path: path.resolve(__dirname, 'dist'),
        }
    },
    // {
    //     entry: {
    //         'tailwind': './src/css/tailwind.css',
    //     },
    //     output: {
    //         filename: '_tailwind.js',
    //         path: path.resolve(__dirname, 'src/css/inc/'),
    //     },
    //     mode: 'development',
    //     plugins: [
    //         new MiniCssExtractPlugin({
    //             filename: '_tailwind.css',
    //             // chunkFilename: '[name].css',
    //         }),
    //         new IgnoreEmitPlugin(
    //             ['_tailwind.js']
    //         )
    //     ],
    //     module: {
    //
    //         rules: [
    //             {
    //                 test: /\.css$/,
    //                 exclude: /node_modules/,
    //                 use: [
    //                     {
    //                         loader: MiniCssExtractPlugin.loader,
    //                     },
    //                     {
    //                         loader: 'css-loader',
    //                         options: {
    //                             importLoaders: 1,
    //                         }
    //                     },
    //                     {
    //                         loader: 'postcss-loader'
    //                     }
    //                 ],
    //             }
    //         ],
    //     },
    // },

    {
        entry: {
            'vendor': './src/css/vendor.css',
            'admin-vendor': './src/css/admin-vendor.css',
            'admin': './src/css/admin.css',
            'main': './src/css/main.css',
        },
        mode: 'development',
        devtool: 'inline-source-map',
        plugins: [
            new MiniCssExtractPlugin({
                filename: '[name].css',
                // chunkFilename: '[name].css',
            }),
            new CopyPlugin({
                patterns: [
                    { from: 'node_modules/devextreme/dist/css/icons', to: 'icons' },
                ]}),
            new IgnoreEmitPlugin(
                ['vendor.js', 'admin-vendor.js', 'admin.js', 'main.js']
            )
        ],
        module: {

            rules: [
                {
                    test: /\.css$/,
                    // exclude: /node_modules/,
                    use: [
                        {
                            loader: MiniCssExtractPlugin.loader,
                            options: {
                                // // only enable hot in development
                                hmr: process.env.NODE_ENV === 'development',
                                // // if hmr does not work, this is a forceful method.
                                // reloadAll: true,
                            }
                        },
                        {
                            loader: 'css-loader',
                            options: {
                                importLoaders: 1,
                            }
                        },
                        {
                            loader: 'postcss-loader'
                        }
                    ],
                },
                {
                    test: /\.(woff(2)?|ttf|eot|svg)(\?v=\d+\.\d+\.\d+)?$/,
                    use: [
                        {
                            loader: 'file-loader',
                            options: {
                                name: '[name].[ext]',
                                outputPath: 'fonts/'
                            }
                        }
                    ]
                }
            ],
        },
        output: {
            filename: '[name].js',
            path: path.resolve(__dirname, 'dist'),
        },
    }
];