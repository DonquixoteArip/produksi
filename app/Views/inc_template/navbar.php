<div class="container-fluid page-body-wrapper min-vh-100">
    <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
            <button class="navbar-toggler navbar-toggler d-flex align-items-center" id="btn-sideslide" type="button" data-toggle="minimize">
                <i class="fas fa-chevron-left fs-7 mx-2 icon-chevron" style="transition: 0.5s ease-in-out;"></i>
            </button>
            <ul class="navbar-nav mx-2">
                <div class="d-flex justify-content-between" style="width: 70px;">
                    <a class="nav-link" id="messageDropdown" href="#">
                        <i class="far fa-envelope text-white fs-6"></i>
                    </a>
                    <a class="nav-link" id="messageDropdown" href="#">
                        <i class="far fa-bell text-white fs-6"></i>
                    </a>
                </div>
            </ul>
            <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item nav-logout d-none d-lg-block">
                    <a class="nav-link d-flex justify-content-center btn-cahaya btn btn-primary rounded-circle p-2" style="width: 35px; height: 35px;" href="<?= base_url('logout') ?>"><i class="fas fa-power-off fs-6"></i></a>
                </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                <span class="fas fa-bars fs-6"></span>
            </button>
        </div>
    </nav>