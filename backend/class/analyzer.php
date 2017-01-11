<?php 
class Analyzer extends Base {
    protected $parsedHtml;
    protected $uniqueItemsList;
    protected $analyzedTrades;

    public function __construct($parsedHtml)
    {
        parent::__construct();
        $this->parsedHtml = $parsedHtml;
    }

    public function execute()
    {
        try {
            if (!validateGet()) {
                throw new Exception("Corrupted data, all fields are required.");
            }

            foreach ($this->parsedHtml as $key => $item) {
                if (($item['sellPrice'] < $_GET['maxPrice']) && ($item['sellPrice'] > $_GET['minPrice'])) {
                    if ($_GET['clearPrices'] == 1) {
                        $item['buyPrice'] = $item['buyPrice'] * (100 - $_GET['tax']) / 100;
                    }
                    
                    $profit = $item['buyPrice'] - $item['sellPrice'];

                    if (($profit > 0) && ($profit > $_GET['itemProfit'])) {
                        $totalProfit = min($item['sellAmount'], $item['buyAmount']) * $profit;
                        if ($totalProfit > $_GET['minProfit']) {
                            $this->analyzedTrades[$key] = $item;
                            $this->analyzedTrades[$key]['itemProfit'] = $profit;
                            $this->analyzedTrades[$key]['totalProfit'] = $totalProfit;
                            $this->analyzedTrades[$key]['capital'] = min($item['sellAmount'], $item['buyAmount']) * $item['sellPrice'];

                            // Add this item as enough tradable.
                            $this->uniqueItemsList[$item['item']] = $item['link'];
                        }
                    }
                }
            }

            if (empty($this->analyzedTrades)) {
                throw new Exception("There are no any trades for you pleasure, master.");
            }

            $this->view->set('clearPrices', $_GET['clearPrices'])
                       ->set('uniqueItemsList', $this->uniqueItemsList)
                       ->set('trades', $this->analyzedTrades)
                       ->addTemplate('trades')
                       ->render();

        } catch (Exception $e) {
            $this->view->renderError($e->getMessage());
        }
    }
}
