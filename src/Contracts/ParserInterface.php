<?php

namespace Meysampg\Eql\Contracts;

/**
 * Interface ParserInterface defines the SQL parser
 *
 * @package Meysampg\Eql\Contracts
 */
interface ParserInterface
{
    /**
     * ParserInterface constructor.
     *
     * @param string $query
     */
    public function __construct(string $query);
}
