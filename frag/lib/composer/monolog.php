<?php
declare(strict_types=1);
namespace frag\lib\composer;
use DateTimeZone;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
class monolog extends Logger
{
    public function __construct(string $name, array $handlers = [], array $processors = [], DateTimeZone $timezone = null)
    {
        parent::__construct($name, $handlers, $processors, $timezone);
    }
}
