<?php require 'logged.php';
$page['id']=6;
$page['title']="Settings | phpMyCore | ". site_name;
require 'tpl/head.php';

$zones="America/Adak;America/Anchorage;America/Anguilla;America/Antigua;America/Araguaina;America/Argentina/Buenos_Aires;America/Argentina/Catamarca;America/Argentina/Cordoba;America/Argentina/Jujuy;America/Argentina/La_Rioja;America/Argentina/Mendoza;America/Argentina/Rio_Gallegos;America/Argentina/Salta;America/Argentina/San_Juan;America/Argentina/San_Luis;America/Argentina/Tucuman;America/Argentina/Ushuaia;America/Aruba;America/Asuncion;America/Atikokan;America/Bahia;America/Bahia_Banderas;America/Barbados;America/Belem;America/Belize;America/Blanc-Sablon;America/Boa_Vista;America/Bogota;America/Boise;America/Cambridge_Bay;America/Campo_Grande;America/Cancun;America/Caracas;America/Cayenne;America/Cayman;America/Chicago;America/Chihuahua;America/Costa_Rica;America/Creston;America/Cuiaba;America/Curacao;America/Danmarkshavn;America/Dawson;America/Dawson_Creek;America/Denver;America/Detroit;America/Dominica;America/Edmonton;America/Eirunepe;America/El_Salvador;America/Fort_Nelson;America/Fortaleza;America/Glace_Bay;America/Godthab;America/Goose_Bay;America/Grand_Turk;America/Grenada;America/Guadeloupe;America/Guatemala;America/Guayaquil;America/Guyana;America/Halifax;America/Havana;America/Hermosillo;America/Indiana/Indianapolis;America/Indiana/Knox;America/Indiana/Marengo;America/Indiana/Petersburg;America/Indiana/Tell_City;America/Indiana/Vevay;America/Indiana/Vincennes;America/Indiana/Winamac;America/Inuvik;America/Iqaluit;America/Jamaica;America/Juneau;America/Kentucky/Louisville;America/Kentucky/Monticello;America/Kralendijk;America/La_Paz;America/Lima;America/Los_Angeles;America/Lower_Princes;America/Maceio;America/Managua;America/Manaus;America/Marigot;America/Martinique;America/Matamoros;America/Mazatlan;America/Menominee	America/Merida;America/Metlakatla;America/Mexico_City;America/Miquelon;America/Moncton;America/Monterrey;America/Montevideo;America/Montserrat;America/Nassau;America/New_York;America/Nipigon;America/Nome;America/Noronha;America/North_Dakota/Beulah;America/North_Dakota/Center;America/North_Dakota/New_Salem;America/Ojinaga;America/Panama;America/Pangnirtung;America/Paramaribo;America/Phoenix;America/Port-au-Prince;America/Port_of_Spain;America/Porto_Velho	America/Puerto_Rico;America/Punta_Arenas;America/Rainy_River;America/Rankin_Inlet;America/Recife;America/Regina;America/Resolute;America/Rio_Branco;America/Santarem;America/Santiago;America/Santo_Domingo;America/Sao_Paulo	America/Scoresbysund;America/Sitka;America/St_Barthelemy;America/St_Johns;America/St_Kitts;America/St_Lucia;America/St_Thomas;America/St_Vincent;America/Swift_Current;America/Tegucigalpa;America/Thule;America/Thunder_Bay;America/Tijuana;America/Toronto;America/Tortola;America/Vancouver;America/Whitehorse;America/Winnipeg;America/Yakutat	America/Yellowknife";
$mysqlcharset="big5;dec8;cp850;hp8;koi8r;latin1;latin2;swe7;ascii;ujis;sjis;hebrew;tis620;euckr;koi8u;gb2312;greek;cp1250;gbk;latin5;armscii8;utf8;ucs2;cp866;keybcs2;macce;macroman;cp852;latin7;utf8mb4;cp1251;utf16;cp1256;cp1257;utf32;binary;geostd8;cp932;eucjpms";
$sqlerror=false;

$conn = new mysqli(mysql_hostname, mysql_username, mysql_password, mysql_dbname, mysql_port);
if(mysqli_connect_error()):
  $sqlerror=true;
endif;



if(!$sqlerror):
$sql=$conn->query("SELECT @@sql_mode;");
$sqlmode=$sql->fetch_row();
endif;

?>
    <body>
        <?php require 'tpl/sidebar.php'; require 'tpl/header.php'; ?>
        <!-- Main container -->
        <main class="main-container">
        <aside class="aside aside-lg aside-expand-md">
        <div class="aside-body ps-container ps-theme-default ps-active-x" data-ps-id="7d1787d1-5994-1987-bd2c-e3dd09ff0926">
        <form id="default" action="" method="post" style="display:none">
              <input type="submit" name="system.default">
            </form>
          <form  method="post" action="" class="aside-block">

            <p><small class="text-uppercase">System Mode</small></p>
            <div class="custom-controls-stacked">
              <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" name="system_debug" value="true" <?= ($app['settings']['system_debug'] === true) ? 'checked="checked"' : null; ?>>
                <label class="custom-control-label">Debug</label>
              </div>

              <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" name="system_debug" value="false" <?= ($app['settings']['system_debug'] === false) ? 'checked="checked"' : null; ?>>
                <label class="custom-control-label">Compiled</label>
              </div>

            </div>

            <hr>



            <p><small class="text-uppercase">Charset</small></p>
            <div class="input-group form-type-line">
              <div class="input-group-prepend">
                <span class="input-group-text">PHP</span>
              </div>
              <select class="form-control" name="system_charset">
              <?php foreach (mb_list_encodings() as $charset): ?>
                                <option value="<?= $charset; ?>" <?= ($charset == $app['settings']['system_charset']) ? 'selected="selected"' : null; ?>><?= $charset; ?></option>
                              <?php endforeach; ?>
                                                        </select>
              
            </div>
  <br>
            <div class="input-group form-type-line">
            <div class="input-group-prepend">
                <span class="input-group-text">MySQL</span>
              </div>
              <select class="form-control" name="system_mysqlcharset">
              <?php foreach (explode(";", $mysqlcharset) as $charset): ?>
                                <option value="<?= $charset; ?>" <?= ($charset == $app['settings']['system_mysqlcharset']) ? 'selected="selected"' : null; ?>><?= $charset; ?></option>
                              <?php endforeach; ?>
                                                        </select>
              
            </div>
            

            <hr>




            <p><small class="text-uppercase">Time Zone</small></p>
            <select class="form-control" name="system_timezone">
            <?php foreach (explode(";", $zones) as $zone): ?>
                                <option value="<?= $zone; ?>" <?= ($zone == $app['settings']['system_timezone']) ? 'selected="selected"' : null; ?>><?= $zone; ?></option>
                              <?php endforeach; ?>
                                                        </select>
            <hr>




            <p><small class="text-uppercase">Security</small></p>
            <div class="media-list media-list-divided media-list-hover">

            <div class="media">
              <div class="media-body">
                <p><strong>Session Cookies</strong></p>
                <!--<p>Allow notifications</p>-->
              </div>
              <label class="switch">
                <input type="checkbox" name="system_sessions" <?= ($app['settings']['system_sessions'] === true) ? 'checked="checked"' : null; ?>>
                <span class="switch-indicator"></span>
              </label>
            </div>

            <div class="media">
              <div class="media-body">
                <p><strong>WebApi Protection</strong></p>
                <!--<p>Load content without refresh</p>-->
              </div>
              <label class="switch">
                <input type="checkbox" name="system_apiSecurity" <?= ($app['settings']['system_apiSecurity'] === true) ? 'checked="checked"' : null; ?>>
                <span class="switch-indicator"></span>
              </label>
            </div>
<!--
            <div class="media">
              <div class="media-body">
                <p><strong>Sticky topbar</strong></p>
                <p>Always display topbar at top</p>
              </div>
              <label class="switch">
                <input type="checkbox" checked="">
                <span class="switch-indicator"></span>
              </label>
            </div>
-->

          </div>

            <hr>


            <div class="flexbox">
              <button class="btn btn-sm btn-secondary" type="button" onclick="$('#default').submit()">Reset</button>
              <button type="submit" name="system" class="btn btn-sm btn-primary">Save Changes</button>
            </div>

          </form>
        <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px; width: 300px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 166px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 2px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>

        <button class="aside-toggler"></button>
      </aside>

            <div class="main-content">


            <form method="post" action="" class="card">
              <h4 class="card-title"><strong>Website Configuration</strong></h4>

              <div class="card-body">
                <div class="form-group">
                  <label>Nombre del sitio</label>
                  <input class="form-control" type="text" placeholder="<?= $app['settings']['site_name']; ?>"  name="site_name" value="<?= $app['settings']['site_name']; ?>" required>
                </div>

                <div class="form-group">
                <label>URL del sitio</label>
                  <input class="form-control" type="url" name="site_url" value="<?= $app['settings']['site_url']; ?>" required placeholder="<?= $app['settings']['site_url']; ?>">
                </div>

                <div class="form-group">
                  <label>Web API</label>
                  <input class="form-control" type="text" name="site_api" value="<?= $app['settings']['site_api']; ?>" required placeholder="<?= $app['settings']['site_api']; ?>">
                </div>

                <div class="form-group">
                  <label>Web Services</label>
                  <input class="form-control" type="text" name="site_ws" value="<?= $app['settings']['site_ws']; ?>" required placeholder="<?= $app['settings']['site_ws']; ?>">
                </div>

              </div>

              <footer class="card-footer flexbox flex-justified">
                <div class="custom-control custom-checkbox mb-0 d-none d-md-flex">
                  <input type="checkbox" class="custom-control-input" name="site_redirect" <?= ($app['settings']['site_redirect'] === true) ? 'checked="checked"' : null; ?>>
                  <label class="custom-control-label">Redirection</label>
                </div>

                <div class="text-right">
                  <button class="btn btn-secondary" type="reset">Cancel</button>
                  <button class="btn btn-primary" type="submit" name="system">Save Changes</button>
                </div>
              </footer>
            </form>

            <div class="card">
              <h4 class="card-title"><strong>Database Backup</strong></h4>

              <div class="card-body">

                <form method="post" action="" class="form-inline">
                  <div class="form-group">
                    <label class="sr-only">Nombre del archivo:</label>
                    <input type="text" class="form-control" name="backup_name" value="<?= mysql_dbname ?>_b<?= date("ymd") ?>" required placeholder="<?= mysql_dbname ?>_b<?= date("ymd") ?>">
                  </div>

                  <div class="form-group">
                    <label class="sr-only">Respaldo</label>
                    <select id="tables" class="form-control select2" name="tables" multiple="multiple" required>
                      <?php if(!$sqlerror): $tables=$conn->query("SHOW TABLES");
                      while ($row = $tables->fetch_row()): ?>
                        <option value="<?= $row[0]; ?>"><?= $row[0]; ?></option>
                      <?php endwhile; endif; ?>
                    </select>
                  </div>

                  <button type="submit" name="mysqlbackup" class="btn btn-primary">Generar</button>
                </form>

              </div>
            </div>
            </div><!--/.main-content -->
        <?php require 'tpl/footer.php'; ?>
        </main>
        <!-- END Main container -->
        <?php require 'tpl/scripts.php'; if($sqlerror): ?>
          <script>
             app.toast("No hay conexión con la base de datos, por favor revisar configuraciones", {
              duration: 3000,
              actionTitle: 'Failed to connect to mysql',
              actionUrl:  '#',
              actionColor:  'danger'
            });
            </script>
        <?php endif; ?>
    </body>
</html>