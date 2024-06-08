const webpack = require("webpack");

module.exports = {
  // Other configurations...

  resolve: {
    fallback: {
      buffer: require.resolve("buffer/"),
      // Add other polyfills if needed
    },
  },
  plugins: [
    new webpack.ProvidePlugin({
      Buffer: ["buffer", "Buffer"],
    }),
    // Other plugins...
  ],
};
