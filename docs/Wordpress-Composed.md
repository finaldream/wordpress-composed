# wordpress-composed
This project can be used as a starting-point for a composer-based Wordpress setup.

The goal is to strictly separate different components, which are originally tied
together by Wordpress: the core, plugins, themes, uploads and the
config. This is done in order to provide more predictable updates and a simpler,
more predictable deployment.

## Features:

* Composer-based management of the Wordpress Core via https://github.com/johnpbloch/wordpress
* Themes and Plugins are available by default from http://wpackagist.org
* there is a strict separation between dependencies and content
* the core and all plug-ins are treated as dependency and remain untouched during the life-cycle.
* The wp-content folder is moved up one level, in order to maintain separation between add-ons and the core.
* The uploads-folder is moved to a separate top-level folder, below the doc-root.
    This maintains a clear folder-stucture which does not interfere with Composer.
* there is an additional top-level 'themes' folder, registered as an alternative theme-location, 
    which can contain your non-standard themes.
* a top-level "lib"-folder is autoloaded by Composer, allowing you to structure your code using namespaces, following
    PHP's best-practices.
* a Docker setup is included for bootstrapping local development

## File-structure

```
- root/
  |- docs/                  (project docs)
  |- htdocs/
  |  |- wp-core/            (wordpress installation - managed by composer)
  |  |  |- wp-includes/
  |  |  |- wp-admin/
  |  |  `- wp-content/      (contains built-in themes and plugins)
  |  |
  |  |- wp-content/         (managed by composer / wpackagist)
  |  |  |- plugins/
  |  |  |- themes/
  |  |  |- vendor/
  |  |  `- autoload.php
  |  |
  |  |- mu-plugins/         (Must-Use Plugins, custom-code)
  |  |  `- wp-composed-support.php   (Manages a few aspects of WP-Composed)
  |  |
  |  |- themes/             (a place for your custom themes - not Composer managed)
  |  |- uploads/            (user uploads)
  |  |
  |  |- index.php           (custom, git-managed)
  |  |- wp-config.php       (see config-section, git-managed)
  |  |- composer.json       (composer definition)
  |  `- composer.lock       (composer lock-file)
  |
  |- .gitignore             (git-ignore)
  `- Readme.md              (Readme and toc for /docs)

```

# Installation

* make sure you have [Composer](https://getcomposer.org/doc/00-intro.md#installation-nix) installed.
* checkout the project from git (https://github.com/finaldream/wordpress-composed)
* in the project-root (this is where the composer.json lives):
  * review the `wp-config.php`, make optional changes
  * run: `composer install`
* Open up the browser and run the Wordpress-Installer
* That's all!

## Configuration

Wordpress-Composed comes with a default `wp-config.php`, which already provides some adjustments, e.g. for relocating of 
the different system-folders. You are free to modify it and change as you would on a standard installation. 

In order to keep your setup flexible and to employ best practices, we suggest that you use environment variables for
storing database credentials and sensitive information.

## Plugins and stock-themes:
Plugins and themes are generally treated as dependencies and managed by Composer.
The default plugin- and theme-repository is http://wpackagist.org, which basically wraps the wealth of wordpress.org 
into Composer-friendly packages. By default, those dependencies will be stored into `htdocs/wp-content`.

Bundled themes (e.g. `twenty...`) are stored inside `htdocs/wp-core/wp-content`, so they are available by default.

### MU-Plugins
There is an exception to plugins, so called Must-Use-Plugins. Those plugins are enabled by default and have a few 
limitations, like the lack of a sub-folders-structure (which makes standard-plugins inconvenient to be used as mu-plugins). 
Because of their special status, they are considered custom-code and not external dependencies. 
In standard WP-installations, the `mu-plugins` folder lives inside of `wp-content`, but in our case, 
`wp-content` is managed by Composer and therefor considered disposable. 
MU-Plugins are located at `htdocs/mu-plugins`. The "wp-composed-support"-plugin is living there already, 
managing a few special aspects of the project.

### Custom themes

You can install any stock-theme available on wpackagist as an external dependency and you can - with a bit of extra 
effort - set up your own private repository, to have your private themes managed as dependencies. 
But what if you are building small child-themes, based on a popular stock-theme and you don't want/need all the extra 
work associated with setting up a private repository for Composer? 
Well, we've got you covered, there is a folder for that! Watch out for `htdocs/themes`, which is considered custom-code 
and can hold any of your custom themes, checked into your VCS. It is actually an additional theme-directory, which uses 
a few (legal) tricks to be fully recognized by Wordpress, but otherwise totally behaves like the default themes-folder.

If you're working with standardized release-processes and you're in need of change-logs, there's a convenient side-effect 
when managing custom-themes (as well as custom code as part of `lib`) inside of the project's repository. 
Instead of cluttering your git-history with ambiguous "Composer Update"-messages, you'll get linear change-logs from your 
git-history. 


# Author
Oliver Erdmann, http://www.finaldream.de
Github: https://github.com/finaldream/wordpress-composed

# License
Wordpress-Composed is licensed unter the ISC License, See LICENSE file for details: http://opensource.org/licenses/ISC
