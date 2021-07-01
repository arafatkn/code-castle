<?php

namespace Arafatkn\WpDens\Pages;

class Information
{
    public function show()
    {
        global $wpdb;

        $theme = wp_get_theme( get_stylesheet() );
?>

    <div class="wp-dens-info-container">

        <div>
            <h3>WP Info</h3>
            <table class="wp-dens-info-table">
                <tr>
                    <td>WP Version</td>
                    <td><?=get_bloginfo( 'version' )?></td>
                </tr>
                <tr>
                    <td>Language</td>
                    <td><?=get_locale()?></td>
                </tr>
                <tr>
                    <td>Multisite</td>
                    <td><?=is_multisite() ? 'Yes' : 'No'?></td>
                </tr>
                <tr>
                    <td>Debug Mode</td>
                    <td><?=( defined('WP_DEBUG') && WP_DEBUG ) ? 'On' : 'Off'?></td>
                </tr>
                <tr>
                    <td>Theme Name</td>
                    <td><?=$theme->get( 'Name' )?></td>
                </tr>
                <tr>
                    <td>Theme Slug</td>
                    <td><?=get_stylesheet()?></td>
                </tr>
                <tr>
                    <td>Theme Version</td>
                    <td><?=$theme->get( 'Version' )?></td>
                </tr>
                <tr>
                    <td>Theme Author</td>
                    <td><?=$theme->get( 'Name' )?></td>
                </tr>
                <tr>
                    <td>Theme Url</td>
                    <td><?=$theme->get( 'ThemeURI' )?></td>
                </tr>
            </table>
        </div>

        <div>
            <h3>Server Info</h3>
            <table class="wp-dens-info-table">
                <tr>
                    <td>Server Software</td>
                    <td><?=$_SERVER['SERVER_SOFTWARE']?></td>
                </tr>
                <tr>
                    <td>Server Protocol</td>
                    <td><?=$_SERVER["SERVER_PROTOCOL"]?></td>
                </tr>
                <tr>
                    <td>PHP Version</td>
                    <td><?=phpversion()?></td>
                </tr>
                <tr>
                    <td>Max File Upload Size</td>
                    <td><?=size_format( wp_max_upload_size() )?></td>
                </tr>
                <tr>
                    <td>Memory Limit</td>
                    <td><?=WP_MEMORY_LIMIT?></td>
                </tr>
                <tr>
                    <td>Max Execution Time</td>
                    <td><?=ini_get('max_execution_time')?> seconds</td>
                </tr>
                <tr>
                    <td>Server Timezone</td>
                    <td><?=date_default_timezone_get()?></td>
                </tr>
                <tr>
                    <td>Server Time</td>
                    <td><?=date('Y-m-d H:i:s A')?> <?=date_default_timezone_get()?></td>
                </tr>
                <tr>
                    <td>PHP CURL</td>
                    <td><?=function_exists( 'curl_init' ) ? 'Yes' : 'No'?></td>
                </tr>
            </table>
        </div>

        <div>
            <h3>DB Info</h3>
            <table class="wp-dens-info-table">
                <tr>
                    <td>DB Extension</td>
                    <td><?=$wpdb->use_mysqli ? 'mysqli' : 'mysql' ?></td>
                </tr>
                <tr>
                    <td>DB Version</td>
                    <td><?=$wpdb->db_version()?></td>
                </tr>
                <tr>
                    <td>Table Prefix</td>
                    <td><?=$wpdb->base_prefix?></td>
                </tr>
                <tr>
                    <td>DB Charset</td>
                    <td><?=$wpdb->charset?></td>
                </tr>
                <tr>
                    <td>DB Collate</td>
                    <td><?=$wpdb->collate?></td>
                </tr>
                <tr>
                    <td>DB Host</td>
                    <td><?=DB_HOST?></td>
                </tr>
                <tr>
                    <td>DB Name</td>
                    <td><?=DB_NAME?></td>
                </tr>
                <tr>
                    <td>DB User</td>
                    <td><?=DB_USER?></td>
                </tr>
            </table>
        </div>

    </div>
<?php
    }
}