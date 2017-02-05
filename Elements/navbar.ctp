<div id="header" class="sticky header-md clearfix">
  <!-- TOP NAV -->
	<header id="topNav">
		<div class="container">

			<!-- Mobile Menu Button -->
			<button class="btn btn-mobile" data-toggle="collapse" data-target=".nav-main-collapse">
				<i class="fa fa-bars"></i>
			</button>

			<!-- Logo -->
			<a class="logo pull-left" href="<?= $this->Html->url('/') ?>">
        <?= $this->Html->image('logo.png', array('alt' => 'obsilogo')) ?>
			</a>

			<!--
				Top Nav
			-->
			<div class="navbar-collapse pull-right nav-main-collapse collapse submenu-dark">
				<nav class="nav-main">
					<ul id="topMain" class="nav nav-pills nav-main">

            <li>
              <a href="<?= $this->Html->url('/') ?>"><?= $Lang->get('GLOBAL__HOME') ?></a>
            </li>

            <?php
            if(isset($nav) && !empty($nav)) {

              $i = 0;
              foreach ($nav as $key => $value) { // On parcours la navbar
                $i++;

                if(empty($value['Navbar']['submenu'])) { // Menu normal

                  echo '<li>';
                    echo '<a href="'.$value['Navbar']['url'].'">';
										echo $value['Navbar']['name'];
                    if ($i === 3)
                      echo '&nbsp;&nbsp;<sup><span class="label label-success">Nouveau</span></sup>';
										echo '</a>';
                  echo '</li>';

                } else { // Sous-menu

                  echo '<li class="dropdown">';
										echo '<a class="dropdown-toggle" href="#">';
											echo $value['Navbar']['name'];
										echo '</a>';
										echo '<ul class="dropdown-menu">';
                      $submenu = json_decode($value['Navbar']['submenu']);
                      foreach ($submenu as $k => $v) {
                        echo '<li><a href="'.rawurldecode($v).'">'.$k.'</a></li>';
                      }
										echo '</ul>';
									echo '</li>';

                }

              }

            }

            ?>
					</ul>

				</nav>
			</div>

		</div>
	</header>
	<!-- /Top Nav -->
</div>
