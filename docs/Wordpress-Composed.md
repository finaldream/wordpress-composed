# About wordpress-composed

This project can be used as a starting-point for a composer-based Wordpress setup.





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

