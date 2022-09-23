<?php

/**
 * UnknownModelType
 *
 * @category PhpPlantUML\PlantUML\Exception
 * @package PhpPlantUML\PlantUML\Exception
 * @author Daniel Tlach <daniel@tlach.cz>
 * @copyright danaketh, s.r.o.
 * @license https://choosealicense.com/licenses/mit/ MIT License
 * @link https://github.com/danaketh/php-plantuml
 */

declare(strict_types=1);

namespace PhpPlantUML\PlantUML\Exception;

use Exception;
use Throwable;

final class UnknownModelType extends Exception
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
