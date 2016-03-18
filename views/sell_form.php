<form action = "sell.php" method = post>
        <fieldset>
            <div class = "form-group">
                <select class = "form-control" name = "symbol">
                    <option value = "symbol">Symbol</option>
                    <?php 
                    foreach($symbols as $symbol)
                    {
                        echo'<option value="'.$symbol["symbol"].'">'.$symbol["symbol"].'</option>';
                    }
                    ?>
                </select>
            </div>
            <div class = "form-group">
                <input autofocus class = "form-control" name="sell_share" placeholder="Number of shares" type="text"/>
            </div>
            <div class="form-group">
                <button class="btn btn-default" type="submit">
                    <span aria-hidden="true" class="glyphicon glyphicon-log-in"></span>
                    Sell
                </button>
            </div>
            <div>
                <img src="https://assets.entrepreneur.com/blog/h1/sell-shares-without-going-public.jpg" class="img-responsive" alt="Responsive image">
        </div>
            </div>
        </fieldset>
</form>