const defaultConfig = require('@wordpress/scripts/config/webpack.config');
const path = require('path');

module.exports = {
  ...defaultConfig,
  entry: {
    'podcast-meta': path.resolve(process.cwd(), 'blocks/podcast-meta/index.js'),
    // Add more entries for other blocks if needed
  },
  output: {
    path: path.resolve(process.cwd(), 'assets/build/podcast-meta'),
    filename: 'index.js',
  },
};