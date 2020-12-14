<?php declare(strict_types=1);

namespace App\Service\Youtube\Exception;

use Exception;
use Throwable;

final class NotFoundException extends Exception
{
    public function __construct(Throwable $previous = null)
    {
        parent::__construct('Not Found Exception', 2, $previous);
    }
}