# wordpress-composed

This project provides a basis for managing a Wordpress-installation and all it's dependencies with 
[Composer](https://getcomposer.org/).

The goal is to strictly separate different components, which are originally tied
together by Wordpress: the core, plugins, themes, uploads, custom code and the
config. This is done in order to provide more predictable updates and simpler deployments. 
Using this setup, it's possible to run Wordpress-projects on distributed systems and 
cloud-services like Amazon Web Services.


## Features:

* Composer-based management of the Wordpress Core via https://github.com/johnpbloch/wordpress
* Themes and Plugins are available by default from http://wpackagist.org
* there is a strict separation between dependencies and content
* the core and all plug-ins are treated as dependency and remain untouched during the life-cycle.
* The wp-content folder is moved up one level, in order to maintain separation between add-ons and the core.
* The uploads-folder is moved to a separate top-level folder, below the doc-root.
    This maintains a clear folder-stucture which does not interfere with Composer.
* there is an additional top-level 'themes' folder, registered as an alternative theme-location, 
    which may contain your custom themes.
* a top-level "lib"-folder is autoloaded by Composer, allowing you to structure your custom code using namespaces, 
    following PHP's best-practices.
* a Docker setup is included for bootstrapping local development


## Installation

* make sure you have [Composer](https://getcomposer.org/) installed.
* Run `composer create-project finaldream/wordpress-composed PROJECT_NAME` to initialize a new project.
* review the `wp-config.php`, make optional changes

Running the local development environment with docker:

* make sure you have the latest [Docker and Docker-Compose](https://www.docker.com/products/overview) installed
* in your project-folder, run `docker-compose up`
* open your browser, navigate to `localhost`
* Install Wordpress


## Table of contents

* [Project Structure](docs/Wordpress-Composed.md)


## Author
Oliver Erdmann, http://www.finaldream.de
Github: https://github.com/finaldream/wordpress-composed

## License
Wordpress-Composed is licensed unter the ISC License, See LICENSE file for details: http://opensource.org/licenses/ISC
