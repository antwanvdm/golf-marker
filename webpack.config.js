const path = require('path');

module.exports = {
    mode: 'development',
    entry: './src/js/main.js',
    devtool: 'hidden-source-map',
    output: {
        path: path.resolve(__dirname, 'public/dist'),
        filename: 'main.js',
        publicPath: path.resolve(__dirname, 'public')
    },
    module: {
        rules: [
            {
                test: /\.css$/i,
                exclude: /node_modules/,
                use: ['style-loader', 'css-loader', 'postcss-loader'],
            },
        ],
    },
    devServer: {
        contentBase: path.join(__dirname, 'public'),
        publicPath: '/dist',
        hot: true,
        open: true,
        port: 9000
    }
};
