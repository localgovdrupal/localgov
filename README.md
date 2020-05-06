# LocalGovDrupal

Drupal distribution and install profile to help UK councils collaborate and
share Drupal code.

## Installing LocalGovDrupal

To install LocalGovDrupal use the
[Composer-based project template](https://github.com/localgovdrupal/localgov_project).

```bash
composer create-project  --stability dev localgovdrupal/localgov-project MY_PROJECT
```

Note: If developing locally and you want to force composer to clone again from source rather than use composer cache, you can add the --no-cache flag.

```bash
composer create-project localgovdrupal/localgov-project MY_PROJECT --stability dev --no-cache
```

## Contributing

The development and contribution processes and standards proposed in the
discovery phase can be found here:
<https://drive.google.com/open?id=1CJWkNMh6rjF6Ml-WwEwWgt9UPNpTEgODYJN3hCaySJk?>

See [CONTRIBUTING.md](CONTRIBUTING.md) for current contribution guidelines.

## Issue tracking

In the early development stages, most issues will be tracked in this respository https://github.com/localgovdrupal/localgov/issues.

Development issues relating to specific projects or module should be tracked in the project repository.
In the future we might set up a separate repository for centralised issue tracking of bug reports for end users. 



