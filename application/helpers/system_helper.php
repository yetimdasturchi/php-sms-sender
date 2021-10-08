<?php

function setting_item($key='', $new_value='', $replacement='', $value='')
{
  $CI =&  get_instance();
  if ($new_value != '') {
    $CI->db->update('settings', ['settings_value' => $new_value], ['settings_key' => $key]);
  }
  $item = $CI->db->get_where('settings', ['settings_key' => $key]);

  if ($item->num_rows() > 0) {
    $item = $item->row()->settings_value;
    if (isset($replacement) && isset($value)) {
      $item = str_replace($replacement, $value, $item);
    }
  }else{
    $item = "";
  }

  return $item;
}

function lang_item($key='', $data=[])
{
	$ci = & get_instance();
	$item = lang($key);
	$result = "";
	if ($item) {
		if (count($data) > 0) {
			$result = $ci->parser->parse_string($item, $data, TRUE);
		}else{
			$result = $item;
		}
	}else{
		$result = $key;
	}

	return $result;
	
}

function get_languages()
{
	$ci = & get_instance();
	$ci->load->helper('directory');
	$map = directory_map(APPPATH.'language/', 1);
	$languages = [];
	foreach ($map as $row) {
		if (!in_array($row, ['index.php', 'index.html', 'index.htm'])) {
			$row = str_replace("/", "", $row);
			$languagedata = file_get_contents(APPPATH.'language/'.$row.'/languagedata.json');
			$languagedata = json_decode($languagedata, TRUE);
			$languages[$row] = $languagedata;
		}
	}
	return $languages;
}

function get_language_info($language='', $key='')
{
	if ($language == '') {
		$ci = & get_instance();
		$language = $ci->config->item('language');
	}
	$languagedata = file_get_contents(APPPATH.'language/'.$language.'/languagedata.json');
	$languagedata = json_decode($languagedata, TRUE);
	if ($key != '') {
		return $languagedata[$key];
	}
	return $languagedata;
}

function clear_phone($number='')
{
	return preg_replace('/\D/', '', $number);
}

function validate_phone($number='')
{
  return preg_match("/^998(90|91|93|94|95|97|98|99|33|88)[0-9]{7}$/", $number);
}

function format_phone($number='')
{
  if(  preg_match( '/^(998)(90|91|93|94|95|97|98|99|33|88)([0-9]{3})([0-9]{2})([0-9]{2})$/', $number,  $matches ) ){
    return "+{$matches[1]} ($matches[2]) $matches[3]-$matches[4]-$matches[5]";
  }else{
    return $number;   
  }
}

function generateNumericOTP($n = 6) {
      
    $generator = "0123456789";
  
    $result = "";
  
    for ($i = 1; $i <= $n; $i++) {
        $result .= substr($generator, (rand()%(strlen($generator))), 1);
    }
  
    return $result;
}

function generateRandomString($length = 10) {
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}

function user_base_url($segment='')
{
	$ci = & get_instance();
	if ($segment != '') {
		return base_url( $ci->session->userdata('user_type').'/'.$segment );
	}else{
		return base_url( $ci->session->userdata('user_type') );
	}
}

function uploads($folder='', $path='')
{
	if ($path != '') {
		return base_url('uploads/'.$folder.'/'.$path);
	}else{
		return '';
	}
}

function set_active_sidebar($uri='')
{
	if (strpos(current_url(), $uri) !== false) {
    	return 'active';
	}
	return '';
}

function toUniversalString($str, $options = array())
{
	$str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());
    $defaults = [
      'delimiter'   => ' ',
      'limit'     => null,
      'lowercase'   => true,
      'replacements'  => array(),
      'transliterate' => true,
    ];
    
    $options = array_merge($defaults, $options);
    $char_map = [
    	// Latin
      	'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C',
      	'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I',
      	'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ő' => 'O',
      	'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U', 'Ý' => 'Y', 'Þ' => 'TH',
      	'ß' => 'ss',
      	'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c',
      	'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
      	'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő' => 'o',
      	'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ű' => 'u', 'ý' => 'y', 'þ' => 'th',
      	'ÿ' => 'y',
      	// Latin symbols
      	'©' => '(c)',
      	// Greek
      	'Α' => 'A', 'Β' => 'B', 'Γ' => 'G', 'Δ' => 'D', 'Ε' => 'E', 'Ζ' => 'Z', 'Η' => 'H', 'Θ' => '8',
      	'Ι' => 'I', 'Κ' => 'K', 'Λ' => 'L', 'Μ' => 'M', 'Ν' => 'N', 'Ξ' => '3', 'Ο' => 'O', 'Π' => 'P',
      	'Ρ' => 'R', 'Σ' => 'S', 'Τ' => 'T', 'Υ' => 'Y', 'Φ' => 'F', 'Χ' => 'X', 'Ψ' => 'PS', 'Ω' => 'W',
      	'Ά' => 'A', 'Έ' => 'E', 'Ί' => 'I', 'Ό' => 'O', 'Ύ' => 'Y', 'Ή' => 'H', 'Ώ' => 'W', 'Ϊ' => 'I',
      	'Ϋ' => 'Y',
      	'α' => 'a', 'β' => 'b', 'γ' => 'g', 'δ' => 'd', 'ε' => 'e', 'ζ' => 'z', 'η' => 'h', 'θ' => '8',
      	'ι' => 'i', 'κ' => 'k', 'λ' => 'l', 'μ' => 'm', 'ν' => 'n', 'ξ' => '3', 'ο' => 'o', 'π' => 'p',
      	'ρ' => 'r', 'σ' => 's', 'τ' => 't', 'υ' => 'y', 'φ' => 'f', 'χ' => 'x', 'ψ' => 'ps', 'ω' => 'w',
      	'ά' => 'a', 'έ' => 'e', 'ί' => 'i', 'ό' => 'o', 'ύ' => 'y', 'ή' => 'h', 'ώ' => 'w', 'ς' => 's',
      	'ϊ' => 'i', 'ΰ' => 'y', 'ϋ' => 'y', 'ΐ' => 'i',
      	// Turkish
      	'Ş' => 'S', 'İ' => 'I', 'Ç' => 'C', 'Ü' => 'U', 'Ö' => 'O', 'Ğ' => 'G',
      	'ş' => 's', 'ı' => 'i', 'ç' => 'c', 'ü' => 'u', 'ö' => 'o', 'ğ' => 'g',
      	// Russian
      	'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'Ye', 'Ё' => 'Yo', 'Ж' => 'J',
      	'З' => 'Z', 'И' => 'I', 'Й' => 'Y', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
      	'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'X', 'Ц' => 'Ts',
      	'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sh', 'Ъ' => '\'', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'Yu',
      	'Я' => 'Ya',
      	'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'j',
      	'з' => 'z', 'и' => 'i', 'й' => 'y', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
      	'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'x', 'ц' => 'ts',
      	'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sh', 'ъ' => '\'', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu',
      	'я' => 'ya',
      	// Ukrainian
      	'Є' => 'Ye', 'І' => 'I', 'Ї' => 'Yi', 'Ґ' => 'G',
      	'є' => 'ye', 'і' => 'i', 'ї' => 'yi', 'ґ' => 'g',
      	// Czech
      	'Č' => 'C', 'Ď' => 'D', 'Ě' => 'E', 'Ň' => 'N', 'Ř' => 'R', 'Š' => 'S', 'Ť' => 'T', 'Ů' => 'U',
      	'Ž' => 'Z',
      	'č' => 'c', 'ď' => 'd', 'ě' => 'e', 'ň' => 'n', 'ř' => 'r', 'š' => 's', 'ť' => 't', 'ů' => 'u',
      	'ž' => 'z',
      	// Polish
      	'Ą' => 'A', 'Ć' => 'C', 'Ę' => 'e', 'Ł' => 'L', 'Ń' => 'N', 'Ó' => 'o', 'Ś' => 'S', 'Ź' => 'Z',
      	'Ż' => 'Z',
      	'ą' => 'a', 'ć' => 'c', 'ę' => 'e', 'ł' => 'l', 'ń' => 'n', 'ó' => 'o', 'ś' => 's', 'ź' => 'z',
      	'ż' => 'z',
      	// Latvian
      	'Ā' => 'A', 'Č' => 'C', 'Ē' => 'E', 'Ģ' => 'G', 'Ī' => 'i', 'Ķ' => 'k', 'Ļ' => 'L', 'Ņ' => 'N',
      	'Š' => 'S', 'Ū' => 'u', 'Ž' => 'Z',
      	'ā' => 'a', 'č' => 'c', 'ē' => 'e', 'ģ' => 'g', 'ī' => 'i', 'ķ' => 'k', 'ļ' => 'l', 'ņ' => 'n',
      	'š' => 's', 'ū' => 'u', 'ž' => 'z',
      	// Uzbek
      	"Ў"=>"O'", "ў"=>"o'", "Ғ"=>"G'", "ғ"=>"g'", "Ҳ"=>"H", "ҳ"=>"h", "Қ"=>"Q", "қ"=>"q",
      	//Symbols
      	"\"" => "'", "–" => "-", "‘" => "'", "“" => "\"", "”" => "\"", "’" => "'", "´" => "'",
    ];
    
    $str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);
    
    if ($options['transliterate']) {
    	$str = str_replace(array_keys($char_map), $char_map, $str);
    }
    
    // $str = preg_replace("/'[^\p{L}\p{Nd}]+/u", $options['delimiter'], $str);
    $str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);
    $str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');
    $str = trim($str, $options['delimiter']);
    return $str;
}

function datatableGen($name='', $attributes=[], $set=[])
{
  /*
  
  $datatable = datatableGen('smstemplates', [
        'processing' => true,
        'serverSide' => true,
        'serverMethod' => 'post',
        'ajax' => ['url' => 'ajaxfile.php'],
        'columns' => [
            ['data' => 'emp_name'],
            ['data' => 'email'],
            ['data' => 'gender'],
            ['data' => 'salary'],
            ['data' => 'city']
        ],
        'responsive' => true,
        'buttonsDom' => 'Bfrtip',
        'buttons' => [
            [
                'extend' => 'collection',
                'text' => '<i class="fa fa-file-text-o"></i> '.lang_item('datatable_export'),
                'className' => 'btn-inverse',
                'buttons' => [
                    [
                        'extend' => 'print',
                        'text' => '<i class="fa fa-print"></i> '.lang_item('datatable_print'),
                        'customize' => ['arguments' => 'win', 'body' => "$(win.document.body).children(\"h1:first\").remove();"
                        ]
                    ],
                    ['extend' => 'excel', 'text' => '<i class="fa fa-file-excel-o"></i> '.lang_item('datatable_excel')],
                    [
                        'extend' => 'pdf',
                        'text' => '<i class="fa fa-file-pdf-o"></i> '.lang_item('datatable_pdf'),
                        'customize' => ['arguments' => 'doc', 'body' => "doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');"
                        ]
                    ],
                    ['extend' => 'copy', 'text' => '<i class="fa fa-copy"></i> '.lang_item('datatable_copy')]
                ]
            ],
            [
                'text' => '<i class="fa fa-plus"></i> '.lang_item('add'),
                'className' => 'btn-custom',
                'action' => ['arguments' => 'e,dt,node,config','body' => 'console.log("hello")']
            ]
        ]
    ]);

  */
  $result = "<table";
  if (count($attributes) > 0) {
    foreach ($attributes as $attr_key => $attr_value) {
      $result .= " {$attr_key}=\"{$attr_value}\"";
    }
  }
  
  $result .= " datatable=\"{$name}\"";
  if (count($set) > 0) {
    if (array_key_exists('processing', $set)) {
      $result .= ' datatable-processing="'.$set['processing'].'"';
    }

    if (array_key_exists('serverSide', $set)) {
      $result .= ' datatable-serverside="'.$set['serverSide'].'"';
    }

    if (array_key_exists('responsive', $set)) {
      $result .= ' datatable-responsive="'.$set['responsive'].'"';
    }

    if (array_key_exists('serverMethod', $set)) {
      $result .= ' datatable-servermethod="'.$set['serverMethod'].'"';
    }

    if (array_key_exists('ajax', $set)) {
      $result .= ' datatable-ajax="'.htmlentities(json_encode($set['ajax']), ENT_QUOTES, 'UTF-8').'"';
    }

    if (array_key_exists('fnRowCallback', $set)) {
      $result .= ' datatable-fnrowcallback="'.htmlentities(json_encode($set['fnRowCallback']), ENT_QUOTES, 'UTF-8').'"';
    }

    if (array_key_exists('columns', $set)) {
      $result .= ' datatable-columns="'.htmlentities(json_encode($set['columns']), ENT_QUOTES, 'UTF-8').'"';
    }

    if (array_key_exists('lengthMenu', $set)) {
      $result .= ' datatable-lengthmenu="'.htmlentities(json_encode($set['lengthMenu']), ENT_QUOTES, 'UTF-8').'"';
    }

    if (array_key_exists('columnDefs', $set)) {
      $result .= ' datatable-columndefs="'.htmlentities(json_encode($set['columnDefs']), ENT_QUOTES, 'UTF-8').'"';
    }

    if (array_key_exists('order', $set)) {
      $result .= ' datatable-order="'.htmlentities(json_encode($set['order']), ENT_QUOTES, 'UTF-8').'"';
    }

    if (array_key_exists('buttonsDom', $set)) {
      $result .= ' datatable-buttons-dom="'.$set['buttonsDom'].'"';
    }

    if (array_key_exists('buttons', $set)) {
      $result .= ' datatable-buttons="'.htmlentities(json_encode($set['buttons']), ENT_QUOTES, 'UTF-8').'"';
    }
  }
  $result .= "></table>";
  return $result;
}

function getFileExt($filename='')
{
  return pathinfo($filename, PATHINFO_EXTENSION);
}

function encode_hash($value) {
    if (!$value) {
        return false;
    }

    $key = sha1('gzRTWV1tkEBTFlubUcGw');
    $strLen = strlen($value);
    $keyLen = strlen($key);
    $j = 0;
    $crypttext = '';

    for ($i = 0; $i < $strLen; $i++) {
        $ordStr = ord(substr($value, $i, 1));
        if ($j == $keyLen) {
            $j = 0;
        }
        $ordKey = ord(substr($key, $j, 1));
        $j++;
        $crypttext .= strrev(base_convert(dechex($ordStr + $ordKey), 16, 36));
    }

    return $crypttext;
}


function decode_hash($value) {
    if (!$value) {
        return false;
    }

    $key = sha1('gzRTWV1tkEBTFlubUcGw');
    $strLen = strlen($value);
    $keyLen = strlen($key);
    $j = 0;
    $decrypttext = '';

    for ($i = 0; $i < $strLen; $i += 2) {
        $ordStr = hexdec(base_convert(strrev(substr($value, $i, 2)), 36, 16));
        if ($j == $keyLen) {
            $j = 0;
        }
        $ordKey = ord(substr($key, $j, 1));
        $j++;
        $decrypttext .= chr($ordStr - $ordKey);
    }

    return $decrypttext;
}