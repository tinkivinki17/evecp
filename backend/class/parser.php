<?php 
Class Parser extends Base {
    protected $linksToParse;
    protected $parsedHtml;

    public function __construct($linksToParse)
    {
        parent::__construct();
        $this->linksToParse = $linksToParse;
    }

    public function execute()
    {
        try {
            if (!validateGet()) {
                throw new Exception("Corrupted data, all fields are required.");
            }

            foreach ($this->linksToParse as $link) {
                $html = file_get_html($link);
                // Take number of possible routes.`
                $routes = $html->find('p', 2)->find('i');
                if (is_array($routes)) {
                    $routes = array_shift($routes);

                    if ($routes > 0) {
                        $data = $html->find('table', 0)->find('tr');
                        for ($i = 0; $i < count($data); $i += 5) {
                            $this->parsedHtml[$i]['from'] = str_replace('From: ', '', $data[$i]->find('td', 0)->plaintext);
                            $this->parsedHtml[$i]['to'] = str_replace('To: ', '', $data[$i]->find('td', 1)->plaintext);
                            $this->parsedHtml[$i]['jumps'] = str_replace('Jumps: ', '', $data[$i]->find('td', 2)->plaintext);
                            $this->parsedHtml[$i]['item'] = str_replace('Type: ', '', $data[$i + 1]->find('td', 0)->plaintext);
                            $this->parsedHtml[$i]['link']= "https://eve-central.com/home/" . array_shift($data[$i + 1]->find('td', 0)->find('a'))->href;
                            
                            $sellPrice = str_replace(array('Selling: ', ' ISK'), '', $data[$i + 1]->find('td', 1)->plaintext);
                            $this->parsedHtml[$i]['sellPrice'] = str_replace(',', '', $sellPrice);
                            $buyPrice = str_replace(array('Buying: ', ' ISK'), '', $data[$i + 1]->find('td', 2)->plaintext);
                            $this->parsedHtml[$i]['buyPrice'] = str_replace(',', '', $buyPrice);

                            $unitsInfo = $data[$i + 2]->find('td', 1)->plaintext;
                            $unitsInfo = str_replace(array('Units tradeable: ', ')'), '', $unitsInfo);
                            $unitsInfo = explode(' (', $unitsInfo);
                            $unitsInfo = explode(' ', $unitsInfo[1]);

                            $this->parsedHtml[$i]['sellAmount'] = str_replace(',', '', $unitsInfo[0]);
                            $this->parsedHtml[$i]['buyAmount'] = str_replace(',', '', $unitsInfo[2]);
                        }
                    }
                }
            }

            return $this->parsedHtml;
        } catch (Exception $e) {
            $this->view->renderError($e->getMessage());
        }
    }
}
