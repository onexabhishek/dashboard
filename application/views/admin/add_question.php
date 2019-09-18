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
			      <?php
			      if(empty($question)){
			      ?>
			      <form class="form-horizontal form-create-question adp-validate-form adp-form-block" action="<?=site_url('./exams/insert_question');?>" data-target="adp_questions" next-step="question" method="POST">
			         <div class="form-group">
			            <label class="control-label">Question Name</label>
			            <div class="">
			               <input type="text" name="name" id="name" class="form-control adp-validate unique" unique-in="adp_questions" placeholder="Default Input">
			            </div>
			         </div>
			         <div class="form-group">
			            <label class="control-label">Category</label>
			            <div class="">
			               <select name="category" class="form-control">
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
			               <select class="form-control" name="type">
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
			               <button type="submit" class="btn btn-success adp-submit">Next</button>
			            </div>
			         </div>
			      </form>
			      <?php
			  }elseif(isset($question)){

			      ?>
			       <form class="form-horizontal form-create-question adp-validate-form adp-form-block" action="<?=site_url('./exams/insert_question');?>" data-target="adp_questions" next-step="add_question" method="POST">
			         <div class="form-group">
			            <label class="control-label">Question</label>
			            <div class="">
			               <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target=".addQuestion">Add Question</button>
			            </div>
			         </div>

			         
			         
			         <div class="ln_solid"></div>
			         <div class="form-group">
			            <div class="">
			               <button type="button" class="btn btn-primary">Cancel</button>
			               <button type="reset" class="btn btn-primary">Reset</button>
			               <button type="submit" class="btn btn-success adp-submit">Next</button>
			            </div>
			         </div>
			      </form>
			      <?php
			  }
			      ?>
			   </div>
			</div>
         </div>
         <div class="col-md-3 col-sm-12 col-xs-12">
	         <ul class="nav nav-tabs tabs-right">
				<!-- <li class="<?=isset($create_question) ? 'active':'';?>"><a href="#create_question" data-toggle="tab">Create Question</a>
				</li>
				<li class="<?=isset($question) ? 'active':'';?>"><a href="#add_question" data-toggle="tab">Add Question</a>
				</li>
				<li><a href="#messages-r" data-toggle="tab">Messages</a>
				</li>
				<li><a href="#settings-r" data-toggle="tab">Settings</a>
				</li> -->
			</ul>
		</div>
      </div>
   </div>
</div>

<div class="modal fade addQuestion" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
   <div class="modal-dialog modal-md">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">Add Question</h4>
         </div>
         <div class="modal-body">

            <form>
            	<div class="form-group">
            		<label>Question Type</label>
            		<select type="text" name="question_type" id="question_type" class="form-control">
            			<option value="check">Objective [Check]</option>
            			<option value="radio">Objective [Radio]</option>
            			<option value="subjective">Subjective</option>
            		</select>
            	</div>
            <div class="question-container">
            	<div class="form-group">
            		<label>Question</label>
            		<div id="question_editor"></div>
                	<input type="hidden" id="question_value" name="question_name" class="form-control" value="">
            	</div>
            </div>
            <div class="form-group">
            	<label>Answer</label>
            		<div class="answer-container">
            			<div class="answerCheck">
            				<button class="btn btn-default pull-right" id="inputChecks" data-type="check">Add Option</button>

            				<div class="checkData ans-wrapper">
            					<div class="form-group">
            						<label> Option 1</label>
            						<input type="checkbox" name="">
            					</div>
            					<div class="form-group">
            						<label> Option 2</label>
            						<input type="checkbox" name="">
            					</div>
            					<div class="form-group">
            						<label> Option 3</label>
            						<input type="checkbox" name="">
            					</div>
            					<div class="form-group">
            						<label> Option 4</label>
            						<input type="checkbox" name="">
            					</div>
            				</div>
            				<!-- </div> -->
            			</div>
            			<div class="answerRadio">
            				<button class="btn btn-default pull-right" data-type="radio">Add Option</button>
            				<div class="radioData ans-wrapper">
            					<div class="form-group">
            						<label> Option 1</label>
            						<input type="radio" name="">
            					</div>
            					<div class="form-group">
            						<label> Option 2</label>
            						<input type="radio" name="">
            					</div>
            					<div class="form-group">
            						<label> Option 3</label>
            						<input type="radio" name="">
            					</div>
            					<div class="form-group">
            						<label> Option 4</label>
            						<input type="radio" name="">
            					</div>
            				</div>
            			</div>
            			<div class="subjective">

            			</div>
            	</div>
            </div>
            	<input type="submit" name="submit" class="btn btn-success btn-block" value="Add Question">
            </form>

         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
         </div>
      </div>
   </div>
</div>