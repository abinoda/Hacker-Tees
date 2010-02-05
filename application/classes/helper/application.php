<?php defined('SYSPATH') or die('No direct script access.');

class Helper_Application {
    
    public static function title(array $sections, $delimiter = ' | ')
    {
        $title = '';
        
        $i = 0;
        
        foreach ($sections AS $section)
        {
            $i++;
            
            if ($i !== 1) 
                $title .= $delimiter;
                
            $title .= $section;            
        }    
            
        return $title;
    }
}
