<div class="row">
         <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
               <div class="x_title">
                  <h2><?=$title;?></h2>
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
                  <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
                     <thead>
                        <tr>
                           <th><input type="checkbox" id="check-all" class="flat"></th>
                        <?php
                        if(empty($table_columns)){
                           $table_columns = $data_keys;
                        }

                        foreach ($table_columns as $column) {
                          echo "<th>".ucfirst($column)."</th>";
                        }
                        ?>
                         
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                        foreach ($result_rows as $row) {
                           echo '<tr><td>
                           <input type="checkbox" id="check-all" class="flat">
                           </td>';

                           foreach ($data_keys as $data_key) {
                             echo "<td>$row[$data_key]</td>";
                           }
                           // if(isset($action_keys)){
                           //    foreach ($action_keys as $action_key) {
                           //     echo  "<td>$action_key</td>";;
                           //    }
                              
                           // }
                          echo '<td><a href="./category/'.$row['slug'].'" class="btn btn-primary"><i class="fa fa-eye"></i></a> &nbsp;<a href="./category/'.$row['slug'].'"class="btn btn-danger"><i class="fa fa-trash"></i></a></td></tr>';
                        }
                        

                        ?>
                        
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>