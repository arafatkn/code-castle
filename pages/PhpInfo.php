<?php

namespace Arafatkn\WpDens\Pages;

class PhpInfo
{
    public function show()
    {
        ?>
        <style scoped type="text/css">
            pre {margin: 0; font-family: monospace;}
            table {border-collapse: collapse; border: 0; width: 934px; box-shadow: 1px 2px 3px #ccc;}
            .center {text-align: center;}
            .center table {margin: 1em auto; text-align: left;}
            .center th {text-align: center !important;}
            td, th {border: 1px solid #666; font-size: 75%; vertical-align: baseline; padding: 4px 5px;}
            th {position: sticky; top: 0; background: inherit;}
            h1 {font-size: 150%;}
            h2 {font-size: 125%;}
            .p {text-align: left;}
            .e {background-color: #ccf; width: 300px; font-weight: bold;}
            .h {background-color: #99c; font-weight: bold;}
            .v {background-color: #ddd; max-width: 300px; overflow-x: auto; word-wrap: break-word;}
            .v i {color: #999;}
            img {float: right; border: 0;}
            hr {width: 934px; background-color: #ccc; border: 0; height: 1px;}
        </style>
        <div style="border: 1px solid #cef; margin: 10px 0; padding: 10px 0;" id="wp-dens-phpinfo">
            <?php
            ob_start();
            phpinfo();
            $info = ob_get_contents();
            ob_end_clean();
            $info = strstr( strstr( $info, '<body>' ), '</body>', true );
            echo wp_kses_post( substr( $info, 6 ) );
            ?>
        </div>
        <?php
    }
}