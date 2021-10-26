<?php


namespace Arafatkn\WpDens\Pages;


class DbInfo
{
    public function show()
    {
        global $wpdb;

        $dbtables = $wpdb->tables();
        $tables = [];

        foreach ($dbtables as $table) {
            $tables[] = [
                'name' => $table,
                'rows' => $wpdb->get_var( "SELECT COUNT(*) FROM " . $table )
            ];
        }

        usort($tables, function ($a, $b) {
            return $a['name'] > $b['name'];
        }); 
        ?>

        <div class="wp-dens-info-container">

            <div>
                <h3>DB Tables</h3>
                <table class="wp-dens-info-table">
                    <?php foreach ($tables as $table): ?>
                    <tr>
                        <td><?php echo $table['name']; ?></td>
                        <td><?php echo $table['rows']; ?> rows</td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>

        </div>

        <?php
    }
}