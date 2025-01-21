# LocalGov Drupal

A Drupal distribution and installation profile designed to help UK and Irish councils collaborate and
share Drupal code and build a culture of publishing excellent website content for everyone.

This project is the Drupal installation profile that is best installed using
composer to require a project template, [localgov_project]([url](https://github.com/localgovdrupal/localgov_project/)), to scaffold and build
the codebase, which includes this installation profile.

## Patches

Please note, if you are using Drupal core < 10.3.6, you might want to apply
this patch for content moderation and workspaces.

 - [Patch](https://www.drupal.org/files/issues/2024-08-11/3179199-3132022-content-moderation-workspaces-query.patch)
 - [Issue](https://www.drupal.org/project/drupal/issues/3179199#comment-15711680)

## Supported branches

We are actively developing and supporting the 3.x branch for Drupal 10.

The 2.x branch is no longer officially supported, as Drupal 9 is unsupported since 1st November 2023.
We will continue to help our councils that have not yet upgraded to Drupal 10, on a best efforts basis.

The 1.x branch is no longer actively supported and not recommended for new sites.

**Important:** If you are still using the 1.x or 2.x branches on your site, please [create an issue on Github](https://github.com/localgovdrupal/localgov/issues) to let us know.

## Documentation

Further documentation for developers, content designers and other audiences can
be found at [https://docs.localgovdrupal.org/](https://docs.localgovdrupal.org/).

## Requirements for installing LocalGov Drupal locally for testing and development

To install LocalGov Drupal locally you will need an appropriate versions of:

 - PHP (see https://www.drupal.org/docs/system-requirements/php-requirements)
 - A database server like MySQL (see https://www.drupal.org/docs/system-requirements/database-server-requirements)
 - A web server like Apache2 (see https://www.drupal.org/docs/system-requirements/web-server-requirements)

Many of us use the Lando file included to run a local docker environmnent for testing and development, but some people prefer to run the web servers natively on their host machine.

We also include default DDEV configuration for developers that prefer DDEV. [Visit our DDEV docs page](https://docs.localgovdrupal.org/devs/getting-started/working-with-ddev.html#working-with-ddev) to see how to get set up.

### PHP requirements

We folllow Drupal's PHP recomendations: https://www.drupal.org/docs/system-requirements/php-requirements#versions

We currently recomend PHP 8.1 also aim to support PHP PHP 8.2 in line with Drupal 10's PHP support.

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
composer create-project localgovdrupal/localgov-project:^3.0 MY_PROJECT --no-install
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
composer create-project localgovdrupal/localgov-project:^3.0 MY_PROJECT --no-cache  --no-install
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
COMPOSER_MEMORY_LIMIT=-1 composer create-project localgovdrupal/localgov-project:^3.0 MY_PROJECT
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

## Security policy

It is important to have a way to report security issues safely and securely. Luckily this is something Drupal has done very well for many years, via the security team. We publish our distributions on drupal.org and opt in to the [security advisory policy](https://www.drupal.org/security-advisory-policy)..

See https://www.drupal.org/drupal-security-team/general-information

### How to report a security issue

If you discover or learn about a potential error, weakness, or threat that can compromise the security of Drupal, LocalGov Drupal or LocalGov Drupal Microsites, we ask you to keep it confidential and [submit your concern to the Drupal security team](http://drupal.org/node/101494).

## Maintainers

This project is currently maintained by:

 - Andy Broomfield: https://www.drupal.org/u/andybroomfield
 - Ekes: https://www.drupal.org/u/ekes
 - Finn Lewis: https://www.drupal.org/u/finn-lewis
 - Maria Young: https://www.drupal.org/u/mariay-0
 - Mark Conroy: https://www.drupal.org/u/markconroy
 - Stephen Cox: https://www.drupal.org/u/stephen-cox
