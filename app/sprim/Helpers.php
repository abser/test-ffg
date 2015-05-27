<?php
# Class with methods that takes something and transform it to something
class Helpers {
    
    public static function keyInput($key, $input, $default = null)
    {
        return (array_key_exists($key, $input) && $input[$key])? $input[$key] : $default;
    }
    
    public static function dotTheBrackets($str)
    {
        $inputArray = array_flip((array)$str);
        
        parse_str(http_build_query($inputArray), $result);
        
        $dotted         = array_dot($result);
        $dotted_keys    = array_keys($dotted);
        
        return $dotted_keys[0];
    }
    
    public static function getDisplayName()
    {
         $user = Sentry::getUser(); 
         $user_name = $user->first_name.' '.$user->last_name;
         
         return (trim($user_name))? ucwords($user_name) : $user->email;
    }
    
	public static function paginatorParams($def_sort = 'id', $def_dir = 'desc')
    {
        $page       = Input::get('page', 1);
        $dir        = Input::get('dir', $def_dir);
        $sort       = Input::get('sort', $def_sort);
        $s_field    = Input::get('s_field', 'all');
        $s_term     = Input::get('s_term');
        $limit      = Input::get('limit', 10);
        
        $rev_dir    = ($dir == 'asc')? 'desc' : 'asc';
        $append_url = ['dir'=>$rev_dir, 's_field' => $s_field, 's_term' => $s_term];
        
        $append_arr =  compact('dir', 'sort', 's_field', 's_term', 'limit');
        
        return compact('page', 'dir', 'sort', 's_field', 's_term', 'limit', 'append_url', 'append_arr');
    }
      
    public static function inputText($name, $label, $attr = [], $tooltip = null)
    {
        $input = Form::text($name, Input::old($name), $attr);
        
        if(in_array('required', $attr)){
            $value = Helpers::dotTheBrackets($name);
            $input = Form::text($name, Input::old($value), $attr);
            $input .= '<small class="error">This field is required.</small>';
        }
        
        if($tooltip){
            $label = '<span class="has-tip" data-tooltip aria-haspopup="true" title="'
                .$tooltip.'">'.$label.'</span>';
        }
        
        return <<<EOT
        <div class="row">
            <div class="small-12 columns">
                <div class="row">
                    <div class="small-3 columns">
                        <label for="$name" class="right inline">$label</label>
                    </div>
                    <div class="small-9 columns large-5 end">
                        $input
                    </div>
                </div>
            </div>
        </div>
EOT;
    }

    public static function dateTz($column)
    {
    	if (!\Session::get('timezone')) {
    		return $column;
    	}
    
    	$timezone = \Session::get('timezone');
    
    	$dtz        = new \DateTimeZone($timezone);
    	$user_time  = new \DateTime('now', $dtz);
    
    	$offset = $dtz->getOffset( $user_time );
    
    	$time    = gmdate("H:i", abs($offset));
    
    	if ($offset < 0) {
    		$time = '-' . $time;
    	} else {
    		$time = '+' . $time;
    	}
    
    	$timezone_offset =  $time;
    
    	return 'CONVERT_TZ('.$column.', "+00:00", "'.$timezone_offset.'")';
    
    }
}