<?php
namespace KaizenNexus\Survey\Adapters;

require_once(CLASS_EX_REALDIR . "page_extends/admin/LC_Page_Admin_Ex.php");
// require other SC_/GC_/LC_ classes as needed

class Adapters
{
    private array $instances = [];

    public function __construct(array $overrides = [])
    {
        $this->instances = $overrides;
    }
    public function get(string $key, callable $default): object
    {
        return $this->instances[$key] ?? $default();
    }


    public function getQuery(): \SC_Query_Ex
    {
        return \SC_Query_Ex::getSingletonInstance();
    }

    public function getUtils(): \SC_Utils_Ex
    {
        return new \SC_Utils_Ex();
    }

    public function getAdminPage(): \LC_Page_Admin_Ex
    {
        return new \LC_Page_Admin_Ex();
    }

    public function getHelperSurvey(): \SC_Helper_Survey
    {
        return $this->get('helperSurvey', fn() => new \SC_Helper_Survey());
    }


    // Add more as needed
}
