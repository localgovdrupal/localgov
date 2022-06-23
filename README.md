# LocalGov Drupal

Drupal distribution and install profile to help UK councils collaborate and
share Drupal code for publishing website content.

This project is the Drupal installation profile that is best installed using
composer to require a project template, localgov_project, to scaffold and build
the codebase which includes this profile.

## Supported branches

We are actively supporting and developing the 2.x branch for Drupal 9.

The 1.x branch is no longer actively supported and not recommended for new sites.

If you are still using the 1.x branch on your site, please [create an issue on Github](https://github.com/localgovdrupal/localgov/issues) to let us know.

## Documentation

Further documentation for developers, content designers and other audiences can
be found at [https://docs.localgovdrupal.org/](https://docs.localgovdrupal.org/).

## Requirements for installing LocalGov Drupal locally for testing and development

To install LocalGov Drupal locally you will need an appropriate versions of:

 - PHP (see https://www.drupal.org/docs/system-requirements/php-requirements)
 - A database server like MySQL (see https://www.drupal.org/docs/system-requirements/database-server-requirements)
 - A web server like APache2 (see https://www.drupal.org/docs/system-requirements/web-server-requirements) 

Many of us use the Lando file included to run a local docker environmnent for testing and development, but seom people prefer to run the web servers natively on their host machine.

### PHP requirements

We folllow Drupal's PHP recomendations: https://www.drupal.org/docs/system-requirements/php-requirements#versions

We currently recomend PHP 8.1 or 8.0 but also aim to support PHP 7.4.

You will also need to have certain PHP extensions enabled (see https://www.drupal.org/docs/system-requirements/php-requirements#extensions) including: 

 - PHP mbstring
 - PHP cURL
 - GD library
 - XML 

If you see errors when running composer require, double check your PHP extensions.

## Composer and Lando

To install locally, you will need Composer and we recommend using Lando for a consistent developer environment.

 - https://getcomposer.org/
 - https://lando.dev/

Please also see the Lando requirements section for details of Docker
requirements for different operating systems.

https://docs.lando.dev/basics/installation.html#system-requirements

## Installing LocalGov Drupal locally with composer

To install LocalGov Drupal locally for testing or development, use the
[Composer-based project template](https://github.com/localgovdrupal/localgov_project).

Change `MY_PROJECT` to whatever you'd like your project directory to be called.

```bash
composer create-project localgovdrupal/localgov-project MY_PROJECT --no-install 
```

Change directory into the MY_PROJECT directory and run lando start.

```bash
cd MY_PROJECT
lando start
```

Once lando has finished building, use lando to run composer install and the site installer.

```bash
lando composer install
lando drush si localgov -y
```

Note: As you might be running a different version of PHP on your host machine from the 
version that Lando runs, it is advisable to run composer install from within Lando. 
This ensures dependencies reflect the PHP version that the webserver is actually running. 

## Composer notes

If developing locally and you want to force composer to clone again
from source rather than use composer cache, you can add the `--no-cache` flag.

```bash
lando composer create-project localgovdrupal/localgov-project MY_PROJECT --stability dev --no-cache  --no-install 
```

If you just want to pull in the latest changes to LocalGov Drupal run composer
update with the `--no-cache` flag.

```bash
lando composer update --no-cache
```

If you want to be sure you are getting the latest commits when developing,
clearing composer cache, deleting the folders and re-running composer update
seems to be a solid approach:

```bash

rm -rf web/profiles/contrib/ web/modules/contrib/ web/themes/contrib/;
composer clear-cache; composer update --with-dependencies --no-cache;
lando start;
lando drush si localgov -y;

```

If you run into [memory limit errors](https://getcomposer.org/doc/articles/troubleshooting.md#memory-limit-errors)
when running Composer commands, prefix the commands with `COMPOSER_MEMORY_LIMIT=-1`.
For example, to install the project run:

```bash
COMPOSER_MEMORY_LIMIT=-1 composer create-project --stability dev localgovdrupal/localgov-project MY_PROJECT
```

## Contributing

See [CONTRIBUTING.md](CONTRIBUTING.md) for current contribution guidelines.

## Issue tracking

In the early development stages, most issues will be tracked in this repository
<https://github.com/localgovdrupal/localgov/issues>.

Development issues relating to specific projects or module should be tracked in
the project repository. In the future we might set up a separate repository for
centralised issue tracking of bug reports for end users.

## Development setup

The main development environment in use is currently
[Lando](https://docs.lando.dev/) – a Docker based development environment that
works on Linux, MacOS and Windows.

@todo Document Lando setup.

## Coding standards

PHP CodeSniffer is installed as a dev dependency by Composer and configured to
use Drupal coding standards and best practices. It is a good idea to run these
before committing any code. All code in pull requests should pass all
CodeSniffer tests.

To check code using Lando run:

```bash
lando phpcs
```

To attempt to automatically fix coding errors in Lando run:

```bash
lando phix
```

### Coding standards resources

* [Drupal coding standards](https://www.drupal.org/docs/develop/standards)

## Running tests

The included `phpunit.xml.dist` file contains configuration for automatically
running the LocalGov Drupal test suite.

To run all LocalGov Drupal tests with Lando use:

```bash
lando phpunit
```

To run all the tests for a specific module use:

```bash
lando phpunit web/modules/contrib/localgov_my_module
```

Tests can be filtered using the `--filter` option. To only run a specific test
use:

```bash
lando phpunit --filter=myTestName
```

### Testing resources

* [PHPUnit documentation](https://phpunit.readthedocs.io/en/7.5/)
* [Drupal 8 PHPUnit documentation](https://www.drupal.org/docs/8/testing/phpunit-in-drupal-8)
* [Drupal 8 testing documentation](https://www.drupal.org/docs/8/testing)
* [Workshop: Automated Testing and Test Driven Development in Drupal 8](https://github.com/opdavies/workshop-drupal-automated-testing)
