<?php

function get_template($view)
{
    $_this = &get_instance();

    return $_this->load->view($view);
}
