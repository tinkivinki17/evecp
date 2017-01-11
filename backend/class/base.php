<?php
class Base
{
    // View lib.
    public $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public function execute()
    {
        $this->view->addTemplate('main');
        if (!empty($_GET)) {
            $gather = new Gather();
            $linksToParse = $gather->execute();

            $parser = new Parser($linksToParse);
            $parsedHtml = $parser->execute();

            $analyzer  = new Analyzer($parsedHtml);
            $analyzer->execute();
        }
        $this->view->render();
    }
}
