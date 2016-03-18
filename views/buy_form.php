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
        <div>
            <img src="https://www.wise-owl.com/media/cache/education_article_show/uploads/education_articles/5da0dbce9b04_how-to-buy-and-sell-shares.jpg" class="img-responsive" alt="Responsive image">
        </div>
    </fieldset>
</form>