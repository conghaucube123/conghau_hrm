<?php
    class LanguageLoader
    {
        function languageSwitch()
        {
            $ci =& get_instance();
            $ci->load->helper('language');
            $ci->load->helper('cookie');
            $siteLang = get_cookie('language');
            if ($siteLang) {
                $ci->lang->load('all', $siteLang);
            } else {
                $ci->lang->load('all', 'english');
            }
        }
    }