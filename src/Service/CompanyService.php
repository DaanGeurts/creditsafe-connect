<?php

namespace SynergiTech\Creditsafe\Service;

use \SynergiTech\Creditsafe\ListResult;
use \SynergiTech\Creditsafe\Models\CompanySearchResult;
use \SynergiTech\Creditsafe\Models\Company;

/**
 * This class is used by the client to call endpoints relating to a company
 */
class CompanyService
{
    private $client;
    private $id;

    /**
     * This constructor builds the CompanyServices Class
     * @param array $client This variable stores the client in the CompanyServices Class
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * This function is used to call the endpoint that searchs for companies
     * @param  array  $params Contains params that can be passed to the endpoint
     * @return array   Returns the results of the search endpoint
     */
    public function search(array $params) : ListResult
    {
        $list = new ListResult($this->client, CompanySearchResult::class, 'companies', $params);
        return $list;
    }

    /**
     * This function is used to call the endpoint that gets the company report
     * @param string $id The ID of the given company that you want to get a report for
     * @param string $reportLang
     * @return Company Returns the results of the  get endpoint
     */
    public function get(string $id, $reportLang = 'en') : Company
    {
        return new Company($this->client, $this->client->get('companies/'.$id, ['language' => $reportLang]));
    }

    /**
     * This function is used to call the endpoint that gets the search Criteria
     *  for companies based on the country code given
     * @param  array $params Contains params that can be passed to the endpoint
     * @return array    Returns the results of the  searchCriteria endpoint
     */
    public function searchCriteria(array $params) :array
    {
        return $this->client->get('companies/searchcriteria', $params);
    }
}
