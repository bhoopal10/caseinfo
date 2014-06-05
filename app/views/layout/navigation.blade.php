<div class="navbar navbar-inverse " id="navbar">
    <!-- <div class="navbar-inner"> -->
        <div class="navbar-container" id="navbar-container">
            <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler">
                <span class="sr-only">Toggle sidebar</span>

                <span class="icon-bar"></span>

                <span class="icon-bar"></span>

                <span class="icon-bar"></span>
            </button>
            <div class="navbar-header pull-left">
                <ul class="nav ace-nav">
                    <li><a href="<?php echo URL::to('/'); ?>">Home</a></li>
                    <li><a href="<?php echo URL::to( 'cases/list' ); ?>">Cases</a></li>
                </ul>
            </div>
            <ul class="nav ace-nav pull-right">
                @if(Auth::check())
               <li class="light-blue user-profile">
                <a data-toggle="dropdown" href="#" class="user-menu dropdown-toggle">
                    <span id="user_info">
						<small>Welcome,</small>
					    {{Auth::user()->DisplayName}}
					</span>
                    <i class="icon-caret-down"></i>
                </a>
                <ul class="pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-closer" id="user_menu">
                    <li><a href="<?php echo URL::to('account/logout'); ?>">Logout</a></li>
                    <li><a href="<?php echo URL::to('account/change-password'); ?>">change password</a></li>
                </ul>
                </li>
                @else
                <li><a href="<?php echo URL::to('account/login'); ?>">Login</a></li>
                <li><a href="<?php echo URL::to('account/create'); ?>">Register</a></li>
                @endif
            </ul>
        </div>
    <!-- </div> -->
</div>