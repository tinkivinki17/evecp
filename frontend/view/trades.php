<div class="innerWrapper">
    <div class="title switcher" id="items">Unique list of items</div>
    <div class="items">
        <ul>
            <?php foreach ($uniqueItemsList as $name => $link) { ?>
               <li><a target="_blank" href="<?php echo $link; ?>"><?php echo $name; ?></a></li>
            <?php } ?>
        </ul>
    </div>

    <div class="title switcher" id="trades">List of possible trades</div>
    <div class="trades">
        <table cellpadding="0" cellspacing="0">
            <?php foreach($trades as $trade) { ?>
                <tr class="part">
                    <td>
                        <a target="_blank" href="<?php echo $trade['link']; ?>">
                            <?php echo $trade['item']; ?>
                        </a>
                        <div class="capital">You need: <span><?php echo fVal($trade['capital']); ?></span></div>
                    </td>
                    <td class="destinaition">
                        <div><?php echo $trade['from']; ?></div>
                        <div><?php echo $trade['to']; ?></div>
                    </td>
                    <td class="jumps">
                        <span><?php echo $trade['jumps']; ?></span> Jumps
                    </td>
                </tr>

                <tr class="prices part">
                    <td class="sellPrice"><span>Sell price:</span> <?php echo fVal($trade['sellPrice']); ?></td>
                    <td class="buyPrice<?php echo ($clearPrices == 1) ? ' clearPrice' : ''; ?>">
                        <span>Buy price:</span>  <?php echo fVal($trade['buyPrice']); ?>
                    </td>
                    <td class="itemProfit"><span>Per-unit profit:</span> <?php echo fVal($trade['itemProfit']) ?></td>
                </tr>

                <tr class="totals part">
                    <td class="sellAmount"><span>Sell amount:</span> <?php echo fVal($trade['sellAmount']); ?></td>
                    <td class="buyAmount"><span>Buy amount:</span> <?php echo fVal($trade['buyAmount']); ?></td>
                    <td class="totalProfit"><span>Total profit:</span> <?php echo fVal($trade['totalProfit']); ?></td>
                </tr>

                <tr><td colspan="3" class="devider"></td></tr>
            <?php } ?>
        </table>
    </div>
</div>