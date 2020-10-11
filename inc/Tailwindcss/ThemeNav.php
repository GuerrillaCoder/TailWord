<?php

class Tailwindcss_ThemeNav
{
    public function __construct()
    {
        add_action('init', array($this, 'registerNavs'));
        add_action('wp_nav_menu_item_custom_fields', array($this, 'addIconButton'), 10, 5);

        add_action('admin_print_footer_scripts-nav-menus.php', array($this, 'addIconSelect'));
        add_filter('nav_menu_css_class', array($this,'add_additional_class_on_li'), 1, 3);
        add_filter('nav_menu_link_attributes', array($this,'add_additional_class_on_a'), 1, 3);
    }

    public function registerNavs()
    {
        register_nav_menu('header-menu', __('Header Menu'));

//        //changed to widgets
//        register_nav_menu('footer-menu-1', __('Footer Menu 1'));
//        register_nav_menu('footer-menu-2', __('Footer Menu 2'));
//        register_nav_menu('footer-menu-3', __('Footer Menu 3'));
//        register_nav_menu('footer-menu-4', __('Footer Menu 4'));
    }

    function addIconButton($item_id, $item, $depth, $args, $id)
    {
        $icon_cats = array("header-menu");
        $show = false;

        $locations      = get_registered_nav_menus();
        $menu_locations = get_nav_menu_locations();

        $nav_menu_selected_id = isset( $_REQUEST['menu'] ) ? (int) $_REQUEST['menu'] : 0;

        $selected_menus = array();

        foreach($locations as $location => $description){
            $checked = isset( $menu_locations[ $location ] ) && $menu_locations[ $location ] === $nav_menu_selected_id;

            if($checked) $selected_menus[] = $location;
        }

        foreach ($selected_menus as $menu){
            if(in_array($menu, $icon_cats)) $show = true;
        }

        if(!$show) return;

        ?>

        <div class="icon-select-row">
            <label for="select_header_icon_<?php echo $item_id ?>">Icon <br></label>
            <p class="icon-select description  description-wide " data-controller="admin-icon">

                    <div class="icon">
                        <?php $svgCode = get_field('source', $item); echo $svgCode; ?>
                    </div>
            <div class="icon-buttons">
                <input type="button" name="save_menu"
                       id="select_header_icon_<?php echo $item_id ?>"
                       class="button button-small button-primary menu-save"
                       value="Select Icon"
                       onclick="window.dispatchEvent(new CustomEvent('twicon', {
                               detail: {
                               settingNumber: <?php echo $item_id ?>
                               }}))">
                <a href="#" name="save_menu"
                   id="remove_header_icon_<?php echo $item_id ?>"
                   class="icon-remove-link button-link-delete menu-save<?php if(empty($svgCode)) echo "display-none" ?> "
                   onclick="return twRemoveIcon(<?php echo $item_id ?>)">Remove</a>
            </div>

            </p>
        </div>


        <?php
    }

    function addIconSelect()
    {
        ?>

        <div id="tw-icon-picker" class=" w-full"></div>
        <script type="application/javascript">

            // (function($){
            //
            //     $(function(){
            //         //handle icon selection
            //         $("div[data-name=source] input").change(function(event){
            //
            //             let svg = event.target.value;
            //             let menu = $(event.target).closest(".menu-item-settings");
            //             let icon = $(".icon-select-row .icon", menu);
            //             let removeLink = $(".icon-select-row .icon-remove-link", menu);
            //             if(svg)
            //             {
            //                 removeLink.removeClass("display-none");
            //             }
            //
            //             icon.html(svg);
            //             console.log();
            //
            //         })
            //     });
            // })(jQuery);

            function twRemoveIcon(menuNumber) {
                let menu = jQuery("#menu-item-settings-" + menuNumber);
                jQuery("div[data-name=source] input", menu).val("");
                jQuery(".icon-select-row .icon", menu).html("");
                jQuery(".icon-select-row .icon-remove-link", menu).addClass("display-none");
                return false;
            }
        </script>

        <?php
    }

    function add_additional_class_on_li($classes, $item, $args) {
        if(isset($args->add_li_class)) {
            $classes[] = $args->add_li_class;
        }
        return $classes;
    }

    function add_additional_class_on_a($atts, $item, $args) {
        if(isset($args->add_a_class)) {

            if(isset($atts["class"]))
            {
                $atts["class"] .= " " . $args->add_a_class;
            }
            else{
                $atts["class"] =  $args->add_a_class;
            }

        }
        return $atts;
    }
}