<?php
define('system_app', true);
require '../../init.php';

if($app['pmc']['installed'] == false):
    $conn=mysqli_connect($post['server'].':'.$post['port'], $post['username'], $post['password']);

    if (mysqli_connect_errno()) {
        echo json_encode(array("success" => false, "message" => "Can not connect to Database\nDetails: ". mysqli_connect_error()), true);
    } else {
        $db=$post['database'];
        mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS `$db`")or die(json_encode(array("success" => false, "message" => "Can not connect to Database\nDetails: ". mysqli_error()), true));
        mysqli_select_db($conn, $post['database']);// or db_error("Can not connect to Database");
        mysqli_query($conn, "CREATE TABLE IF NOT EXISTS `sessions_data` (
            `sessionId` int(11) UNSIGNED NOT NULL,
            `session_hash` varchar(250) NOT NULL,
            `account_id` int(11) NOT NULL,
            `ip` varchar(250) NOT NULL,
            `timestart` int(11) NOT NULL,
            `timexpire` int(11) NOT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=latin1;")or die(json_encode(array("success" => false, "message" => "Can not connect to Database\nDetails: ". mysqli_error()), true));
          //agregar super_admin, email,
          /*date_created		date_deleted	status id_empleado*/
        mysqli_query($conn, "CREATE TABLE IF NOT EXISTS `users_data` (
            `id` int(11) NOT NULL,
            `username` varchar(250) NOT NULL,
            `password` varchar(250) NOT NULL,
            `permissions` varchar(250) NOT NULL,
            `real_name` varchar(250) NOT NULL DEFAULT 'usuario',
            `last_login` varchar(255) DEFAULT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=latin1;")or die(json_encode(array("success" => false, "message" => "Can not connect to Database\nDetails: ". mysqli_error()), true));
        mysqli_query($conn, "CREATE TABLE IF NOT EXISTS `visitors_data` (
            `fecha` date NOT NULL,
            `ip` text NOT NULL,
            `views` int(11) NOT NULL DEFAULT '1'
          ) ENGINE=InnoDB DEFAULT CHARSET=latin1;")or die(json_encode(array("success" => false, "message" => "Can not connect to Database\nDetails: ". mysqli_error()), true));
          mysqli_query($conn, "ALTER TABLE `visitors_data`
          ADD UNIQUE KEY `fecha` (`fecha`);
        COMMIT;");
          mysqli_query($conn, "ALTER TABLE `sessions_data`
          ADD PRIMARY KEY (`sessionId`);");
          mysqli_query($conn, "ALTER TABLE `users_data`
          ADD PRIMARY KEY (`id`);");
          mysqli_query($conn, "ALTER TABLE `sessions_data`
          MODIFY `sessionId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;");
          mysqli_query($conn, "ALTER TABLE `users_data`
          MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
        COMMIT;");

        foreach ($app['users'] as $user):
            if($user['username'] == "admin"):
                $hash=$user['hashpass'];
                break;
            endif;
        endforeach;

        mysqli_query($conn, "INSERT INTO users_data (`username`, `password`, `permissions`, `real_name`) VALUES ('admin', '$hash', 'all', 'Administrator')");

        $php_encode="<?php if(!defined('system_webscr') && basename(";
        $php_encode .= '$_SERVER[\'PHP_SELF\']) == basename(__FILE__)) die(\'<h3>¡Acceso denegado!</h3>\');';
        $php_encode .="define('site_baseurl', baseURL(site_url));";
        $php_encode .= "define('mysql_hostname', '{$post['server']}');";
        $php_encode .= "define('mysql_username', '{$post['username']}');";
        $php_encode .= "define('mysql_password', '{$post['password']}');";
        $php_encode .= "define('mysql_dbname', '{$post['database']}');";
        $php_encode .= "define('mysql_port', {$post['port']}); ?>";

        $put=file_put_contents(PATH_SYSTEM . "config.php", $php_encode)or die(json_encode(array("success" => false, "message" => "Error! Configuration file could not be created"), true));;//, FILE_APPEND);

        $_SESSION['step']=4;

        echo json_encode(array("success" => true, "message" => "Database connected!"), true);
    }
else:
    echo json_encode(array("success" => false, "message" => "We are sorry! An installation has already been completed"), true);
endif;

?>
