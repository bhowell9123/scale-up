<?php

/**
 * Theme index file
 */

use function Roots\app;

/**
 * Render the view using Acorn
 */
echo app('view')->make('index')->render();