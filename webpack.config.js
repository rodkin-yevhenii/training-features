module.exports = {
  entry: {
    admin: './assets/scripts/admin',
    main: './assets/scripts/main',
  },
  output: {
    filename: '[name].js',
    path: __dirname + '/public',
  },
};
