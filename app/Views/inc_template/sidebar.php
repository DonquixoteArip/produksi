<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile border-bottom">
            <a href="#" class="nav-link flex-column">
                <div class="nav-profile-image">
                    <img src="<?= base_url('public/assets/images/faces/avatar-1.png') ?>" />
                </div>
                <div class="nav-profile-text d-flex ms-0 mb-3 flex-column mt-2">
                    <span class="font-weight-semibold mb-1 mt-2 text-center">Asep Sanjaya</span>
                    <span class="text-secondary icon-sm text-center">Rp. 10.000.000</span>
                </div>
            </a>
        </li>
        <li class="nav-item p-3">
            <form class="d-flex" action="#">
                <div class="input-group d-flex align-items-center">
                    <input type="text" class="form-control border rounded-pill px-3" placeholder="Search" id="search-input">
                    <span class="input-group-append">
                        <button type="button" class="btn btn-sm btn-outline-secondary bg-white border-start-0 border rounded-pill" title="Search">
                            <i class="fa fa-search text-dark fs-7"></i>
                        </button>
                    </span>
                </div>
            </form>
        </li>
        <li class="pt-2 pb-1">
            <span class="nav-item-head">Dashboard</span>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="fas fa-box fs-6 menu-icon"></i>
                <span class="menu-title">Product</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <i class="fas fa-server fs-6 menu-icon"></i>
                <span class="menu-title me-auto">Master</span>
                <i class="fas fa-chevron-right menu-title text-secondary fs-8"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="#">User</a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</nav>