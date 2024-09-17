<?php

/**
 * @file
 * Hooks provided by the LocalGov install profile.
 */

/**
 * @addtogroup hooks
 * @{
 */

/**
 * Run a task during the site installation process.
 *
 * This is intended for work that needs to happen when installing a localgov
 * site, that can't happen in a module's hook_install(). This hook is invoked
 * later in the install process, when everything bar the importing of
 * translations is done.
 *
 * It can also be used to only run code during a site install, and not when a
 * module is installed in an existing site.
 */
function hook_localgov_post_install(): void {
  // Whatever your module needs to do goes here.
}

/**
 * @} End of "addtogroup hooks".
 */
