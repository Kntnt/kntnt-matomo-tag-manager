# Kntnt Matomo Tag Manager

[![License: GPL v2+](https://img.shields.io/badge/License-GPLv2+-blue.svg)](https://www.gnu.org/licenses/gpl-3.0)
[![Requires PHP: 7.1+](https://img.shields.io/badge/PHP-7.1+-blue.svg)](https://php.net)
[![Requires WordPress: 6.7](https://img.shields.io/badge/WordPress-6.7+-blue.svg)](https://wordpress.org)

Adds Matomo Tag Manager for non-logged in visitors if the container URL is specified with either the PHP constant `KNTNT_MATOMO_TAG_MANAGER_CONATINER_URL` or the filter `kntnt-matomo-tag-manager-container-url`.

## Description

Kntnt Matomo Tag Manager is a lightweight WordPress plugin that integrates Matomo Tag Manager into your WordPress site with minimal configuration. Matomo Tag Manager is an open-source alternative to Google Tag Manager, allowing you to manage various tracking codes and scripts without modifying your website code.

This plugin:

- Automatically adds the Matomo Tag Manager script to your site's header
- Only loads for non-logged-in visitors to prevent tracking administrative actions
- Provides multiple ways to configure your container URL (constant or filter)
- Has zero configuration once set up – just works in the background

## Installation

1. [Download the plugin zip archive.](https://github.com/Kntnt/kntnt-matomo-tag-manager/releases/latest/download/kntnt-matomo-tag-manager.zip)
2. Go to WordPress admin panel → Plugins → Add New.
3. Click "Upload Plugin" and select the downloaded zip archive.
4. Activate the plugin.

## Configuration

Set your Matomo Container URL (e.g. `https://cdn.matomo.cloud/XXXXX.matomo.cloud/container_YYYYYY.js`) using one of these methods:

### Method 1

Add the following to your `wp-config.php` file:

```php
define('KNTNT_MATOMO_TAG_MANAGER_CONTAINER_URL', 'YOUR_CONTAINER_URL');
```

### Method 2

Use the filter in your theme's functions.php or a custom plugin:

```php
add_filter('kntnt-matomo-tag-manager-container-url', function() {
   return 'YOUR_CONTAINER_URL';
});
```

## Questions & Answers

### How can I get help?

If you have questions about the plugin and cannot find an answer here, start by looking at issues and pull requests on our GitHub repository. If you still cannot find the answer, feel free to ask in the plugin's issue tracker on GitHub.

### How can I report a bug?

If you have found a potential bug, please report it on the plugin's issue tracker on GitHub.
How can I contribute?

### Contributions to the code or documentation are much appreciated.

If you are familiar with Git, please do a pull request.

If you are not familiar with Git, please create a new ticket on the plugin's issue tracker on GitHub.

## Changelog

### 1.1.0 (2025-05-12)

* Replaced container ID configuration with only container URL configuration

### 1.0.0 (2025-04-11)

- Initial release
- Added support for Matomo Tag Manager script inclusion
- Added container ID configuration via constant or filter
- Added container URL customization via filter
- Added safety checks to prevent tracking of logged-in users