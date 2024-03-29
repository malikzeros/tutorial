<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
  | -------------------------------------------------------------------
  | DATABASE CONNECTIVITY SETTINGS
  | -------------------------------------------------------------------
  | This file will contain the settings needed to access your database.
  |
  | For complete instructions please consult the 'Database Connection'
  | page of the User Guide.
  |
  | -------------------------------------------------------------------
  | EXPLANATION OF VARIABLES
  | -------------------------------------------------------------------
  |
  |	['dsn']      The full DSN string describe a connection to the database.
  |	['hostname'] The hostname of your database server.
  |	['username'] The username used to connect to the database
  |	['password'] The password used to connect to the database
  |	['database'] The name of the database you want to connect to
  |	['dbdriver'] The database driver. e.g.: mysqli.
  |			Currently supported:
  |				 cubrid, ibase, mssql, mysql, mysqli, oci8,
  |				 odbc, pdo, postgre, sqlite, sqlite3, sqlsrv
  |	['dbprefix'] You can add an optional prefix, which will be added
  |				 to the table name when using the  Query Builder class
  |	['pconnect'] TRUE/FALSE - Whether to use a persistent connection
  |	['db_debug'] TRUE/FALSE - Whether database errors should be displayed.
  |	['cache_on'] TRUE/FALSE - Enables/disables query caching
  |	['cachedir'] The path to the folder where cache files should be stored
  |	['char_set'] The character set used in communicating with the database
  |	['dbcollat'] The character collation used in communicating with the database
  |				 NOTE: For MySQL and MySQLi databases, this setting is only used
  | 				 as a backup if your server is running PHP < 5.2.3 or MySQL < 5.0.7
  |				 (and in table creation queries made with DB Forge).
  | 				 There is an incompatibility in PHP with mysql_real_escape_string() which
  | 				 can make your site vulnerable to SQL injection if you are using a
  | 				 multi-byte character set and are running versions lower than these.
  | 				 Sites using Latin-1 or UTF-8 database character set and collation are unaffected.
  |	['swap_pre'] A default table prefix that should be swapped with the dbprefix
  |	['encrypt']  Whether or not to use an encrypted connection.
  |
  |			'mysql' (deprecated), 'sqlsrv' and 'pdo/sqlsrv' drivers accept TRUE/FALSE
  |			'mysqli' and 'pdo/mysql' drivers accept an array with the following options:
  |
  |				'ssl_key'    - Path to the private key file
  |				'ssl_cert'   - Path to the public key certificate file
  |				'ssl_ca'     - Path to the certificate authority file
  |				'ssl_capath' - Path to a directory containing trusted CA certificates in PEM format
  |				'ssl_cipher' - List of *allowed* ciphers to be used for the encryption, separated by colons (':')
  |				'ssl_verify' - TRUE/FALSE; Whether verify the server certificate or not ('mysqli' only)
  |
  |	['compress'] Whether or not to use client compression (MySQL only)
  |	['stricton'] TRUE/FALSE - forces 'Strict Mode' connections
  |							- good for ensuring strict SQL while developing
  |	['ssl_options']	Used to set various SSL options that can be used when making SSL connections.
  |	['failover'] array - A array with 0 or more data for connections if the main should fail.
  |	['save_queries'] TRUE/FALSE - Whether to "save" all executed queries.
  | 				NOTE: Disabling this will also effectively disable both
  | 				$this->db->last_query() and profiling of DB queries.
  | 				When you run a query, with this setting set to TRUE (default),
  | 				CodeIgniter will store the SQL statement for debugging purposes.
  | 				However, this may cause high memory usage, especially if you run
  | 				a lot of SQL queries ... disable this to avoid that problem.
  |
  | The $active_group variable lets you choose which connection group to
  | make active.  By default there is only one group (the 'default' group).
  |
  | The $query_builder variables lets you determine whether or not to load
  | the query builder class.
 */

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

$active_group = 'sqlsrv_prod';
$query_builder = TRUE;

$db['sqlsrv_prod'] = array(
    'dsn' => '',
    // 'hostname' => '192.168.240.101',
    'hostname' => '172.16.40.139',
    'username' => 'usr-crm',
    'password' => 'p@ssw0rd',
    'database' => 'db_crm_info',
    'dbdriver' => 'sqlsrv',
    'dbprefix' => '',
    'pconnect' => FALSE,
    'db_debug' => TRUE,
    'cache_on' => FALSE,
    'cachedir' => '',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
    'swap_pre' => '',
    'autoinit' => TRUE,
    'encrypt' => FALSE,
    'compress' => FALSE,
    'stricton' => FALSE,
    'failover' => array(),
    'save_queries' => TRUE
 );


$db['SUCM'] = array(
    'dsn' => '',
    'hostname' => '192.168.242.134',
    'username' => 'usr-sucm',
    'password' => 'P@ssw0rd2014',
    'database' => 'sucm',
    'dbdriver' => 'MySQLi',
    'dbprefix' => '',
    'pconnect' => FALSE,
    'db_debug' => TRUE,
    'cache_on' => FALSE,
    'cachedir' => '',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
    'swap_pre' => '',
    'autoinit' => TRUE,
    'encrypt' => FALSE,
    'compress' => FALSE,
    'stricton' => FALSE,
    'failover' => array(),
    'save_queries' => TRUE
 );

$capsule = new Capsule;
$capsule->addConnection([
    'driver' => $db[$active_group]['dbdriver'] == 'mysqli' ? 'mysql' : $db[$active_group]['dbdriver'],
    'host' => $db[$active_group]['hostname'],
    'database' => $db[$active_group]['database'],
    'username' => $db[$active_group]['username'],
    'password' => $db[$active_group]['password'],
    'charset' => $db[$active_group]['char_set'],
    'collation' => $db[$active_group]['dbcollat'],
    'prefix' => $db[$active_group]['dbprefix'],
]);

// Set the event dispatcher used by Eloquent models... (optional)
//$events = new Illuminate\Events\Dispatcher;
//$events->listen('illuminate.query', function($query, $bindings, $time, $name) {
//
//    // Format binding data for sql insertion
//
//    foreach ($bindings as $i => $binding) {
//        if ($binding instanceof \DateTime) {
//            $bindings[$i] = $binding->format('\'Y-m-d H:i:s\'');
//        } else if (is_string($binding)) {
//            $bindings[$i] = "'$binding'";
//        }
//    }
//
//    // Insert bindings into query
//    $query = str_replace(array('%', '?'), array('%%', '%s'), $query);
//    $query = vsprintf($query, $bindings);
//
//    // Add it into CodeIgniter
//    $db = & get_instance()->db;
//    $db->query_times[] = $time;
//    $db->queries[] = $query;
//});
//$capsule->setEventDispatcher($events);
$capsule->setEventDispatcher(new Dispatcher(new Container));
// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();
// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();
