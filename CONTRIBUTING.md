# LocalGov Drupal: Development and contribution processes and standards

The LocalGov Drupal project exists to establish and grow an active group of councils to co-develop, share and maintain open-source Drupal code for our citizen-facing websites. The primary aim is a collection of Drupal code and configuration that can help to power public facing websites. 

We recognise that Drupal development is a skill many councils will want to and be able to loan to the project. This will ensure the participating councils have at least one technical member who is able to work with the project and be informed of and influence the direction of development.

This document aims to define the standards and conventions that all contributors agree to adhere to for the shared LocalGov Drupal code.

After researching a number of successful open source communities, we have taken much influence from the Node.js contribution guidelines. 

## Assumptions

 1. We all work in the spirit of the Local Digital Declaration. 
 2. The code base is open source and publicly available.
 3. Development happens in the open as much as possible.

## Definitions

* A **Contributor** is any individual creating or commenting on an issue or pull/merge request.
* A **Committer** is a subset of contributors who have been given write access to the repository.
* The **Technical Group** is a group of committers representing the required technical expertise to resolve rare disputes.
* The **Product Group** is a group of representatives from all organisations involved, expected to include product managers and technical developers from the Technical Group, representing the collective stakeholders to guide the direction of the product. 

## Shared code repository

The shared project code lives on Github. (https://github.com/localgovdrupal)

## Logging Issues

Log an issue for any question or problem you might have in the issue queue of the shared code repository. When in doubt, log an issue. Any additional policies about what to include will be provided in the responses. The only exception is security disclosures which should be sent privately. 

Committers may direct you to another repository, ask for additional clarifications, and add appropriate metadata before the issue is addressed.

Please be courteous and respectful in all communications. Every participant is expected to follow the project's code of conduct.

## Contributions

Any change to resources in this repository must be through pull requests. This applies to all changes to documentation, code, binary files, etc. Even long term committers and Technical Group members must use pull requests.

No pull request can be merged without being reviewed by someone in a different organisation.

For non-trivial contributions, pull requests should sit for at least [48 hours]. Consideration should also be given to weekends and other holiday periods to ensure active committers all have reasonable time to become involved in the discussion and review process if they wish.

The default for each contribution is that it is accepted once no committer has an objection. During review committers may also request that a specific contributor who is most versed in a particular area gives a "Looks Good To Me" before the pull request can be merged. There is no additional "sign off" process for contributions to land. Once all issues brought by committers are addressed it can be landed by any committer.

Before a pull request is merged, code should: 

* comply with Drupal coding standards, 
* be adequately documented, 
* include automated tests for new functionality and 
* comply with accessibility standards where appropriate.

In the case of an objection being raised in a pull request by another committer, all involved committers should seek to arrive at a consensus by way of addressing concerns being expressed by discussion, compromise on the proposed change, or withdrawal of the proposed change.

If a contribution is controversial and committers cannot agree about how to resolve a dispute then it should be escalated to the Technical Group. Technical Group members should regularly discuss pending contributions in order to find a resolution. It is expected that only a small minority of issues will be brought to the Technical Group for resolution and that discussion and compromise among committers will resolve most disputes.

## Becoming a Committer

All contributors who make non-trivial contributions should be on-boarded as committers and be given write access to the repository. Committers may be developers working for a council in the group or from companies that work with councils in the group.

Committers are expected to follow this policy and continue to send pull requests, go through proper review, and have other committers merge their pull requests.

## Technical Group Process

The Technical Group uses a "consensus seeking" process for issues that are escalated to the Technical Group. The group tries to find a resolution that has no open objections among Technical Group members. If a consensus cannot be reached that has no objections then a majority wins vote is called. It is also expected that the majority of decisions made by the Technical Group are via a consensus seeking process and that voting is only used as a last-resort.

Resolution may involve returning the issue to committers with suggestions on how to move forward towards a consensus. It is not expected that a meeting of the Technical Group will resolve all issues on its agenda during that meeting and may prefer to continue the discussion happening among the committers.

Members can be added to the Technical Group at any time. Any committer can nominate another committer to the Technical Group and the Technical Group uses its standard consensus seeking process to evaluate whether or not to add this new member. Members who do not participate consistently at the level of a majority of the other members are expected to resign.

## Releases

Releases will be reviewed and approved by the Product Group on a schedule as determined by them. 

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
* A production branch that maintains the state of the latest release.

See [production branch with GitLab flow](https://docs.gitlab.com/ee/topics/gitlab_flow.html#production-branch-with-gitlab-flow)
for more background.

## Accessibility

All public facing content and functionality should adhere to WCAG 2.1 AA at
minimum. While we note that to a large extent this is something that depends on
content management, nothing that is committed to the shared codebase should
prevent users adhering to WCAG 2.1 AA.
