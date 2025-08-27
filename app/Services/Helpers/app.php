<?php

    /**
     * @param string : user's name | app_name default value
     * @return string : url of resource from https://ui-avatars.com
     */
    if (!function_exists('uiavatar')) 
    {     
        function uiavatar($name) 
        {
            return 'https://ui-avatars.com/api/?name='.str_replace(' ', '+', $name);
        }
    }  


    /**
     * @param string : user's name | app_name default value
     * @return string : url of resource from https://ui-avatars.com
     */
    if (!function_exists('isauthorized')) 
    {     
        function isauthorized(array $authorizedIds) 
        {
            return in_array(auth()->user()->group_id, $authorizedIds);
        }
    }  
