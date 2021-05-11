<aside id="leftsidebar" class="sidebar">
    <!-- Menu -->
    <div class="menu">
        <ul class="list">
            <li class="sidebar-user-panel active">
                <div class="user-panel">
                    <div class=" image">
                        <img src="assets/images/usrbig.jpg" class="img-circle user-img-circle" alt="User Image" />
                    </div>
                </div>
                <div class="profile-usertitle">
                    <div class="sidebar-userpic-name"> Emily Smith </div>
                    <div class="profile-usertitle-job ">Manager </div>
                </div>
            </li>
            <li>
                <a href="pages/apps/calendar.html">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Home</span>
                </a>
            </li>
            <li>
                <a href="{{ route('produk.index') }}">
                    <i class="fas fa-dolly-flatbed"></i>
                    <span>Produk</span>
                </a>
            </li>
            <li>
                <a href="{{ route('penjualan.index') }}">
                    <i class="fas fa-dolly-flatbed"></i>
                    <span>Penjualan</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- #Menu -->
</aside>
