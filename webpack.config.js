const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const CopyPlugin = require('copy-webpack-plugin');
const IgnoreEmitPlugin  = require('ignore-emit-webpack-plugin');

//example config: https://gist.github.com/adamwathan/7796ee4dced569cc31d5cf83c62b8f89
//todo: turn postcss config into object so can have 2 separate configs, one for frontend purge and one for backend purge

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
    {
        entry: {
            'vendor': './src/css/vendor.css',
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
                ['vendor.js', 'admin.js', 'main.js']
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
                        },
                        {
                            loader: 'css-loader',
                            options: {
                                importLoaders: 1,
                            }
                        },
                        {
                            loader: 'postcss-loader',
                            options: {
                                postcssOptions: {
                                    plugins: {
                                        precss: {},
                                        tailwindcss: { config: `${__dirname}/tailwind.front.config.js` },
                                        autoprefixer: {},
                                    }
                                }

                            },
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
    },
    {
        entry: {
            'admin-vendor': './src/css/admin-vendor.css',
        },
        mode: 'development',
        devtool: 'inline-source-map',
        plugins: [
            new MiniCssExtractPlugin({
                filename: '[name].css',
                // chunkFilename: '[name].css',
            }),
            new IgnoreEmitPlugin(
                ['admin-vendor.js']
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
                        },
                        {
                            loader: 'css-loader',
                            options: {
                                importLoaders: 1,
                            }
                        },
                        {
                            loader: 'postcss-loader',
                            options: {
                                postcssOptions: {
                                    plugins: {
                                        precss: {},
                                        tailwindcss: { config: `${__dirname}/tailwind.admin.config.js` },
                                        autoprefixer: {},
                                    }
                                }

                            },
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