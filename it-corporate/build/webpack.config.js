const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const path = require('path');
const webpack = require('webpack');

// [定数] webpack の出力オプションを指定します
// 'production' か 'development' を指定
const MODE = 'production';

// ソースマップの利用有無(productionのときはソースマップを利用しない)
const enabledSourceMap = (MODE === 'development');

// スタイルの出力形式(productionのときはcompressed)
const enabledOutputStyle = (MODE === 'development')? 'expanded': 'compressed';

module.exports = [
	{
			// モード値を production に設定すると最適化された状態で、
			// development に設定するとソースマップ有効でJSファイルが出力される
			mode: MODE,

			context: path.join(__dirname, './js'),

			// メインとなるJavaScriptファイル（エントリーポイント）
			entry: {
					admin: './admin.js',
			},

			// ファイルの出力設定
			output: {
					path: path.join(__dirname, '../src/js'),
					filename: '[name].js'
			},
			module: {
					rules: [{
							// 拡張子 .js の場合
							test: /\.js$/,
							use: [{
									// Babel を利用する
									loader: 'babel-loader',
									// Babel のオプションを指定する
									options: {
											presets: [
													// プリセットを指定することで、ES2018 を ES5 に変換
													'@babel/preset-env',
											]
									}
							}],
							// node_modules は除外する
							exclude: /node_modules\/(?!(dom7|swiper)\/).*/,
					}]
			},
			plugins: [
				// bootstrap のコードから jQuery が直接見えるように
				new webpack.ProvidePlugin({
					$: "jquery",
					jQuery: "jquery",
					"window.jQuery": "jquery",
					"window.$": "jquery",
					Popper: ['popper.js', 'default'],
					IScroll: 'iscroll',
				})
			],
			resolve: {
				alias: {
					'jquery': require.resolve('jquery'),
				}
			},
			performance: {
				hints: false
			}
	},
	// Sassファイルの読み込みとコンパイル
	{

			mode: MODE,
			context: path.join(__dirname, './sass'),
			entry: {
					admin: './admin.scss',
			},
			output: {
				path: path.join(__dirname, '../src/css'),
				filename: '[name].css'
			},
			module: {
					rules: [
							{
									test: /\.scss$/,
									use: [
											{
												loader: MiniCssExtractPlugin.loader,
											},
											{
													loader: 'css-loader',
													options: {
														// オプションでCSS内のurl()メソッドの取り込みを禁止する
														url: false,
														// ソースマップの利用有無
														sourceMap: enabledSourceMap,
														// CSSの空白文字を削除する
														minimize: true,
														// 0 => no loaders (default);
														// 1 => postcss-loader;
														// 2 => postcss-loader, sass-loader
														importLoaders: 2
													}
											},
											{
													loader: "sass-loader",
													options: {
														// ソースマップの利用有無
														sourceMap: enabledSourceMap,
														outputStyle: enabledOutputStyle
													}
											}
									]
							}

					]
			},

			plugins: [
					new MiniCssExtractPlugin({
							filename: './[name].css'
					})
			],
			devtool: "source-map",//ソースマップツールを有効
			performance: {
				hints: false
			}
	}
];