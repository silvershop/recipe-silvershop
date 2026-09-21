<?php

require_once __DIR__ . '/../vendor/silverstripe/cms/tests/bootstrap.php';

// The CMS bootstrap mocks a project by writing Page/PageController into app/code
// at runtime, which is long after Composer dumped its autoloader — so those two
// classes are unresolvable by the time PHPUnit loads test classes that extend
// them. This recipe has no app directory of its own, so include them by hand.
$projectPath = (defined('BASE_PATH') ? BASE_PATH : getcwd()) . '/app/code';

foreach (['Page', 'PageController'] as $class) {
    if (!class_exists($class, false) && file_exists($projectPath . '/' . $class . '.php')) {
        require_once $projectPath . '/' . $class . '.php';
    }
}
