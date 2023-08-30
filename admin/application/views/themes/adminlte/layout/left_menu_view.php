

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
     
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <!-- <li class="header">MAIN NAVIGATION</li> -->
        
        <!-- Search Start -->
		<!-- Search End -->
		<li class="<?php echo check_menu('dashboard',1);?>">
          <a href="dashboard">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
       
        <?php foreach ($this->menu as $menu){
	        if($menu['parent_stake_holder_privilege_id'] == 0 && $menu['menu_status'] == 't'){
	        ?>
	        <li class="treeview <?php echo check_menu($menu['privilege_page'],1);?>">
	          <a href="<?php echo $menu['privilege_page']?>">
	            <i class="fa <?php echo $menu['icon']?>"></i> <span><?php echo $menu['stake_holders_privilege_details']?></span>
	            <span class="pull-right-container">
	              <i class="fa fa-angle-left pull-right"></i>
	            </span>
	          </a>
	          <?php 
	          sub_menu($menu['council_privilege_id_pk'], $this->menu)
	          ?>
	        </li>
	        <?php
	        }
        }
        
        function sub_menu($parent_id= NULL, $menu_array = array()){ ?>
        	<ul class="treeview-menu">
        		<?php foreach($menu_array as $sub_menu) {
        			if($sub_menu['parent_stake_holder_privilege_id'] == $parent_id  && $sub_menu['menu_status'] == 't'){
        		?>
	            <li class="<?php echo check_menu($sub_menu['privilege_page'],2);?>"><a href="<?php echo $sub_menu['privilege_page'] ?>"><i class="fa <?php echo $sub_menu['icon'] ?>"></i> <?php echo $sub_menu['stake_holders_privilege_details'] ?></a>
	            <?php 
		        sub_menu($sub_menu['council_privilege_id_pk'], $menu_array)
		        ?>
	            </li>
	            <?php 
        			}
        		} ?>
	        </ul>
        <?php 
        }
        //echo check_menu('trainee/trainee_registration',1);
        //echo $this->uri->segment(1);
        function check_menu($page_name = NULL, $segment = 1){
			$ci=& get_instance();
			$arrs = explode('/',$page_name);
			if($arrs[$segment -1] == $ci->uri->segment($segment)){
				return  'active';
			}
			//return 'active';
			
		}
        ?>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->