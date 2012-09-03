<div class="box">
    <div class="box-heading"><?= $heading_title ?></div>
    <div class="box-content">
        <form id="autocomplete_search">
            <input type="hidden" name="route" value="product/search" />
            <input type="text" name="filter_name" value="<?= $filter_name ?>" style="margin-bottom: 10px;" />
            <input type="submit" value="<?= $button_search ?>" class="button" />
        </form>
    </div>
</div>
<script type="text/javascript">
    $('#autocomplete_search').submit(function() {
        action = location.href;
        action = action.split('?');
        action = action[0];
        action = action + "?route=" + $('#autocomplete_search > input[name="route"]').val();
        
        if($('#autocomplete_search > input[name="filter_name"]').val() != '') {
            action = action + "&filter_name=" + $('#autocomplete_search > input[name="filter_name"]').val();
        }
        
        location.href = action;
        
        return false;
    });
    
    $('#autocomplete_search > input[name="filter_name"]').autocomplete({
        source    : "?route=module/autocompletesearch/search",
        minLength : <?= $module_config_minimum ?>
    });
</script>