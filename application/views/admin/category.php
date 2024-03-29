<div class="container body">
<div class="main_container">
<?php $this->view('admin/templates/left_nav'); ?>
<?php $this->view('admin/templates/top_nav'); ?>
<div class="right_col" role="main">
   <div class="">
      <div class="page-title">
         <div class="title_left">
            <h3><?=$title;?></h3>
         </div>
         <div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
               <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search for...">
                  <span class="input-group-btn">
                  <button class="btn btn-default" type="button">Go!</button>
                  </span>
               </div>
            </div>
         </div>
      </div>
      <div class="clearfix"></div>
      <div class="alert-box">
         <?php 
         if(isset($_SESSION['alert'])){
         $alert = $_SESSION['alert'];
         // var_dump($alerts);
         // foreach ($alerts as $alert) {
  
          ?>
         <div class="alert alert-<?php echo !empty($alert) ? $alert['type'] : '';?>">
            <?php echo !empty($alert['msg']) ? $alert['msg'] :''; ?>
         </div>
         <?php
      }
         // }
      ?>
      </div>
      <div class="clearfix"></div>
      <div class="row">
         <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
               <div class="x_title">
                  <h2>Form Design <small>different form elements</small></h2>
                  <ul class="nav navbar-right panel_toolbox">
                     <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                     <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                           <li><a href="#">Settings 1</a></li>
                           <li><a href="#">Settings 2</a></li>
                        </ul>
                     </li>
                     <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                  </ul>
                  <div class="clearfix"></div>
               </div>
               <div class="x_content">
                  <br />
               <?php
               if(isset($selected_data) && !empty($selected_data)){
                  // var_dump($selected_data);
               ?>
                  <form action="<?php echo site_url('./category/update_category'); ?>" method="POST" class="form-horizontal form-label-left form-update adp-validate-form" data-target="adp_question_category" novalidate>
                     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category-name">Category Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <input type="text" id="category-name" name="name" value="<?=$selected_data->name;?>"  data-validate="notEmpty" unique-in="adp_question_category" required="required" class="form-control col-md-7 col-xs-12 adp-validate unique">
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="slug">Slug <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <input type="text" id="slug" name="slug" value="<?=$selected_data->slug;?>" data-validate="notEmpty" required="required" class="form-control col-md-7 col-xs-12 adp-validate">
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Parent Category</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                           <select class="form-control col-md-7 col-xs-12" name="parent_category">
                              <option selected="selected">None</option>
                               <?php
                             foreach ($table_data['result_rows'] as $get_names) {
                              ?>
                              <option value="<?=$get_names['name'];?>"><?=$get_names['name'];?></option>
                              <?php
                             }
                             ?>
                           </select>
                     </div>
                        
                     </div>
                     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Public</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <div id="gender" class="btn-group" data-toggle="buttons">
                              
                              <input type="checkbox" class="js-switch is_public" data-switchery="true">
                              <input type="hidden" value="<?=$selected_data->is_public;?>" name="is_public" id="is_public" value="0">
                              <input type="hidden" value="<?=$selected_data->id;?>" name="id" id="id" value="0">
                              <script>
                                 var clickCheckbox = document.querySelector('.is_public')
                                   // , clickButton = document.querySelector('.js-check-click-button');

                                 clickCheckbox.addEventListener('change', function() {
                                   $('#is_public').val(clickCheckbox.checked == 'false' ? 0 : 1);
                                 });
                              </script>
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Description</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <textarea name="des" class="form-control col-md-7 col-xs-12" placeholder="Enter Text here..."><?=$selected_data->des;?></textarea>
                        </div>
                     </div>
                     
                     <div class="ln_solid"></div>
                     <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                           <button class="btn btn-primary" type="button">Cancel</button>
                           <button class="btn btn-primary" type="reset">Reset</button>
                           <button class="btn btn-success adp-submit">Submit</button>
                        </div>
                     </div>
                  </form>
               <?php
                  }elseif(empty($selected_data)){

               ?>
                <form action="<?php echo site_url('./category/add_category'); ?>" method="POST" class="form-horizontal form-label-left form-insert adp-validate-form" data-target="adp_question_category" novalidate>
                     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category-name">Category Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <input type="text" id="category-name" name="name"  data-validate="notEmpty" required="required" class="form-control col-md-7 col-xs-12 adp-validate">
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="slug">Slug <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <input type="text" id="slug" name="slug" data-validate="notEmpty" required="required" class="form-control col-md-7 col-xs-12 adp-validate">
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Parent Category</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                           <select class="form-control col-md-7 col-xs-12" name="parent_category">
                              <option selected="selected">None</option>
                              <option>Option one</option>
                              <option>Option two</option>
                              <option>Option three</option>
                              <option>Option four</option>
                           </select>
                     </div>
                        
                     </div>
                     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Public</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <div id="gender" class="btn-group" data-toggle="buttons">
                              
                              <input type="checkbox" class="js-switch is_public" data-switchery="true">
                              <input type="hidden" name="is_public" id="is_public" value="0">
                              <script>
                                 var clickCheckbox = document.querySelector('.is_public')
                                   // , clickButton = document.querySelector('.js-check-click-button');

                                 clickCheckbox.addEventListener('change', function() {
                                   $('#is_public').val(clickCheckbox.checked == 'false' ? 0 : 1);
                                 });
                              </script>
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Description</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <textarea name="des" class="form-control col-md-7 col-xs-12" placeholder="Enter Text here..."></textarea>
                        </div>
                     </div>
                     
                     <div class="ln_solid"></div>
                     <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                           <button class="btn btn-primary" type="button">Cancel</button>
                           <button class="btn btn-primary" type="reset">Reset</button>
                           <button class="btn btn-success adp-submit">Submit</button>
                        </div>
                     </div>
                  </form>

               <?php
                  }
               ?>
               </div>
            </div>
         </div>
      </div>
       <?php
       $table_data['title'] ='Categories';
      $table_data['table_columns'] = ['Name','Slug','Parent Category','Action'];
      $table_data['data_keys'] = ['name','slug','parent_category'];
      $table_data['action_keys'] = ['<a href="./view" class="btn btn-primary"><i class="fa fa-eye"></i></a> &nbsp;<a href="./view" class="btn btn-danger"><i class="fa fa-trash"></i></a>'];
       $this->view('admin/templates/datatable',$table_data); ?>


   </div>
</div>