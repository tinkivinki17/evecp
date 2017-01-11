<?php 
class Gather extends Base {
    protected $baseUrl = 'https://eve-central.com/home/tradefind_display.html';
    protected $urlParts = array(
        'size'       => '',
        'minprofit'  => '',
        'limit'      => '',
        'age'        => 24,
        'qtype'      => 'Regions',
        'newsearch'  => 1,
        'set'        => 1,
        'prefer_sec' => 1,
        'sort'       => 'profit',
    );

    protected $linksToParse;

    public function __construct()
    {
        parent::__construct();
    }

    public function execute()
    {
        try {
            if (!validateGet()) {
                throw new Exception("Corrupted data, all fields are required.");
            }

            $this->urlParts['size']      = $_GET['shipVolume'];
            $this->urlParts['minprofit'] = $_GET['minProfit'];
            $this->urlParts['limit']     = $_GET['limit'];

            foreach ($_GET['regionFrom'] as $regionFromId) {
                foreach($_GET['regionTo'] as $regionToId) {
                    $this->urlParts['fromt'] = $regionFromId;
                    $this->urlParts['to'] = $regionToId;
                    $this->linksToParse[] = $this->baseUrl . "?" . http_build_query($this->urlParts);
                }
            }
            
            return $this->linksToParse;
        } catch (Exception $e) {
            $this->view->renderError($e->getMessage());
        }
    }
}
