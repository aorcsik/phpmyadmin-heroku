<?php
/**
 * phpMyAdmin sample configuration, you can use it as base for
 * manual configuration. For easier setup you can use setup/
 *
 * All directives are explained in documentation in the doc/ folder
 * or at <https://docs.phpmyadmin.net/>.
 */

declare(strict_types=1);

/**
 * This is needed for cookie based authentication to encrypt password in
 * cookie. Needs to be 32 chars long.
 */
$cfg['blowfish_secret'] = isset($_ENV['PMA_BLOWFISH_SECRET']) ? $_ENV['PMA_BLOWFISH_SECRET'] : ''; /* YOU MUST FILL IN THIS FOR COOKIE AUTH! */

/**
 * Servers configuration
 */
$i = 0;

/**
 * First server
 */
$i++;

if (isset($_ENV['PMA_ARBITRARY'])) {
    $cfg['AllowArbitraryServer'] = !!$_ENV['PMA_ARBITRARY'];
}

if (isset($_ENV["PMA_HOST"])) {
    /* Authentication type */
    if (isset($_ENV["PMA_USER"], $_ENV["PMA_PASSWORD"])) {
        $cfg['Servers'][$i]['user'] = $_ENV["PMA_USER"];
        $cfg['Servers'][$i]['password'] = $_ENV["PMA_PASSWORD"];
        $cfg['Servers'][$i]['auth_type'] = 'config';
    } else {
        $cfg['Servers'][$i]['auth_type'] = 'cookie';
    }

    /* Server parameters */
    $cfg['Servers'][$i]['host'] = $_ENV["PMA_HOST"];
    if (isset($_ENV["PMA_PORT"])) {
        $cfg['Servers'][$i]['port'] = $_ENV["PMA_PORT"];
    }
    if (isset($_ENV["PMA_VERBOSE"])) {
        $cfg['Servers'][$i]['verbose'] = $_ENV["PMA_VERBOSE"];
    }
    $cfg['Servers'][$i]['compress'] = false;
    $cfg['Servers'][$i]['AllowNoPassword'] = false;

} elseif (isset($_ENV["PMA_HOSTS"])) {
    $hosts = explode(",", $_ENV["PMA_HOSTS"]);
    $ports = isset($_ENV["PMA_PORTS"]) ? explode(",", $_ENV["PMA_HOSTS"]) : null;
    $verboses = isset($_ENV["PMA_VERBOSES"]) ? explode(",", $_ENV["PMA_VERBOSES"]) : null;
    foreach($hosts as $idx => $host) {
        /* Authentication type */
        $cfg['Servers'][$i]['auth_type'] = 'cookie';

        /* Server parameters */
        $cfg['Servers'][$i]['host'] = $host;
        if (isset($ports) && isset($ports[$idx])) {
            $cfg['Servers'][$i]['port'] = $ports[$idx];
        }
        if (isset($verboses) && isset($verboses[$idx])) {
            $cfg['Servers'][$i]['verbose'] = $verboses[$idx];
        }
        $cfg['Servers'][$i]['compress'] = false;
        $cfg['Servers'][$i]['AllowNoPassword'] = false;

        $i++;
    }
} else {

    /* Authentication type */
    $cfg['Servers'][$i]['auth_type'] = 'cookie';
    /* Server parameters */
    $cfg['Servers'][$i]['host'] = 'localhost';
    $cfg['Servers'][$i]['compress'] = false;
    $cfg['Servers'][$i]['AllowNoPassword'] = false;

}

if (isset($_ENV['PMA_ABSOLUTE_URI'])) {
    $cfg['PmaAbsoluteUri'] = $_ENV['PMA_ABSOLUTE_URI'];
}

/**
 * phpMyAdmin configuration storage settings.
 */

/* User used to manipulate with storage */
// $cfg['Servers'][$i]['controlhost'] = '';
// $cfg['Servers'][$i]['controlport'] = '';
// $cfg['Servers'][$i]['controluser'] = 'pma';
// $cfg['Servers'][$i]['controlpass'] = 'pmapass';

/* Storage database and tables */
// $cfg['Servers'][$i]['pmadb'] = 'phpmyadmin';
// $cfg['Servers'][$i]['bookmarktable'] = 'pma__bookmark';
// $cfg['Servers'][$i]['relation'] = 'pma__relation';
// $cfg['Servers'][$i]['table_info'] = 'pma__table_info';
// $cfg['Servers'][$i]['table_coords'] = 'pma__table_coords';
// $cfg['Servers'][$i]['pdf_pages'] = 'pma__pdf_pages';
// $cfg['Servers'][$i]['column_info'] = 'pma__column_info';
// $cfg['Servers'][$i]['history'] = 'pma__history';
// $cfg['Servers'][$i]['table_uiprefs'] = 'pma__table_uiprefs';
// $cfg['Servers'][$i]['tracking'] = 'pma__tracking';
// $cfg['Servers'][$i]['userconfig'] = 'pma__userconfig';
// $cfg['Servers'][$i]['recent'] = 'pma__recent';
// $cfg['Servers'][$i]['favorite'] = 'pma__favorite';
// $cfg['Servers'][$i]['users'] = 'pma__users';
// $cfg['Servers'][$i]['usergroups'] = 'pma__usergroups';
// $cfg['Servers'][$i]['navigationhiding'] = 'pma__navigationhiding';
// $cfg['Servers'][$i]['savedsearches'] = 'pma__savedsearches';
// $cfg['Servers'][$i]['central_columns'] = 'pma__central_columns';
// $cfg['Servers'][$i]['designer_settings'] = 'pma__designer_settings';
// $cfg['Servers'][$i]['export_templates'] = 'pma__export_templates';

/**
 * End of servers configuration
 */

/**
 * Directories for saving/loading files from server
 */
$cfg['UploadDir'] = '';
$cfg['SaveDir'] = '';
if (isset($_ENV['HEROKU_APP_DIR'])) {
    $cfg['UploadDir'] = $_ENV['HEROKU_APP_DIR'] . "/tmp/";
    $cfg['SaveDir'] = $_ENV['HEROKU_APP_DIR'] . "/tmp/";
}

/**
 * Whether to display icons or text or both icons and text in table row
 * action segment. Value can be either of 'icons', 'text' or 'both'.
 * default = 'both'
 */
//$cfg['RowActionType'] = 'icons';

/**
 * Defines whether a user should be displayed a "show all (records)"
 * button in browse mode or not.
 * default = false
 */
//$cfg['ShowAll'] = true;

/**
 * Number of rows displayed when browsing a result set. If the result
 * set contains more rows, "Previous" and "Next".
 * Possible values: 25, 50, 100, 250, 500
 * default = 25
 */
//$cfg['MaxRows'] = 50;

/**
 * Disallow editing of binary fields
 * valid values are:
 *   false    allow editing
 *   'blob'   allow editing except for BLOB fields
 *   'noblob' disallow editing except for BLOB fields
 *   'all'    disallow editing
 * default = 'blob'
 */
//$cfg['ProtectBinary'] = false;

/**
 * Default language to use, if not browser-defined or user-defined
 * (you find all languages in the locale folder)
 * uncomment the desired line:
 * default = 'en'
 */
//$cfg['DefaultLang'] = 'en';
//$cfg['DefaultLang'] = 'de';

/**
 * How many columns should be used for table display of a database?
 * (a value larger than 1 results in some information being hidden)
 * default = 1
 */
//$cfg['PropertiesNumColumns'] = 2;

/**
 * Set to true if you want DB-based query history.If false, this utilizes
 * JS-routines to display query history (lost by window close)
 *
 * This requires configuration storage enabled, see above.
 * default = false
 */
//$cfg['QueryHistoryDB'] = true;

/**
 * When using DB-based query history, how many entries should be kept?
 * default = 25
 */
//$cfg['QueryHistoryMax'] = 100;

/**
 * Whether or not to query the user before sending the error report to
 * the phpMyAdmin team when a JavaScript error occurs
 *
 * Available options
 * ('ask' | 'always' | 'never')
 * default = 'ask'
 */
//$cfg['SendErrorReports'] = 'always';

/**
 * You can find more configuration options in the documentation
 * in the doc/ folder or at <https://docs.phpmyadmin.net/>.
 */

 if (file_exists("../config.local.inc.php")) {
     include("../config.local.inc.php");
 }