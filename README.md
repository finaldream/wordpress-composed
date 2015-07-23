# wordpress-composed
This project can be used as a starting-point for a composer-based Wordpress setup.

The goal is to strictly separate different components, which are originally tied
together by Wordpress: the core, plugins, themes, uploads and the
config. This is done in order to provide more predictable updates and a simpler,
reproducible deployment.

The config is extracted and excluded from the project at all for more security and
support for multiple deployment-targets.

## Features:

* Composer-based management of the Wordpress Core
    via https://github.com/johnpbloch/wordpress
* Themes and Plugins are available by default from http://wpackagist.org
* there is a strict separation between dependencies and content
* the core and all plug-ins are treated as dependency and remain untouched
    during the life-cycle.
* The wp-content folder is moved up one level, in order to maintain separation
    between add-ons and the core.
* The uploads-folder is move to a separate top-level folder, below the doc-root.
    This maintains a clear folder-stucture and does not obstruct composer's work.
* there is an additional top-level 'themes' folder, registered as an alternative
    theme-location, which can contain your non-standard themes.

## File-structure

```
- root/
  |- docs/                * (structured docs)
  |- htdocs/
  |  |- wp-core/            (wordpress installation - managed by composer)
  |  |  |- wp-includes/
  |  |  |- wp-admin/
  |  |  `- wp-content/      (unused, relocated up one level)
  |  |
  |  |- wp-content/         (managed by composer / wpackagist)
  |  |  |- plugins/
  |  |  |- themes/
  |  |  |- vendor/
  |  |  `- autoload.php
  |  |
  |  |- themes/           * (a place for your custom themes)
  |  |- uploads/            (user uploads)
  |  |
  |  |- index.php         * (custom, git-managed)
  |  |- wp-config.php     * (see config-section, git-managed, pulls in ../.env)
  |  |- composer.json     * (composer definition)
  |  `- composer.lock     * (composer lock-file)
  |
  |- .env.php-sample      * (sample environment settings, starting point for initial installation)
  |- .env.php               (environment settings, see config-section)
  |- .gitignore           * (whitelisted git-ignore)
  `- Readme.md            * (Readme and toc for /docs)

```

Files marked with *`*`* are git-managed, everything else is git-ignored.

### About .gitignore

In order to keep the project clean and keep unintended files like credentials or
dependencies entering the repository, I decided to negate the gitignore.
That means, everything is ignored by default, only selected files and folders
are then whitelisted again.

# Installation

* make sure you have [Composer](https://getcomposer.org/doc/00-intro.md#installation-nix) installed.
* checkout the project from git (https://github.com/finaldream/wordpress-composed)
* in the project-root (this is where the composer.json lives):
  * copy `.env.php-sample` to `.env.php`
  * edit the configuration in `.env.php` as you would in `wp-config.php`
  * run: `composer install`
* Open up the browser and run the Wordpress-Installer
* That's all!

## Configuration

Wordpress-Composed works around the traditional `wp-config.php`, which is part of the actual project. The possible locations of this file is limited to a few options and there is no easy way to put it totally outside the project.
My approach is, to remove all config-code from the wp-config, only leaving there a few requires, which usually don't require changes. Then, the config is moved to an `.env.php`-file, which is specific to a deployment-target and ignored by git. This means, yes, you have to create and edit this file on your server by hand.
But there is already a sample, which helps you get started quickly.
In general, you have all the same options as you would in wp-config, e.g. you can simply copy any example from [The Codex](http://codex.wordpress.org/Editing_wp-config.php).

### Why not use dotenv?
I thought about this in the first place. In some cases it might be better to save the config in a non-PHP file, but I found it limiting as well. For each new option, you would still need a statement in your wp-config. While this is no big deal in general, I'd still liked to keep those files separated, without the need to touch them in the case of new options.
Another reason for me was the chance to use variables, conditions and to retain the ability to copy & paste code from The Codex.

# Author
Oliver Erdmann, http://www.finaldream.de
Github: https://github.com/finaldream/wordpress-composed

# License
Wordpress-Composed is licensed unter the ISC License, See LICENSE file for details.
