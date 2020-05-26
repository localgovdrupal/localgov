# LocalGovDrupal

Drupal distribution and install profile to help UK councils collaborate and
share Drupal code.

## Installing LocalGovDrupal

To install LocalGovDrupal use the
[Composer-based project template](https://github.com/localgovdrupal/localgov_project).

```bash
composer create-project --stability dev localgovdrupal/localgov-project MY_PROJECT
```

**Note**: If developing locally and you want to force composer to clone again
from source rather than use composer cache, you can add the `--no-cache` flag.

```bash
composer create-project localgovdrupal/localgov-project MY_PROJECT --stability dev --no-cache
```

If you just want to pull in the latest changes to LocalGovDrupal run composer
update with the `--no-cache` flag.

```bash
composer update --no-cache
```

If you want to be sure you are getting the latest commits when developing, clearing composer cache, deleting the folders and re-running composer update seems to be a solid approach:

```bash
rm -rf web/profiles/contrib/ web/modules/contrib/; 
composer clear-cache; composer update --with-dependencies --no-cache; 
lando drush si localgov -y;
```

## Contributing

The development and contribution processes and standards proposed in the
discovery phase can be found here:
<https://drive.google.com/open?id=1CJWkNMh6rjF6Ml-WwEwWgt9UPNpTEgODYJN3hCaySJk?>

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
running the LocalGovDrupal test suite.

To run all LocalGicDrupal tests with Lando use:

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
