<form action="buy.php" method="post">
    <fieldset>
        <div class="form-group">
            <input autofocus class="form-control" value="<?= $symbol ?>" name="symbol" placeholder="Symbol" type="text"/>
        </div>
        
        <div class="form-group">
            <input autofocus class="form-control" name="shares" placeholder="Shares" type="text"/>
        </div>
        
        <div class="form-group">
            <button type="submit" class="btn btn-default"> Buy 
            <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
            </button>
        </div>
    </fieldset>
</form>