<?php 
    defined('lock_key') or die('В доступе отказано!');
?>
<nav>
<div id="block-search" class="container" style="margin: 20px;">
    <div class="col-md-6 col-md-offset-4 col-sm-6 col-sm-offset-4 col-xs-6 col-xs-offset-3 col-lg-6 col-lg-offset-4">

        <!-- Search Form -->
        <form role="form" method="GET" action="search.php?q=" style="height: 34px;">
        
        <!-- Search Field -->
            <div class="row">
                <div class="form-group">
                    <div class="input-group">
                        <input id="input-search" class="inputing form-control" type="text" name="q" placeholder="Поиск по заголовку товара..." required value="<?php echo $search; ?>"/>
                        <span class="input-group-btn">
                            <button class="btn btn-success button-search" type="submit"><span class="glyphicon glyphicon-search" aria-hidden="true"><span style="margin-left:10px;">Поиск</span></button>
                        </span>
                        </span>
                    </div>
                </div>
            </div>
            
        </form>
        <ul id="result-search">    
        </ul>
            
    </div>
</div>
</nav>