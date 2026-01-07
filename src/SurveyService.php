<?

namespace KaizenNexus\Survey;

use KaizenNexus\Survey\Adapters\Adapters;
use KaizenNexus\Survey\Logic\SurveyServiceInterface;
use KaizenNexus\Survey\Logic\SurveyServiceDefault;

class SurveyService extends \LC_Page_Admin_Ex
{
    private SurveyServiceInterface $logic;
    private Adapters $adapters;

    public function __construct(?Adapters $adapters = null, ?SurveyServiceInterface $logic = null)
    {
        parent::__construct();
        $this->adapters = $adapters ?? new Adapters();
        $this->logic = $logic ?? new SurveyServiceDefault($this->adapters);
    }

    public function doSomething(): string
    {
        return $this->logic->doSomething();
    }

    public function action(): array
    {
        return $this->logic->action();
    }

    // Optional: delegate init/process if needed
    public function init(): void
    {
        parent::init();
        if (method_exists($this->logic, 'init')) {
            $this->logic->init($this);
        }
    }

    public function process(): void
    {
        parent::process();
        if (method_exists($this->logic, 'process')) {
            $this->logic->process($this);
        }
    }
}
