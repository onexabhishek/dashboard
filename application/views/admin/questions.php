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
               <!-- <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search for...">
                  <span class="input-group-btn">
                  <button class="btn btn-default" type="button">Go!</button>
                  </span>
               </div> -->
               <a href="<?=site_url('./exams/add_question');?>" class="btn btn-primary pull-right">Add Question</a>
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
      <div class="clearfix"></div>
      <div class="row">
         <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
               <div class="x_content">
                  <table id="datatable-checkbox" class="table table-hover bulk_action">
                     <thead>
                        <tr>
                           <th>
                           <th><input type="checkbox" id="check-all" class="flat"></th>
                           </th>
                           <th>Name</th>
                           <th>Category</th>
                           <th>Type</th>
                           <th>Status</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                        foreach($questions as $question){
                        ?>
                        <tr>
                           <td>
                           <th><input type="checkbox" id="check-all" class="flat"></th>
                           </td>
                           <td><?=$question['name'];?></td>
                           <td><?=$question['category'];?></td>
                           <td><?=$question['type'];?></td>
                           <td><?= $question['act_state'] == '0' ? '<span class="label label-default">Inactive</span>':'<span class="label label-success">Active</span>';?></td>
                           <td><a href="" class="badge label-primary"><i class="fa fa-eye"></i></a>&nbsp;<a href="" class="badge label-danger"><i class="fa fa-trash"></i></a></td>
                        </tr>
                        <?php
                        }
                     ?>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>