<?php
namespace KaizenNexus\Survey\Adapters;

class AdminPageAdapter
{
    public function createPage(): \LC_Page_Admin_Ex
    {
        require_once(CLASS_EX_REALDIR . "page_extends/admin/LC_Page_Admin_Ex.php");
        return new \LC_Page_Admin_Ex();
    }
}
