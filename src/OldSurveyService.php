<?php
namespace KaizenNexus\Survey;

// Load legacy EC-CUBE 2 admin page class
require_once(CLASS_EX_REALDIR . "page_extends/admin/LC_Page_Admin_Ex.php");

class OldSurveyService extends \LC_Page_Admin_Ex
{
    /**
     * Initialize page
     */
    public function init(): void
    {
        parent::init();

        // Your admin page template settings
        $this->tpl_mainno    = 'order';
        $this->tpl_subno     = 'status';
        $this->tpl_maintitle = '受注管理';
        $this->tpl_subtitle  = '決済状況管理';

        $this->setTemplate('web/survey/survey_template.tpl');
        $this->tpl_mainpage = 'web/survey/index.tpl';
    }
    public function process()
    {
        parent::process();
        $this->action();
        $this->sendResponse();
    }

    /**
     * Example method using EC-CUBE legacy classes
     */
    public function doSomething(): string
    {
        // SC_Query_Ex singleton
        $objQuery = \SC_Query_Ex::getSingletonInstance();

        // Display an error using EC-CUBE utility class
        \SC_Utils_Ex::sfDispSiteError(FREE_ERROR_MSG, '', false, 'Permission Error');

        var_dump($objQuery);

        return "Survey Service update!!!";
    }
    public function action()
    {
        // SC_Helper_Survey is inside package
        $surveyData = SC_Helper_Survey::getSurvey();
    }
}
