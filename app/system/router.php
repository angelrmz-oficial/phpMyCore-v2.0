<?php require 'logged.php';
$page['id']=4;
$page['title']="Router | phpMyCore | ". site_name;
require 'tpl/head.php'; ?>
    <body>
        <?php require 'tpl/sidebar.php'; require 'tpl/header.php'; ?>
        <!-- Main container -->
        <main class="main-container">
            <div class="main-content">
            <header class="flexbox align-items-center media-list-header bg-transparent b-0 py-16 pl-20">
                <div class="flexbox align-items-center">
                Select template

                    <span class="divider-line mx-1"></span>
                    
                    <div class="dropdown">
                    <a class="btn btn-sm dropdown-toggle" data-toggle="dropdown" href="#"><?= site_theme; ?></a>
                    <div class="dropdown-menu">
                    
                    <?php $tpls=array_diff(scandir(PATH_TPL), array('..', '.')); 
                    foreach ($tpls as $tpl)
                        if($tpl !== site_theme)
                            echo '<a class="dropdown-item" href="javascript:var data = {site_theme: \''.$tpl.'\'};Form.Post(\'update_tpl\', data);">'.$tpl.'</a>';
                    ?>
                    </div>
                    </div> 
                </div>

                <div>
                    <div class="lookup lookup-circle lookup-right">
                    <input id="SearchRoute" type="text" data-provide="media-search">
                    </div>
                    <span class="divider-line mx-1"></span>

                    <a class="btn btn-sm btn-success" href="#qv-product-details" data-toggle="quickview" onclick="$('#add')[0].reset()"><i class="fa fa-plus"></i> Route</a>
                </div>
                </header>
                <div class="row">
                    
                    <!--
                    <div class="col-12">
                        <form method="post" action="" class="card">
                            <h4 class="card-title fw-400">Theme</h4>

                            <div class="card-body">
                            <div class="row form-type-material">

                                <div id="selectemplate" class="col-12">
                                <div class="form-group">
                                    <select class="form-control" name="selectpl" onchange="selectemplate(this.value)" data-provide="selectpicker">
                                    <option value="/">Crear nuevo tema</option>
                                    <?php $tpls=array_diff(scandir(PATH_TPL), array('..', '.')); 
                                    if(!in_array(site_theme, $tpls))
                                        echo "<option value=\"".site_theme."\" selected>".site_theme."</option>";
                                    foreach ($tpls as $tpl)
                                        echo $tpl == site_theme ? "<option value=\"{$tpl}\" selected>{$tpl}</option>" : "<option value=\"{$tpl}\">{$tpl}</option>";
                                    ?>
                                    </select>
                                    <label>Select template</label>
                                </div>
                                </div>

                                <div id="templatename" class="col-md-6" style="display:none">
                                <div class="form-group">
                                    <input class="form-control" name="templatename" type="text">
                                    <label>Template Name</label>
                                </div>
                                </div>
                            </div>

                            </div>

                            <footer class="card-footer text-right">
                            <button class="btn btn-flat btn-primary" type="submit" name="template">Aplicar cambios</button>
                            </footer>
                        </form>
                    </div>-->


                    <div class="col-12">
                        <div class="card">
                            <h4 class="card-title fw-400">URL Router</h4>

                            <div class="card-body">
                            <div class="row form-type-material">
                                
                                <div class="col-12">
                                    <table id="routers" class="table">
                                        <thead>
                                            <tr>
                                            <th scope="col">Route</th>
                                            <th scope="col">Page</th>
                                            <th scope="col">Parent</th>
                                            <th scope="col">Main View</th>
                                            <th scope="col">Menu</th>
                                            <th scope="col">Required session</th>
                                            <th scope="col">Required permissions</th>
                                            <th scope="col">Options</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $routerJSON=json_decode(file_get_contents(APP_TPL . 'router.json'), true);
                                            if(count($routerJSON) > 0):
                                            foreach ($routerJSON as $router => $cgs):
                                            ?>

                                            <tr>
                                            <td scope="row"><a href="<?= site_url . "/" . $router; ?>" target="_blank"><?= $router; ?></a></td>
                                            <td><?= $cgs['subtitle']; ?></td>
                                            <td><?= (new app)->getParentNameById($cgs['subid']); ?></td>
                                            <td><?= $cgs['view']; ?></td>
                                            <td><?= $cgs['submenu']; ?></td>
                                            <td><?= $cgs['session'] === true ? "Yes" : "No"; ?></td>
                                            <td><?= $cgs['permission']; ?></td>
                                            <td>
                                                <a href="#qv-user-details" data-toggle="quickview" class="btn btn-sm btn-warning" onclick="var data = {route: '<?= $router; ?>'}; Form.Load('router_edit', data); "><i class="fa fa-edit"></i></a>
                                                <button type="button" class="btn btn-sm btn-danger" onclick="var data = {route: '<?= $router; ?>'}; Form.Post('router_delete', data);"><i class="fa fa-trash"></i></button></td>
                                            </tr>

                                            <?php endforeach; else: ?>
                                                <tr>
                                                    <th colspan="8" style="text-align:center;">No se ha encontrado ningún enrutamiento</th>
                                                </tr>
                                            <?php endif;?>

                                        </tbody>
                                    </table>
                                </div>
                                
                            </div>

                            </div>
                        </div>
                    </div>


                </div>
            </div><!--/.main-content -->
        <?php require 'tpl/footer.php'; ?>
        </main>
        <!-- END Main container -->

        <div id="qv-user-details" class="quickview quickview-lg"></div>

        <div id="qv-product-details" class="quickview quickview-lg">
            <form id="add" method="post" action="">
      <header class="quickview-header">
        <p class="quickview-title lead fw-400">Add new route</p>
        <span class="close"><i class="ti-close"></i></span>
      </header>

      <div class="quickview-body">

        <div class="quickview-block form-type-material">
          <div class="form-group">
            <input type="text" class="form-control" name="route" required>
            <label>Route</label>
          </div>

          <div class="form-group">
            <input type="text" class="form-control" name="subtitle" required>
            <label>Page Name</label>
          </div>

          <div class="form-group">
            <select class="form-control" name="subid">
             <option value=" " selected>Ninguno</option>
                <?php $routerJSON=json_decode(file_get_contents(APP_TPL . 'router.json'), true);
                if(count($routerJSON) > 0)
                    foreach ($routerJSON as $router => $cgs)
                        echo '<option value="'.$cgs['id'].'">'. $router . '</option>';
                ?>
            </select>
            <label>Select Parent</label>
          </div>


          <div class="form-group">
            <select class="form-control" name="view">
                <option value=" " selected>Ninguno</option>
                <?php $views=preg_grep('~\.(php)$~', scandir(APP_TPL . 'views'));                
                foreach ($views as $view)
                    echo '<option value="'.str_replace(".php", "", $view).'">'.str_replace(".php", "", $view).'</option>';
                ?>
            </select>
            <label>Main View</label>
          </div>
          

          <div class="form-group">
          <input type="text" class="form-control" name="submenu">
            <label>Menu</label>
          </div>

          <div class="form-group">
            <textarea class="form-control" rows="5" name="permission"></textarea>
            <label>Require Permissions</label>
          </div>

          <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" name="session">
                <label class="custom-control-label">Required Session</label>
            </div>


        </div>
        
      </div>

      <footer class="p-12 flexbox flex-justified">
        <button class="btn btn-flat btn-secondary" type="button" data-toggle="quickview">Cancel</button>
        
        <button class="btn btn-flat btn-primary" type="submit" name="router_add">Save changes</button>
      </footer>
    </form>
    </div>

        <?php require 'tpl/scripts.php'; ?>
       <script>
           /*function selectemplate(value){
               if(value == "/"){
                $("#selectemplate").removeClass('col-12').addClass('col-md-6');
                $("#templatename").find('input').attr('required', 'required').val('');
                $("#templatename").show();
               }else{
                $("#selectemplate").removeClass('col-md-6').addClass('col-12');
                $("#templatename").find('input').removeAttr('required').val('');
                $("#templatename").hide();

               }
            
           }*/

           $("#SearchRoute").keyup(function() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("SearchRoute");
            filter = input.value.toUpperCase();
            table = document.getElementById("routers");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                
                if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
                }       
            }
           });
       </script>
    </body>
</html>