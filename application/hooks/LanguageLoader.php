<?php
    class LanguageLoader
    {
        function languageSwitch()
        {
            $ci =& get_instance();
            $ci->load->helper('language');
            $siteLang = $ci->session->userdata('site_lang');
            if ($siteLang) {
                $ci->lang->load(['message', 'title', 'status'], $siteLang);
            } else {
                $ci->lang->load(['message', 'title', 'status'], 'english');
            }
        }
    }