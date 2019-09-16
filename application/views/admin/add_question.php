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
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right text-right top_search">
               <!-- <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search for...">
                  <span class="input-group-btn">
                  <button class="btn btn-default" type="button">Go!</button>
                  </span>
               </div> -->
                <a href="<?=site_url('./exams/add_question');?>" class="btn btn-primary">Save</a>
               <a href="<?=site_url('./exams/add_question');?>" class="btn btn-success">Publish</a>
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
         <div class="col-md-9 col-sm-12 col-xs-12">
            <div class="x_panel">
			   <div class="x_content">
			      <br />
			      <form class="form-horizontal adp-form-block">
			         <div class="form-group">
			            <label class="control-label">Question Name</label>
			            <div class="">
			               <input type="text" name="name" class="form-control" placeholder="Default Input">
			            </div>
			         </div>
			         <div class="form-group">
			            <label class="control-label">Select</label>
			            <div class="">
			               <select class="form-control">
			               	<option value="">--None--</option>
			               	<?php
			               	foreach ($categories as $category) {
			               	?>
			                  <option value="<?=$category['name'];?>"><?=$category['name'];?></option>
			               <?php
			           		}
			           ?>
			           			               </select>
			            </div>
			         </div>

			         <div class="form-group">
			            <label class="control-label">Question Type </label>
			            <div class="">
			               <select class="form-control">
			                  <option value="text">Text</option>
			                  <option value="audio">Audio</option>
			                  <option value="image">Image</option>
			                  <option value="misc">Miscellaneous</option>
			               </select>
			            </div>
			         </div>

			         
			         
			         <div class="ln_solid"></div>
			         <div class="form-group">
			            <div class="">
			               <button type="button" class="btn btn-primary">Cancel</button>
			               <button type="reset" class="btn btn-primary">Reset</button>
			               <button type="submit" class="btn btn-success">Submit</button>
			            </div>
			         </div>
			      </form>
			   </div>
			</div>
         </div>
         <div class="col-md-3 col-sm-12 col-xs-12">
	         <ul class="nav nav-tabs tabs-right">
				<li class="active"><a href="#home-r" data-toggle="tab">Home</a>
				</li>
				<li><a href="#profile-r" data-toggle="tab">Profile</a>
				</li>
				<li><a href="#messages-r" data-toggle="tab">Messages</a>
				</li>
				<li><a href="#settings-r" data-toggle="tab">Settings</a>
				</li>
			</ul>
		</div>
      </div>
   </div>
</div>