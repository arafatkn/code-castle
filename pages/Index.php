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
            __('Code Castle', 'code-castle'),
            __('Code Castle', 'code-castle'),
            'manage_options',
            'code-castle',
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
        $tab = isset($_GET['tab']) ? sanitize_text_field($_GET['tab']) : $default_tab;

        $tabs = [
                'phpinfo' => __('PHP Info', 'code-castle'),
                'dbinfo' => __('DB Info', 'code-castle'),
                'more' => __('More', 'code-castle'),
        ];

        ?>
        <!-- Our admin page content should all be inside .wrap -->
        <div class="wrap">
            <!-- Print the page title -->
            <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
            <!-- Here are our tabs -->
            <nav class="nav-tab-wrapper">
                <a href="?page=code-castle" class="nav-tab <?php if($tab===null):?>nav-tab-active<?php endif; ?>">Overview</a>
                <?php foreach ($tabs as $key => $name): ?>
                <a href="?page=code-castle&tab=<?php echo $key; ?>" class="nav-tab <?php if($tab===$key):?>nav-tab-active<?php endif; ?>"><?php echo $name; ?></a>
                <?php endforeach; ?>
            </nav>

            <div class="tab-content" style="padding: 10px">
                <?php switch($tab) :
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