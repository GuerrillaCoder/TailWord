<div class="hidden md:flex items-center justify-end space-x-8 md:flex-1 lg:w-0">
    <a href="<?php echo wp_login_url(); ?>"
       class="whitespace-no-wrap text-base leading-6 font-medium text-gray-500 hover:text-gray-900 focus:outline-none focus:text-gray-900">
        Sign in
    </a>

    <?php
    $reg_url = wp_registration_url();
    if(get_option( 'users_can_register' ) && !empty($reg_url))
    {
        ?>
        <span class="inline-flex rounded-md shadow-sm">
                            <a href="<?php echo $reg_url; ?>"
                               class="whitespace-no-wrap inline-flex items-center justify-center px-4 py-2 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">
                              Sign up
                            </a>
                        </span>
        <?php
    }
    ?>
</div>