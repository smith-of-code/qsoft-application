<?php
if (!defined('QSOFT_CORE_LOADED')) require_once(dirname(__DIR__, 3).'/bootstrap/autoload.php');

return array (
  'utf_mode' => 
  array (
    'value' => true,
    'readonly' => true,
  ),

  'cache' => array( 'value' => array( 'type' => array(
  'class_name' => '\\Bitrix\\Main\\Data\\CacheEngineRedis',
  'extension' => 'redis'
  ),
  'redis' => array(
   'host' => getenv('REDIS_CACHE_HOST'),
  'port' => getenv('REDIS_CACHE_PORT'),
  )
  ),
  'sid' => $_SERVER["DOCUMENT_ROOT"]."#01"
  ),
  
  'cache_flags' => 
  array (
    'value' => 
    array (
      'config_options' => 3600.0,
      'site_domain' => 3600.0,
    ),
    'readonly' => false,
  ),
  'cookies' => 
  array (
    'value' => 
    array (
      'secure' => false,
      'http_only' => true,
    ),
    'readonly' => false,
  ),
  'exception_handling' => 
  array (
    'value' => 
    array (
      'debug' => true,
      'handled_errors_types' => 4437,
      'exception_errors_types' => 4437,
      'ignore_silence' => false,
      'assertion_throws_exception' => true,
      'assertion_error_type' => 256,
      'log' => NULL,
    ),
    'readonly' => false,
  ),
  'connections' => 
  array (
    'value' => 
    array (
      'default' => 
      array (
        'className' => '\\Bitrix\\Main\\DB\\MysqliConnection',
        'host' => getenv('DB_HOST'),
        'database' => getenv('DB_NAME'),
        'login' => getenv('DB_USER'),
        'password' => getenv('DB_PASS'),
        'options' => 2.0,
      ),
    ),
    'readonly' => true,
  ),
  'crypto' => 
  array (
    'value' => 
    array (
      'crypto_key' => 'e3cefd8218c9bb3396abb87b87c67f43',
    ),
    'readonly' => true,
  ),
);
