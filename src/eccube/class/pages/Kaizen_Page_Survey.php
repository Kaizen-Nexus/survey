<?php
namespace KaizenNexus\Survey\Eccube\Class\Pages;
// require_once (MODULE_REALDIR . 'kaizen_survey/inc/include.php');
// require_once CLASS_EX_REALDIR . 'page_extends/admin/LC_Page_Admin_Ex.php';
// require_once KAIZEN_SURVEY_PATH. 'enums/SurveyEnums.php';

use KaizenNexus\Survey\SurveyService;
class Kaizen_Page_Survey extends \LC_Page_Admin_Ex
{
    public function init()
    {
        // $this->skip_load_page_layout = true;
        // parent::init();
        // $this->setTemplate(KAIZEN_SURVEY_TEMPLATE_PATH.'survey_template.tpl');
        // $this->tpl_mainpage = KAIZEN_SURVEY_TEMPLATE_PATH.'survey/index.tpl';
        // $this->tpl_mainno = 'webview';
        // $this->tpl_title    = 'アンケート・申請フォーム';
        // $this->tpl_subtitle = 'メールアドレス';
        // $this->httpCacheControl('nocache');
    }
    /**
     * Page のプロセス.
     *
     * @return void
     */
    public function process()
    {
        parent::process();
        $this->action();
        $this->sendResponse();
    }
    /**
     * Page のアクション.
     *
     * @return void
     */
    public function action()
    {
        // echo SurveyEnums::SURVEY_TARGET_ISSUER;
        echo 'Updating.....';
    }

}
