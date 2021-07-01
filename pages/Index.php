<?php

namespace Arafatkn\WpDens\Pages;

class Index
{
    public function __construct()
    {
        add_action( 'admin_menu', [ $this, 'admin_menu' ] );
    }

    public function admin_menu()
    {
        add_management_page(
            __( 'WP Dens', 'wp-dens' ),
            'WP Dens',
            'manage_options',
            'wp-dens',
            [ $this, 'showPage' ],
            3
        );
    }

    public function showPage()
    {
        // check user capabilities
        if ( ! current_user_can( 'manage_options' ) ) {
            return;
        }

        //Get the active tab from the $_GET param
        $default_tab = null;
        $tab = isset($_GET['tab']) ? $_GET['tab'] : $default_tab;

        $tabs = [
                'phpinfo' => 'PHP Info',
                'dbinfo' => 'DB Info',
                'more' => 'More',
        ];

        ?>
        <!-- Our admin page content should all be inside .wrap -->
        <div class="wrap">
            <!-- Print the page title -->
            <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
            <!-- Here are our tabs -->
            <nav class="nav-tab-wrapper">
                <a href="?page=wp-dens" class="nav-tab <?php if($tab===null):?>nav-tab-active<?php endif; ?>">Overview</a>
                <?php foreach ($tabs as $key => $name): ?>
                <a href="?page=wp-dens&tab=<?=$key?>" class="nav-tab <?php if($tab===$key):?>nav-tab-active<?php endif; ?>"><?=$name?></a>
                <?php endforeach; ?>
            </nav>

            <div class="tab-content" style="padding: 10px">
                <?php switch($tab) :
                    case 'settings':
                        echo 'Settings';
                        break;
                    case 'phpinfo':
                        ( new PhpInfo() )->show();
                        break;
                    case 'dbinfo':
                        ( new DbInfo() )->show();
                        break;
                    case 'more':
                        ( new MoreInfo() )->show();
                        break;
                    default:
                        ( new Information() )->show();
                        break;
                endswitch; ?>
            </div>
        </div>
        <?php
    }
}