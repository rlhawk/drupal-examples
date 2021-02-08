const presetEnv = require('postcss-preset-env')({
  stage: 2,
  features: {
    'nesting-rules': true,
  },
})

module.exports = {
  plugins: [
    require('tailwindcss')(__dirname + '/tailwind.config.js'),
    presetEnv,
    ...(process.env.NODE_ENV === 'production' ? [require('cssnano')] : []),
  ],
}
