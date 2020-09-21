# drupal-demo

Demonstrations of Drupal code and configuration.

## Get started

To get started:

1. Clone or download the project \
   `git clone https://github.com/rlhawk/drupal-demo.git`
2. Change to the project directory \
   `cd drupal-demo`
3. Start DDEV or Lando \
   `ddev start` or `lando start`
4. Install Drupal \
   `ddev exec drush site-install -n` or `lando drush site-install -n`

## Demonstrations

### Custom modules and themes managed as dependencies with Composer and NPM

Note the following additional repositories in composer.json:

```json
"custom-modules": {
    "type": "path",
    "url": "web/modules/custom/*"
},
"custom-themes": {
    "type": "path",
    "url": "web/themes/custom/*"
}
```

This allows custom modules and themes to be added as top-level dependencies:

```bash
composer require "drupal-demo/custom-module:*"
composer require "drupal-demo/custom-theme:*"
```

This means that PHP dependencies for a custom module can be defined in the module's composer.json file, rather than in the project's. In this example, the custom module has a dependency on the AWS SDK for PHP library:

```json
{
    "name": "drupal-demo/custom_module",
    "description": "A custom module.",
    "type": "drupal-custom-module",
    "license": "proprietary",
    "version": "0.0.0",
    "require": {
        "aws/aws-sdk-php": "^3.153"
    }
}
```

This approach is also useful for Node dependencies. The custom theme is defined as a dependency in the top-level package.json file:

```bash
npm install "@drupal-demo/custom_theme@file:web/themes/custom/custom_theme"
```

The theme defines which packages it requires in its package.json file:

```json
"dependencies": {
    "@tailwindcss/ui": "^0.5.0",
    "alpinejs": "^2.6.0",
    "copy-files-from-to": "^3.1.4",
    "cssnano": "^4.1.10",
    "postcss-cli": "^7.1.1",
    "postcss-preset-env": "^6.7.0",
    "rimraf": "^3.0.2",
    "tailwindcss": "^1.8.5",
    "yargs": "^15.4.1"
},
```

The theme also defines files that need to be copied into its build directory:

```json
"copyFiles": [
    {
        "//": "--- Alpine.js ---",
        "from": [
            "../../../../node_modules/alpinejs/dist/*.js"
        ],
        "to": "dist/js/alpinejs"
    }
],
"copyFilesSettings": {
    "whenFileExists": "overwrite"
}
```
