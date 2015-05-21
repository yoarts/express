<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
  <div class="input-group">
    <input type="search" value="<?php if ( is_search() ) { echo esc_attr( get_search_query() ); } ?>" name="s" class="search-field form-control" placeholder="<?php _e( 'Search', 'express' ); ?>">
    <label class="sr-only"><?php _e('Search for:', 'express'); ?></label>
    <span class="input-group-btn">
      <button type="submit" class="search-submit btn btn-default"><?php _e('<i class="fa fa-search"></i>', 'express'); ?></button>
    </span>
  </div>
</form>
