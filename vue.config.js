var webpack = require('webpack')
var path = require('path')

module.exports = {
    publicPath: '/',
    transpileDependencies: [
        'vue-echarts',
        'resize-detector'
    ],
    configureWebpack: {
        devtool: 'source-map'
    },
    // devServer: {
    //   overlay: {
    //     warnings: true,
    //     errors: true
    //   }
    // }
    module: {
        loaders: [{
                test: /\.css$/,
                loader: 'vue-style-loader!css-loader'
            }

        ]
    },
    vue: {
        loaders: {
            css: 'vue-style-loader!css-loader'
        }
    }
}