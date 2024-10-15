<?php
declare(strict_types=1);

use Service\PlanTalkMore;

if ($argc !== 5) {
    echo "Usage: php PlanTalkMore.php <origin> <destiny> <time> <plan>\n";
    exit(1);
}

(new PlanTalkMore($argv[1], $argv[2], (int) $argv[3], (int) $argv[4]));
