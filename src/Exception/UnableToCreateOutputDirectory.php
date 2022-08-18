<?php

/**
 * UnableToCreateOutputDirectoryException
 *
 * @category PhpPlantUML\Exception
 * @package PhpPlantUML\Exception
 * @author Daniel Tlach <daniel@tlach.cz>
 * @copyright danaketh, s.r.o.
 * @license https://choosealicense.com/licenses/mit/ MIT License
 * @link https://github.com/danaketh/php-plantuml
 */

declare(strict_types=1);

namespace PhpPlantUML\Exception;

use Exception;
use Throwable;

final class UnableToCreateOutputDirectory extends Exception
{
    public function __construct(string $message, int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
