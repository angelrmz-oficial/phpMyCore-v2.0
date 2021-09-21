<?php require 'logged.php';
$page['id']=3;
$page['title']="Templates | phpMyCore | ". site_name;
require 'tpl/head.php'; ?>
    <body>
        <?php require 'tpl/sidebar.php'; require 'tpl/header.php'; ?>
        <!-- Main container -->
        <main class="main-container">
           
            <div class="main-content">
                <div class="row">
                    <div class="col-md-12">

                        <div class="card">
                            <h5 class="card-title">Templates</h5>
                            <div id="todo-app">
                                <div class="media-list media-list-hover">

                                <?php $tpls=array_diff(scandir(PATH_TPL), array('..', '.')); 
                                foreach ($tpls as $tpl): ?>
                                    <div class="media media-single">
                                        <div class="flex-grow-1">
                                        <label class="toggler fs-16 pl-12 d-none d-md-block">
                                            <input type="radio" name="selectpl" <?= $tpl == site_theme ? 'checked="" disabled' : 'onclick="Form.Post(\'update_tpl\', {site_theme: \''.$tpl.'\'});"'; ?>>
                                            <i class="fa fa-star"></i> <strong style="color:black !important; padding-left:15px"><?= $tpl; ?></strong>
                                        </label>
                                        </div>
                                        
                                        <!--<input id='<?= $tpl; ?>' type='file' name="file" onchange="uploadfile('<?= $tpl; ?>', this.files[0]);" accept=".zip" hidden/>
                                        <a href="javascript:$('#<?= $tpl; ?>').click()" target="" data-provide="tooltip" title="Upload template" class="media-action hover-danger"><i class="ti-upload"></i></a>-->
                                        
                                        <a href="filesmanager.php?tpl=<?= $tpl; ?>" target="_blank" data-provide="tooltip" title="Files Manager" class="media-action hover-danger"><i class="ti-archive"></i></a>

                                        <a href="javascript:Form.Post('delete_tpl', {template:'<?= $tpl; ?>'});" data-provide="tooltip" title="Delete" class="media-action hover-danger"><i class="ti-close"></i></a>
                                    </div>
                                <?php endforeach; ?>

                                </div> 
                                
                                <form method="post" action="" class="publisher bt-1 border-light">
                                    <input type="text" name="templatename" placeholder="Add new template" class="publisher-input" maxlength="15" required> 
                                    <button type="submit" class="btn btn-sm btn-secondary" name="template"><i class="fa fa-plus"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/.main-content -->
        <?php require 'tpl/footer.php'; ?>
        </main>
        <!-- END Main container -->

        <div id="qv-user-details" class="quickview quickview-lg"></div>


        <?php require 'tpl/scripts.php'; ?>
       <script>

           function uploadfile(name, file){
               var ajax = new XMLHttpRequest;

                var formData = new FormData;
                formData.append('file', file);

                ajax.upload.addEventListener("progress", myProgressHandler, false);
                ajax.addEventListener('load', myOnLoadHandler, false);
                ajax.open('POST', 'upload.php?tpl='+name, true);
                ajax.send(formData);

                return false;

           }
           function myProgressHandler(event) {
            //your code to track upload progress
            var p = Math.floor(event.loaded/event.total*100);
            //document.title = p+'%';
            }

            function myOnLoadHandler(event) {
            var response=event.target.responseText;//JSON.parse(event.target.responseText);
            console.log(response);
            }
           
       </script>
    </body>
</html>