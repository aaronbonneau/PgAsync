<?php

namespace PgAsync\Command;

use PgAsync\Message\Message;
use Rx\Subject\Subject;

class Query implements CommandInterface
{
    use CommandTrait;

    protected $queryString = "";

    public function __construct($queryString)
    {
        $this->queryString = $queryString;

        $this->subject = new Subject();
    }

    public function encodedMessage()
    {
        return "Q" . Message::prependLengthInt32($this->queryString . "\0");
    }

    public function shouldWaitForComplete()
    {
        return true;
    }

    /**
     * @return string
     */
    public function getQueryString()
    {
        return $this->queryString;
    }
}
