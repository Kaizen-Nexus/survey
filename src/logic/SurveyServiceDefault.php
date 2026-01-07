<?php
namespace KaizenNexus\Survey\Logic;

use KaizenNexus\Survey\Adapters;
use KaizenNexus\Survey\SurveyService;

class SurveyServiceDefault implements SurveyServiceInterface
{
    private Adapters $adapters;

    public function __construct(Adapters $adapters)
    {
        $this->adapters = $adapters;
    }

    /**
     * Core method for main action
     */
    public function doSomething(): string
    {
        $objQuery = $this->adapters->getQuery();
        $this->adapters->getUtils()->sfDispSiteError('FREE_ERROR_MSG');

        var_dump($objQuery);

        return "Survey Service update!!!";
    }

    /**
     * Core method to return survey data
     */
    public function action(): array
    {
        $helper = $this->adapters->getHelperSurvey();
        return $helper->getSurvey();
    }

    /**
     * Optional hook called during SurveyService::init()
     * Default implementation does nothing
     */
    public function init(?SurveyService $service = null): void
    {
        // no-op by default
    }

    /**
     * Optional hook called during SurveyService::process()
     * Default implementation does nothing
     */
    public function process(?SurveyService $service = null): void
    {
        // no-op by default
    }
}
