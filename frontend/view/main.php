<form>
    <div class="formRow flex">
        <div class="formQuoter flex">
            <div class="formCol">
                <div class="formElement" title="Check where o search for sellers.">
                    <label for="regionFrom">From locations</label>
                    <select name="regionFrom[]" id="regionFrom" multiple size="6">
                        <?php foreach (getRegionsList() as $key => $region) { ?>
                            <option <?php if(empty($_GET) || in_array($key, $_GET['regionFrom'])) { ?> selected <?php } ?> value="<?php echo $key ?>">
                                <?php echo $region ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="formElement" title="Trades using set above tax will be hidden.">
                    <label for="clearPrices">Display buy prices with your taxes.</label>
                    <select name="clearPrices" id="clearPrices">
                        <option value="1" <?php if (isset($_GET['clearPrices']) && $_GET['clearPrices'] == 1) { ?> selected <?php } ?>>Yes</option>
                        <option value="0" <?php if (isset($_GET['clearPrices']) && $_GET['clearPrices'] == 0) { ?> selected <?php } ?>>No</option>
                    </select>
                </div>
            </div>

            <div class="formCol">
                <div class="formElement" title="Check where o search for buyers.">
                    <label for="regionTo">To locations</label>
                    <select name="regionTo[]" id="regionTo" multiple size="6">
                        <?php foreach (getRegionsList() as $key => $region) { ?>
                            <option <?php if(empty($_GET) || in_array($key, $_GET['regionTo'])) { ?> selected <?php } ?> value="<?php echo $key ?>">
                                <?php echo $region ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="formElement" title="Determines how much results will be loaded for each pair of regions.">
                    <label for="limit">Trades per region pair</label>
                    <input type="text" value="<?php echo !empty($_GET['limit']) ? $_GET['limit'] : 50 ?>" name="limit" id="limit">
                </div> 
            </div>
        </div>

        <div class="formQuoter flex">
            <div class="formCol">
                <div class="formElement" title="Minimum pre-item profit.">
                    <label for="itemProfit">Min per-item profit, ISK</label>
                    <input type="text" value="<?php echo !empty($_GET['itemProfit']) ? $_GET['itemProfit'] : 0 ?>" name="itemProfit" id="maxPrice">
                </div>

                <div class="formElement" title="Amout of money you want to get per full trade.">
                    <label for="minProfit">Minimum profit, ISK</label>
                    <input type="text" value="<?php echo !empty($_GET['minProfit']) ? $_GET['minProfit'] : 3000000 ?>" name="minProfit" id="minProfit">
                </div>

                <div class="formElement" title="Maximum buying price per item.">
                    <label for="maxPrice">Max item price, ISK</label>
                    <input type="text" value="<?php echo !empty($_GET['maxPrice']) ? $_GET['maxPrice'] : 1000000000 ?>" name="maxPrice" id="maxPrice">
                </div>
            </div>

            <div class="formCol">
                <div class="formElement" title="This is how much you can bring.">
                    <label for="shipVolume">Ship volume, m<sup>3</sup></label>
                    <input type="text" value="<?php echo !empty($_GET['shipVolume']) ? $_GET['shipVolume'] : 10000 ?>" name="shipVolume" id="shipVolume">
                </div>

                <div class="formElement" title="Usually your tax is 2% to market and 3% to broker.">
                    <label for="tax">Your general tax, %</label>
                    <input type="text" value="<?php echo !empty($_GET['tax']) ? $_GET['tax'] : 5 ?>" name="tax" id="tax">
                </div>

                <div class="formElement" title="Minimum buying price per item.">
                    <label for="minPrice">Min item price, ISK</label>
                    <input type="text" value="<?php echo !empty($_GET['minPrice']) ? $_GET['minPrice'] : 0 ?>" name="minPrice" id="maxPrice">
                </div>
            </div>
        </div>
    </div>

    <!-- Item price limit -->
    <!-- limit for pair regions to load -->

    <button class="button">Make pleasure</button>
</form>