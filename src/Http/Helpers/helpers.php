<?php

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use jCube\Lib\ClientInfo;
use jCube\Lib\FileManager;
use jCube\Lib\GoogleAuthenticator;
use jCube\Models\Config;
use jCube\Notify\Notify;

function systemDetails()
{
  $def = [];
  if (function_exists('mySystemDetails')) {
    $def = mySystemDetails();
  }
  
  $system['name'] = 'Core';
  $system['version'] = '1.0';
  
  return array_merge($system, $def);
}

function gs()
{
  return getConfig('general');
}

function getConfig($cat)
{
  $key = !is_array($cat) ? $cat . 'Setting' : implode('_', $cat) . 'Setting';
  $cached = Cache::get($key);
  
  if (!$cached) {
    $raw = collect(Config::whereIn('category', is_array($cat) ? $cat : [$cat])->orderBy('slug')->get());
    $obj = (object)$raw->flatMap(function ($item) {
      if (is_json($item->value ?: $item->default)) {
        return [$item->slug => json_decode($item->value ?: $item->default)];
      } else {
        return [$item->slug => $item->value ?: $item->default];
      }
    })->all();
    Cache::put($key, $obj);
    return $obj;
  }
  
  return $cached;
}

function slug($string)
{
  return Illuminate\Support\Str::slug($string);
}

function getMetaTitle($title)
{
  $general = gs();
  return replaceShortCode($general->meta_title, [
    'site_name' => $general->site_name,
    'title' => $title,
  ]);
}

function replaceShortCode($message, $shorts = [])
{
  foreach ($shorts as $k => $short) {
    $message = str_replace("{{" . $k . "}}", $short, $message);
  }
  return $message;
}

function getImage($image, $size = '200x200')
{
  $clean = '';
  if (file_exists($image) && is_file($image)) {
    return asset($image) . $clean;
  }
  
  return route('placeholder.image', $size);
}

function getFilePath($key)
{
  try {
    $fileManager = new FileManager();
    return $fileManager->$key()->path;
  } catch (Exception $exception) {
    return 'assets/file/' . $key;
  }
}

function getFileSize($key)
{
  try {
    $fileManager = new FileManager();
    return $fileManager->$key()->size;
  } catch (Exception $exception) {
    return '400x400';
  }
}

function placeholderImage()
{
  $args = func_get_args();
  if (!count($args)) {
    $args[] = '300x250';
  }
  
  return route('placeholder.image', $args);
}

function keyToTitle($text)
{
  return ucfirst(preg_replace('/[^A-Za-z0-9 ]/', ' ', $text));
}

function titleToKey($text)
{
  return strtolower(str_replace(' ', '_', $text));
}

function menuActive($routeName, $type = null, $param = null)
{
  if ($type == 3) {
    $class = 'side-menu--open';
  } elseif ($type == 2) {
    $class = 'sidebar-submenu__open';
  } elseif ($type == 4) {
    $class = 'open';
  } else {
    $class = 'active';
  }
  
  if (is_array($routeName)) {
    foreach ($routeName as $key => $value) {
      if (request()->routeIs($value)) {
        return $class;
      }
    }
  } elseif (request()->routeIs($routeName)) {
    if ($param) {
      $routeParam = array_values(@request()->route()->parameters ?? []);
      if (strtolower(@$routeParam[0]) == strtolower($param)) {
        return $class;
      } else {
        return;
      }
    }
    
    return $class;
  }
}

if (!function_exists('getPaginate')) {
  function getPaginate($paginate = 20)
  {
    return $paginate;
  }
}

function diffForHumans($date)
{
  $lang = session()->get('lang');
  Carbon::setlocale($lang);
  
  return Carbon::parse($date)->diffForHumans();
}

function showDateTime($date, $format = 'Y-m-d h:i A')
{
  $lang = session()->get('lang');
  Carbon::setlocale($lang);
  
  return Carbon::parse($date)->translatedFormat($format);
}

function dateSort($a, $b)
{
  return strtotime($a) - strtotime($b);
}

function dateSorting($arr)
{
  usort($arr, 'dateSort');
  
  return $arr;
}

function getRealIP()
{
  $ip = $_SERVER['REMOTE_ADDR'];
  //Deep detect ip
  if (filter_var(@$_SERVER['HTTP_FORWARDED'], FILTER_VALIDATE_IP)) {
    $ip = $_SERVER['HTTP_FORWARDED'];
  }
  if (filter_var(@$_SERVER['HTTP_FORWARDED_FOR'], FILTER_VALIDATE_IP)) {
    $ip = $_SERVER['HTTP_FORWARDED_FOR'];
  }
  if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP)) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  }
  if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP)) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
  }
  if (filter_var(@$_SERVER['HTTP_X_REAL_IP'], FILTER_VALIDATE_IP)) {
    $ip = $_SERVER['HTTP_X_REAL_IP'];
  }
  if (filter_var(@$_SERVER['HTTP_CF_CONNECTING_IP'], FILTER_VALIDATE_IP)) {
    $ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
  }
  if ($ip == '::1') {
    $ip = '127.0.0.1';
  }
  
  return $ip;
}

function osBrowser()
{
  $osBrowser = ClientInfo::osBrowser();
  return $osBrowser;
}

function getIpInfo()
{
  $ipInfo = ClientInfo::ipInfo();
  return $ipInfo;
}

function timezoneList()
{
  return [
    'Africa/Abidjan',
    'Africa/Accra',
    'Africa/Addis_Ababa',
    'Africa/Algiers',
    'Africa/Asmara',
    'Africa/Bamako',
    'Africa/Bangui',
    'Africa/Banjul',
    'Africa/Bissau',
    'Africa/Blantyre',
    'Africa/Brazzaville',
    'Africa/Bujumbura',
    'Africa/Cairo',
    'Africa/Casablanca',
    'Africa/Ceuta',
    'Africa/Conakry',
    'Africa/Dakar',
    'Africa/Dar_es_Salaam',
    'Africa/Djibouti',
    'Africa/Douala',
    'Africa/El_Aaiun',
    'Africa/Freetown',
    'Africa/Gaborone',
    'Africa/Harare',
    'Africa/Johannesburg',
    'Africa/Juba',
    'Africa/Kampala',
    'Africa/Khartoum',
    'Africa/Kigali',
    'Africa/Kinshasa',
    'Africa/Lagos',
    'Africa/Libreville',
    'Africa/Lome',
    'Africa/Luanda',
    'Africa/Lubumbashi',
    'Africa/Lusaka',
    'Africa/Malabo',
    'Africa/Maputo',
    'Africa/Maseru',
    'Africa/Mbabane',
    'Africa/Mogadishu',
    'Africa/Monrovia',
    'Africa/Nairobi',
    'Africa/Ndjamena',
    'Africa/Niamey',
    'Africa/Nouakchott',
    'Africa/Ouagadougou',
    'Africa/Porto-Novo',
    'Africa/Sao_Tome',
    'Africa/Tripoli',
    'Africa/Tunis',
    'Africa/Windhoek',
    'America/Adak',
    'America/Anchorage',
    'America/Anguilla',
    'America/Antigua',
    'America/Araguaina',
    'America/Argentina/Buenos_Aires',
    'America/Argentina/Catamarca',
    'America/Argentina/Cordoba',
    'America/Argentina/Jujuy',
    'America/Argentina/La_Rioja',
    'America/Argentina/Mendoza',
    'America/Argentina/Rio_Gallegos',
    'America/Argentina/Salta',
    'America/Argentina/San_Juan',
    'America/Argentina/San_Luis',
    'America/Argentina/Tucuman',
    'America/Argentina/Ushuaia',
    'America/Aruba',
    'America/Asuncion',
    'America/Atikokan',
    'America/Bahia',
    'America/Bahia_Banderas',
    'America/Barbados',
    'America/Belem',
    'America/Belize',
    'America/Blanc-Sablon',
    'America/Boa_Vista',
    'America/Bogota',
    'America/Boise',
    'America/Cambridge_Bay',
    'America/Campo_Grande',
    'America/Cancun',
    'America/Caracas',
    'America/Cayenne',
    'America/Cayman',
    'America/Chicago',
    'America/Chihuahua',
    'America/Costa_Rica',
    'America/Creston',
    'America/Cuiaba',
    'America/Curacao',
    'America/Danmarkshavn',
    'America/Dawson',
    'America/Dawson_Creek',
    'America/Denver',
    'America/Detroit',
    'America/Dominica',
    'America/Edmonton',
    'America/Eirunepe',
    'America/El_Salvador',
    'America/Fort_Nelson',
    'America/Fortaleza',
    'America/Glace_Bay',
    'America/Goose_Bay',
    'America/Grand_Turk',
    'America/Grenada',
    'America/Guadeloupe',
    'America/Guatemala',
    'America/Guayaquil',
    'America/Guyana',
    'America/Halifax',
    'America/Havana',
    'America/Hermosillo',
    'America/Indiana/Indianapolis',
    'America/Indiana/Knox',
    'America/Indiana/Marengo',
    'America/Indiana/Petersburg',
    'America/Indiana/Tell_City',
    'America/Indiana/Vevay',
    'America/Indiana/Vincennes',
    'America/Indiana/Winamac',
    'America/Inuvik',
    'America/Iqaluit',
    'America/Jamaica',
    'America/Juneau',
    'America/Kentucky/Louisville',
    'America/Kentucky/Monticello',
    'America/Kralendijk',
    'America/La_Paz',
    'America/Lima',
    'America/Los_Angeles',
    'America/Lower_Princes',
    'America/Maceio',
    'America/Managua',
    'America/Manaus',
    'America/Marigot',
    'America/Martinique',
    'America/Matamoros',
    'America/Mazatlan',
    'America/Menominee',
    'America/Merida',
    'America/Metlakatla',
    'America/Mexico_City',
    'America/Miquelon',
    'America/Moncton',
    'America/Monterrey',
    'America/Montevideo',
    'America/Montserrat',
    'America/Nassau',
    'America/New_York',
    'America/Nipigon',
    'America/Nome',
    'America/Noronha',
    'America/North_Dakota/Beulah',
    'America/North_Dakota/Center',
    'America/North_Dakota/New_Salem',
    'America/Nuuk',
    'America/Ojinaga',
    'America/Panama',
    'America/Pangnirtung',
    'America/Paramaribo',
    'America/Phoenix',
    'America/Port-au-Prince',
    'America/Port_of_Spain',
    'America/Porto_Velho',
    'America/Puerto_Rico',
    'America/Punta_Arenas',
    'America/Rainy_River',
    'America/Rankin_Inlet',
    'America/Recife',
    'America/Regina',
    'America/Resolute',
    'America/Rio_Branco',
    'America/Santarem',
    'America/Santiago',
    'America/Santo_Domingo',
    'America/Sao_Paulo',
    'America/Scoresbysund',
    'America/Sitka',
    'America/St_Barthelemy',
    'America/St_Johns',
    'America/St_Kitts',
    'America/St_Lucia',
    'America/St_Thomas',
    'America/St_Vincent',
    'America/Swift_Current',
    'America/Tegucigalpa',
    'America/Thule',
    'America/Thunder_Bay',
    'America/Tijuana',
    'America/Toronto',
    'America/Tortola',
    'America/Vancouver',
    'America/Whitehorse',
    'America/Winnipeg',
    'America/Yakutat',
    'America/Yellowknife',
    'Antarctica/Casey',
    'Antarctica/Davis',
    'Antarctica/DumontDUrville',
    'Antarctica/Macquarie',
    'Antarctica/Mawson',
    'Antarctica/McMurdo',
    'Antarctica/Palmer',
    'Antarctica/Rothera',
    'Antarctica/Syowa',
    'Antarctica/Troll',
    'Antarctica/Vostok',
    'Arctic/Longyearbyen',
    'Asia/Aden',
    'Asia/Almaty',
    'Asia/Amman',
    'Asia/Anadyr',
    'Asia/Aqtau',
    'Asia/Aqtobe',
    'Asia/Ashgabat',
    'Asia/Atyrau',
    'Asia/Baghdad',
    'Asia/Bahrain',
    'Asia/Baku',
    'Asia/Bangkok',
    'Asia/Barnaul',
    'Asia/Beirut',
    'Asia/Bishkek',
    'Asia/Brunei',
    'Asia/Chita',
    'Asia/Choibalsan',
    'Asia/Colombo',
    'Asia/Damascus',
    'Asia/Dhaka',
    'Asia/Dili',
    'Asia/Dubai',
    'Asia/Dushanbe',
    'Asia/Famagusta',
    'Asia/Gaza',
    'Asia/Hebron',
    'Asia/Ho_Chi_Minh',
    'Asia/Hong_Kong',
    'Asia/Hovd',
    'Asia/Irkutsk',
    'Asia/Jakarta',
    'Asia/Jayapura',
    'Asia/Jerusalem',
    'Asia/Kabul',
    'Asia/Kamchatka',
    'Asia/Karachi',
    'Asia/Kathmandu',
    'Asia/Khandyga',
    'Asia/Kolkata',
    'Asia/Krasnoyarsk',
    'Asia/Kuala_Lumpur',
    'Asia/Kuching',
    'Asia/Kuwait',
    'Asia/Macau',
    'Asia/Magadan',
    'Asia/Makassar',
    'Asia/Manila',
    'Asia/Muscat',
    'Asia/Nicosia',
    'Asia/Novokuznetsk',
    'Asia/Novosibirsk',
    'Asia/Omsk',
    'Asia/Oral',
    'Asia/Phnom_Penh',
    'Asia/Pontianak',
    'Asia/Pyongyang',
    'Asia/Qatar',
    'Asia/Qostanay',
    'Asia/Qyzylorda',
    'Asia/Riyadh',
    'Asia/Sakhalin',
    'Asia/Samarkand',
    'Asia/Seoul',
    'Asia/Shanghai',
    'Asia/Singapore',
    'Asia/Srednekolymsk',
    'Asia/Taipei',
    'Asia/Tashkent',
    'Asia/Tbilisi',
    'Asia/Tehran',
    'Asia/Thimphu',
    'Asia/Tokyo',
    'Asia/Tomsk',
    'Asia/Ulaanbaatar',
    'Asia/Urumqi',
    'Asia/Ust-Nera',
    'Asia/Vientiane',
    'Asia/Vladivostok',
    'Asia/Yakutsk',
    'Asia/Yangon',
    'Asia/Yekaterinburg',
    'Asia/Yerevan',
    'Atlantic/Azores',
    'Atlantic/Bermuda',
    'Atlantic/Canary',
    'Atlantic/Cape_Verde',
    'Atlantic/Faroe',
    'Atlantic/Madeira',
    'Atlantic/Reykjavik',
    'Atlantic/South_Georgia',
    'Atlantic/St_Helena',
    'Atlantic/Stanley',
    'Australia/Adelaide',
    'Australia/Brisbane',
    'Australia/Broken_Hill',
    'Australia/Darwin',
    'Australia/Eucla',
    'Australia/Hobart',
    'Australia/Lindeman',
    'Australia/Lord_Howe',
    'Australia/Melbourne',
    'Australia/Perth',
    'Australia/Sydney',
    'Europe/Amsterdam',
    'Europe/Andorra',
    'Europe/Astrakhan',
    'Europe/Athens',
    'Europe/Belgrade',
    'Europe/Berlin',
    'Europe/Bratislava',
    'Europe/Brussels',
    'Europe/Bucharest',
    'Europe/Budapest',
    'Europe/Busingen',
    'Europe/Chisinau',
    'Europe/Copenhagen',
    'Europe/Dublin',
    'Europe/Gibraltar',
    'Europe/Guernsey',
    'Europe/Helsinki',
    'Europe/Isle_of_Man',
    'Europe/Istanbul',
    'Europe/Jersey',
    'Europe/Kaliningrad',
    'Europe/Kiev',
    'Europe/Kirov',
    'Europe/Lisbon',
    'Europe/Ljubljana',
    'Europe/London',
    'Europe/Luxembourg',
    'Europe/Madrid',
    'Europe/Malta',
    'Europe/Mariehamn',
    'Europe/Minsk',
    'Europe/Monaco',
    'Europe/Moscow',
    'Europe/Oslo',
    'Europe/Paris',
    'Europe/Podgorica',
    'Europe/Prague',
    'Europe/Riga',
    'Europe/Rome',
    'Europe/Samara',
    'Europe/San_Marino',
    'Europe/Sarajevo',
    'Europe/Saratov',
    'Europe/Simferopol',
    'Europe/Skopje',
    'Europe/Sofia',
    'Europe/Stockholm',
    'Europe/Tallinn',
    'Europe/Tirane',
    'Europe/Ulyanovsk',
    'Europe/Uzhgorod',
    'Europe/Vaduz',
    'Europe/Vatican',
    'Europe/Vienna',
    'Europe/Vilnius',
    'Europe/Volgograd',
    'Europe/Warsaw',
    'Europe/Zagreb',
    'Europe/Zaporozhye',
    'Europe/Zurich',
    'Indian/Antananarivo',
    'Indian/Chagos',
    'Indian/Christmas',
    'Indian/Cocos',
    'Indian/Comoro',
    'Indian/Kerguelen',
    'Indian/Mahe',
    'Indian/Maldives',
    'Indian/Mauritius',
    'Indian/Mayotte',
    'Indian/Reunion',
    'Pacific/Apia',
    'Pacific/Auckland',
    'Pacific/Bougainville',
    'Pacific/Chatham',
    'Pacific/Chuuk',
    'Pacific/Easter',
    'Pacific/Efate',
    'Pacific/Enderbury',
    'Pacific/Fakaofo',
    'Pacific/Fiji',
    'Pacific/Funafuti',
    'Pacific/Galapagos',
    'Pacific/Gambier',
    'Pacific/Guadalcanal',
    'Pacific/Guam',
    'Pacific/Honolulu',
    'Pacific/Kiritimati',
    'Pacific/Kosrae',
    'Pacific/Kwajalein',
    'Pacific/Majuro',
    'Pacific/Marquesas',
    'Pacific/Midway',
    'Pacific/Nauru',
    'Pacific/Niue',
    'Pacific/Norfolk',
    'Pacific/Noumea',
    'Pacific/Pago_Pago',
    'Pacific/Palau',
    'Pacific/Pitcairn',
    'Pacific/Pohnpei',
    'Pacific/Port_Moresby',
    'Pacific/Rarotonga',
    'Pacific/Saipan',
    'Pacific/Tahiti',
    'Pacific/Tarawa',
    'Pacific/Tongatapu',
    'Pacific/Wake',
    'Pacific/Wallis',
    'Africa/Asmera',
    'Africa/Timbuktu',
    'America/Argentina/ComodRivadavia',
    'America/Atka',
    'America/Buenos_Aires',
    'America/Catamarca',
    'America/Coral_Harbour',
    'America/Cordoba',
    'America/Ensenada',
    'America/Fort_Wayne',
    'America/Godthab',
    'America/Indianapolis',
    'America/Jujuy',
    'America/Knox_IN',
    'America/Louisville',
    'America/Mendoza',
    'America/Montreal',
    'America/Porto_Acre',
    'America/Rosario',
    'America/Santa_Isabel',
    'America/Shiprock',
    'America/Virgin',
    'Antarctica/South_Pole',
    'Asia/Ashkhabad',
    'Asia/Calcutta',
    'Asia/Chongqing',
    'Asia/Chungking',
    'Asia/Dacca',
    'Asia/Harbin',
    'Asia/Istanbul',
    'Asia/Kashgar',
    'Asia/Katmandu',
    'Asia/Macao',
    'Asia/Rangoon',
    'Asia/Saigon',
    'Asia/Tel_Aviv',
    'Asia/Thimbu',
    'Asia/Ujung_Pandang',
    'Asia/Ulan_Bator',
    'Atlantic/Faeroe',
    'Atlantic/Jan_Mayen',
    'Australia/ACT',
    'Australia/Canberra',
    'Australia/Currie',
    'Australia/LHI',
    'Australia/North',
    'Australia/NSW',
    'Australia/Queensland',
    'Australia/South',
    'Australia/Tasmania',
    'Australia/Victoria',
    'Australia/West',
    'Australia/Yancowinna',
    'Brazil/Acre',
    'Brazil/DeNoronha',
    'Brazil/East',
    'Brazil/West',
    'Canada/Atlantic',
    'Canada/Central',
    'Canada/Eastern',
    'Canada/Mountain',
    'Canada/Newfoundland',
    'Canada/Pacific',
    'Canada/Saskatchewan',
    'Canada/Yukon',
    'CET',
    'Chile/Continental',
    'Chile/EasterIsland',
    'CST6CDT',
    'Cuba',
    'EET',
    'Egypt',
    'Eire',
    'EST',
    'EST5EDT',
    'Etc/GMT',
    'Etc/GMT+0',
    'Etc/GMT+1',
    'Etc/GMT+10',
    'Etc/GMT+11',
    'Etc/GMT+12',
    'Etc/GMT+2',
    'Etc/GMT+3',
    'Etc/GMT+4',
    'Etc/GMT+5',
    'Etc/GMT+6',
    'Etc/GMT+7',
    'Etc/GMT+8',
    'Etc/GMT+9',
    'Etc/GMT-0',
    'Etc/GMT-1',
    'Etc/GMT-10',
    'Etc/GMT-11',
    'Etc/GMT-12',
    'Etc/GMT-13',
    'Etc/GMT-14',
    'Etc/GMT-2',
    'Etc/GMT-3',
    'Etc/GMT-4',
    'Etc/GMT-5',
    'Etc/GMT-6',
    'Etc/GMT-7',
    'Etc/GMT-8',
    'Etc/GMT-9',
    'Etc/GMT0',
    'Etc/Greenwich',
    'Etc/UCT',
    'Etc/Universal',
    'Etc/UTC',
    'Etc/Zulu',
    'Europe/Belfast',
    'Europe/Nicosia',
    'Europe/Tiraspol',
    'Factory',
    'GB',
    'GB-Eire',
    'GMT',
    'GMT+0',
    'GMT-0',
    'GMT0',
    'Greenwich',
    'Hongkong',
    'HST',
    'Iceland',
    'Iran',
    'Israel',
    'Jamaica',
    'Japan',
    'Kwajalein',
    'Libya',
    'MET',
    'Mexico/BajaNorte',
    'Mexico/BajaSur',
    'Mexico/General',
    'MST',
    'MST7MDT',
    'Navajo',
    'NZ',
    'NZ-CHAT',
    'Pacific/Johnston',
    'Pacific/Ponape',
    'Pacific/Samoa',
    'Pacific/Truk',
    'Pacific/Yap',
    'Poland',
    'Portugal',
    'PRC',
    'PST8PDT',
    'ROC',
    'ROK',
    'Singapore',
    'Turkey',
    'UCT',
    'Universal',
    'US/Alaska',
    'US/Aleutian',
    'US/Arizona',
    'US/Central',
    'US/East-Indiana',
    'US/Eastern',
    'US/Hawaii',
    'US/Indiana-Starke',
    'US/Michigan',
    'US/Mountain',
    'US/Pacific',
    'US/Samoa',
    'UTC',
    'W-SU',
    'WET',
    'Zulu',
  ];
}

function paginateLinks($data)
{
  return $data->appends(request()->all())->links();
}

function camelCaseToNormal($str)
{
  return preg_replace('/(?<!^)([A-Z])/', ' $1', $str);
}

function fileUploader($file, $location, $size = null, $old = null, $thumb = null)
{
  $fileManager = new FileManager($file);
  $fileManager->path = $location;
  $fileManager->size = $size;
  $fileManager->old = $old;
  $fileManager->thumb = $thumb;
  $fileManager->upload();
  return $fileManager->filename;
}

function verifyG2fa($user, $code, $secret = null)
{
  $authenticator = new GoogleAuthenticator();
  if (!$secret) {
    $secret = $user->tsc;
  }
  $oneCode = $authenticator->getCode($secret);
  $userCode = $code;
  if ($oneCode == $userCode) {
    $user->tv = 1;
    $user->save();
    
    return true;
  } else {
    return false;
  }
}

function verificationCode($length)
{
  if ($length == 0) return 0;
  $min = pow(10, $length - 1);
  $max = (int)($min - 1) . '9';
  return random_int($min, $max);
}

function notify($user, $templateName, $shortCodes = null, $sendVia = null, $createLog = true)
{
  $general = gs();
  $globalShortCodes = [
    'site_name' => $general->site_name,
  ];
  
  if (gettype($user) == 'array') {
    $user = (object)$user;
  }
  
  $shortCodes = array_merge($shortCodes ?? [], $globalShortCodes);
  
  $notify = new Notify($sendVia);
  $notify->templateName = $templateName;
  $notify->shortCodes = $shortCodes;
  $notify->user = $user;
  $notify->createLog = $createLog;
  $notify->userColumn = isset($user->id) ? $user->getForeignKey() : 'user_id';
  $notify->send();
}

if (!function_exists('is_json')) {
  function is_json($json_str)
  {
    json_decode($json_str);
    return json_last_error() === JSON_ERROR_NONE;
  }
}
