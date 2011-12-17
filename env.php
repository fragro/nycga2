<?php
/**
 * WordPress
 */
define( 'DB_NAME', 'nycga' );
define( 'DB_USER', 'root' );
define( 'DB_PASSWORD', '2B5N6LIhOOoY52XGNECM' );
define( 'DB_HOST', 'gatulsa-occupytulsa.dotcloud.com:19888' );

/**
 * bbPress (BP version)
 *
 * These should be the same as your WP info
 */
define( 'BBDB_NAME', 'nycga' );
define( 'BBDB_USER', 'root' );
define( 'BBDB_PASSWORD', '2B5N6LIhOOoY52XGNECM' );
define( 'BBDB_HOST', 'gatulsa-occupytulsa.dotcloud.com:19888' );

/**
 * Other environment specific constants
 */

// Only change this on production sites!
define( 'IS_LOCAL_ENV', false );

// Many installed plugins will flood you with errors, so use this only when necessary for debugging
define( 'WP_DEBUG', false ); 

// Unless you walk through the cache setup on your local installation, you'll want to keep this shut off
define( 'WP_CACHE', false );

define( 'WP_MEMORY_LIMIT', '128M' );

?>
