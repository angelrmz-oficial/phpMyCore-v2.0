<?php require 'load.logged.php';

if(!in_array("router", $userApp['permissions']))
  die("No tiene permiso necesario para realizar esta acción");

$routerJSON=json_decode(file_get_contents(APP_TPL . 'router.json'), true); //exist??
//if(count($routerJSON) > 0)

$routerCgs=null;

foreach ($routerJSON as $router => $cgs):
  if($post['route'] == $router):
    $routerCgs=$cgs; break;
  endif;
endforeach;

if(is_null($routerCgs))
  die("Ruta no encontrada!");

?>
<form id="add" method="post" action="">
      <header class="quickview-header">
        <p class="quickview-title lead fw-400">Edit Route | <?= $post['route']; ?></p>
        <span class="close"><i class="ti-close"></i></span>
      </header>

      <div class="quickview-body">
        <div class="quickview-block">
          <div class="form-group">
            <label>Route</label>
            <input type="text" class="form-control" name="route" value="<?= $post['route']; ?>" readonly required>
            
          </div>

          <div class="form-group">
            <label>Page Name</label>
            <input type="text" class="form-control" name="subtitle" value="<?= $routerCgs['subtitle'];?>" required>
          </div>

          <div class="form-group">
          <label>Select Parent</label>
            <select class="form-control" name="subid">
             
                <?php $routerJSON=json_decode(file_get_contents(APP_TPL . 'router.json'), true); 
                  $ninguno=true;
                  $options=""; 
                  if(count($routerJSON) > 0):
                    foreach ($routerJSON as $router => $cgs):
                      $selected="";
                      if($cgs['id'] == $routerCgs['subid']):
                        $selected="selected";
                        $ninguno=false;
                      endif;
                        $options .= '<option value="'.$cgs['id'].'" '. $selected .'>'. $router . '</option>';
                    endforeach;
                  endif;

                  echo '<option value=" " '. ( $ninguno === true ? "selected" : "") .'>Ninguno</option>' . $options;

                ?>
            </select>
          </div>


          <div class="form-group">
            <label>Main View</label>
            <select class="form-control" name="view">
                <?php $views=preg_grep('~\.(php)$~', scandir(APP_TPL . 'views'));
                $ninguno=true;
                $options="";         
                foreach ($views as $view):
                    $selected="";
                    if(str_replace(".php", "", $view) == $routerCgs['view']):
                      $selected="selected";
                      $ninguno=false;
                    endif;
                    $options .= '<option value="'.str_replace(".php", "", $view).'" '. $selected .'>'.str_replace(".php", "", $view).'</option>';
                endforeach;
                
                echo '<option value=" " '. ( $ninguno === true ? "selected" : "") .'>Ninguno</option>' . $options;


                ?>
            </select>
            
          </div>
          

          <div class="form-group">
            <label>Menu</label>
            <input type="text" class="form-control" name="submenu" value="<?= $routerCgs['submenu'];?>">
          </div>

          <div class="form-group">
            <label>Require Permissions</label>
            <textarea class="form-control" rows="5" name="permission"><?= $routerCgs['permission'];?></textarea>
          </div>

          <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" name="session" <?= $routerCgs['session'] === TRUE ? "checked" : "";?>>
                <label class="custom-control-label">Required Session</label>
            </div>


        </div>
        
      </div>

      <footer class="p-12 flexbox flex-justified">
        <button class="btn btn-flat btn-secondary" type="button" data-toggle="quickview">Cancel</button>
        
        <button class="btn btn-flat btn-primary" type="submit" name="router_edit">Save changes</button>
      </footer>
    </form>