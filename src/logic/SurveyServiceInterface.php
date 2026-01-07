<?php
namespace KaizenNexus\Survey\Logic;
use KaizenNexus\Survey\SurveyService;

interface SurveyServiceInterface
{
    public function init(?SurveyService $service = null): void;
    public function process(?SurveyService $service = null): void;
    public function doSomething(): string;
    public function action(): array;
}
