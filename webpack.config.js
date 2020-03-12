module.exports = [{
        entry: {
            'settings': './app/settings.js',
        },
        output: {
            filename: './app/bundle/[name].js',
                  },
        module: {
            rules: [{ test: /\.vue$/, use: 'vue-loader'}],
        }
    }

];