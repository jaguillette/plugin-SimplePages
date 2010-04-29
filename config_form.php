<div class="field">
    <label for="simple_pages_filter_page_content">Filter HTML For Page Content?</label>
    <div class="inputs">
    <?php echo __v()->formCheckbox('simple_pages_filter_page_content', true, 
    array('checked'=>(boolean)get_option('simple_pages_filter_page_content'))); ?>
        <p class="explanation">If checked, Simple Pages will attempt to filter the 
        HTML provided for the content of static pages using the default settings. 
        Note that PHP code will not be allowed in the content of pages if this box is checked.</p>
    </div>
</div>

