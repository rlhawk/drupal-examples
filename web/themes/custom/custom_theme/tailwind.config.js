/**
 * @file
 * Configuration for Tailwind.
 */

const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
  plugins: [
    require("@tailwindcss/ui"),
  ],
  purge: {
    content: [
      // Don't purge classes that appear in these files.
      'templates/**/*.html.twig',
      'pdxdug_theme.theme',
    ],
    options: {
      // Whitelist classes that are frequently generated dynamically based on
      // color, such as text, backgrounds, and borders.
      whitelistPatterns: [
      ],
    },
  },
  // Opt in to upcoming breaking changes.
  future: {
    removeDeprecatedGapUtilities: true,
    purgeLayersByDefault: true,
  },
}
