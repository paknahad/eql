<?php

namespace Meysampg\Eql\Contracts;

/**
 * Interface DSLGeneratorInterface defines the DSL generator
 *
 * @package Meysampg\Eql\Contracts
 */
interface DSLGeneratorInterface
{
    /**
     * DSLGeneratorInterface constructor.
     *
     * @param ParserInterface          $parser
     * @param ElasticDSLRulesInterface $elasticDSLRules
     */
    public function __construct(ParserInterface $parser, ElasticDSLRulesInterface $elasticDSLRules);

    /**
     * Convert the given SQL query into the ES DSL array
     *
     * @return array
     */
    public function convert(): array;

    /**
     * Set the SQL Parser
     *
     * @param ParserInterface $parser
     *
     * @return DSLGeneratorInterface
     */
    public function setParser(ParserInterface $parser): DSLGeneratorInterface;

    /**
     * Return the SQL Parser
     *
     * @return ParserInterface
     */
    public function getParser(): ParserInterface;

    /**
     * Set the elastic search query rules definition
     *
     * @param ElasticDSLRulesInterface $elasticDSLRules
     *
     * @return DSLGeneratorInterface
     */
    public function setDSLRules(ElasticDSLRulesInterface $elasticDSLRules): DSLGeneratorInterface;

    /**
     * Get the elastic search query rules definition
     *
     * @return ElasticDSLRulesInterface
     */
    public function getDSLRules(): ElasticDSLRulesInterface;
}
