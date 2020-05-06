# Contribution guidelines

## Coding standards

All shared Drupal code (modules, themes, patches) should aim to follow the
Drupal best practices and coding standards as defined on drupal.org:

* https://www.drupal.org/docs/develop/standards
* https://www.drupal.org/docs/develop/standards/coding-standards

Automated code scanning  and linting should be used to highlight places where
standards are not met and to help developers ensure their code is compliant.

## Documentation

A README.md file should be included with each code project that will allow the
intended audience to understand what the module or theme provides, installation,
configuration and troubleshooting recommendations. The format of the README.md
should follow the Drupal community’s best practice guidelines, for example see
the README template.

All functions and methods should be preceded by a docblock, detailing what the
function/method does, its arguments, return value and any exceptions thrown.
In-line code comments are encouraged, particularly when the function of a
particular block of code is not obvious.

For more guidance on documenting code see: [Drupal API documentation and comment
standards](https://www.drupal.org/docs/develop/standards/api-documentation-and-comment-standards)

## Automated tests

Developers on this project will embrace the philosophy of using automated tests,
consisting of both unit tests (which test the functionality of classes at a low
level) and functional tests (which test the functionality of Drupal systems at a
higher level, usually involving web output). The goal is to have test coverage
for all or most of the components and features, and to run the automated tests
before any code is changed or added, to make sure it doesn't break any existing
functionality (regression testing).

* When making a branch or a patch to fix a bug, make sure that the bug fix
includes a test that fails without the code change and passes with the code
change. This helps reviewers understand what the bug is, demonstrates that the
code actually fixes the bug, and ensures the bug will not reappear due to later
code changes.

* When making a branch or patch to implement a new feature, include new unit
and/or functional tests in the changes. This serves to both demonstrate that the
code actually works, and ensure that later changes do not break the new
functionality.

Tests should be written using the PHPUnit testing framework in a standard way so
that they can be run by developers in their local development environment and
automatically in some sort of continuous integration testing environment.

For guidance on writing tests see:
<https://www.drupal.org/docs/8/testing/phpunit-in-drupal-8>

## Branching

All code contributions will follow the GitLab flow branching model.

* A master branch where current code is being tested and developed.
* Feature branches for new work that:
  * branch off from the master branch for development
  * are merged back to the master branch via pull request which is reviewed by
  another committer before merging.

A production branch that maintains the state of the latest release.

See [production branch with GitLab flow](https://docs.gitlab.com/ee/topics/gitlab_flow.html#production-branch-with-gitlab-flow)
for more background.

## Accessibility

All public facing content and functionality should adhere to WCAG 2.1 AA at
minimum. While we note that to a large extent this is something that depends on
content management, nothing that is committed to the shared codebase should
prevent users adhering to WCAG 2.1 AA.
