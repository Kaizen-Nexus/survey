<?
namespace KaizenNexus\Survey;
class LC_Page_Survey extends \LC_Page_Admin_Ex
{
    
    public function init()
    {
        $this->pkgDir = __DIR__;
        $this->skip_load_page_layout = true;
        parent::init();
        $this->setTemplate($this->pkgDir.'/templates/survey_template.tpl');
        $this->tpl_mainpage = __DIR__.'/templates/survey/index.tpl';
        $this->tpl_mainno = 'webview';
        $this->tpl_title    = 'アンケート・申請フォーム';
        $this->tpl_subtitle = 'メールアドレス';
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
        // echo 'Updating.....'. __DIR__;
        // echo 'TPL DIR >>'. $this->pkgDir.'/templates/survey_template.tpl';
        // echo 'TplmainPage >>'. $this->tpl_mainpage;
    }

}
