<?php declare(strict_types=1);

namespace App\Service\Youtube\Exception;

use Exception;
use Throwable;

final class ServerException extends Exception
{
    public function __construct(Throwable $previous = null)
    {
        parent::__construct('Server Exception', 1, $previous);
    }
}
