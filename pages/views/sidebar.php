<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index">

        <div class="sidebar-brand-text mx-3">
            <?php echo $siteSettingsData['site_title'] ?>
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item ">
        <a class="nav-link" href="settings">
            <i class="fa-solid fa-gear"></i>
            <span>Site Ayarları</span>
        </a>
    </li>

    <li class="nav-item ">
        <a class="nav-link" href="social-media">
        <i class="fa-solid fa-hashtag"></i>
            <span>Sosyal Medya</span>
        </a>
    </li>

    <!-- <li class="nav-item ">
        <a class="nav-link" href="about-us">
        <i class="fa-solid fa-users"></i>
            <span>Hakkımızda</span>
        </a>
    </li>

    <li class="nav-item ">
        <a class="nav-link" href="mision-vision">
        <i class="fa-solid fa-puzzle-piece"></i>
            <span>Misyon ve Vizyon</span>
        </a>
    </li>

    <li class="nav-item ">
        <a class="nav-link" href="bank-account-list">
        <i class="fa-solid fa-building-columns"></i>
            <span>Banka Hesapları</span>
        </a>
    </li>

    <li class="nav-item ">
        <a class="nav-link" href="our-document-list">
        <i class="fa-solid fa-file-pdf"></i>
            <span>Belgelerimiz</span>
        </a>
    </li>

    <li class="nav-item ">
        <a class="nav-link" href="gallery-item-list">
        <i class="fa-solid fa-images"></i>
            <span>Galeri</span>
        </a>
    </li>

    <li class="nav-item ">
        <a class="nav-link" href="slider-item-list">
        <i class="fa-solid fa-images"></i>
            <span>Slider</span>
        </a>
    </li>
    
    <li class="nav-item ">
        <a class="nav-link" href="magaza-slider-list">
        <i class="fa-solid fa-images"></i>
            <span>Mağaza Slider</span>
        </a>
    </li>

    <li class="nav-item ">
        <a class="nav-link" href="our-brands-list">
        <i class="fa-solid fa-tag"></i>
            <span>Markalarımız</span>
        </a>
    </li>

    
    <li class="nav-item ">
        <a class="nav-link" href="user-list">
        <i class="fa-solid fa-user"></i>
            <span>Kullanıcılar</span>
        </a>
    </li>

    <li class="nav-item ">
        <a class="nav-link" href="category-list">
        <i class="fa-solid fa-folder-tree"></i>
            <span>Kategoriler</span>
        </a>
    </li>

    <li class="nav-item ">
        <a class="nav-link" href="product-list">
        <i class="fa-solid fa-box"></i>
            <span>Ürünler</span>
        </a>
    </li>

    <li class="nav-item ">
        <a class="nav-link" href="order-list">
        <i class="fa-solid fa-truck"></i>
            <span>Siparişler</span>
        </a>
    </li> -->

    <!-- Divider -->
    <hr class="sidebar-divider">

   

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#anaSite" aria-expanded="true"
            aria-controls="anaSite">
            <i class="fa-solid fa-caravan"></i>
            <span>Ana Site</span>
        </a>
        <div id="anaSite" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="about-us"><i class="fa-solid fa-users"></i> Hakkımızda</a>
                <a class="collapse-item"  href="mision-vision"><i class="fa-solid fa-puzzle-piece"></i> Misyon Vizyon</a>
                <a class="collapse-item"  href="our-document-list"><i class="fa-solid fa-file-pdf"></i> Belgelerimiz</a>
                <a class="collapse-item"  href="why-us-list"><i class="fa-solid fa-question"></i> Neden Biz</a>
                <a class="collapse-item"  href="gallery-item-list"><i class="fa-solid fa-images"></i> Galeri</a>
                <a class="collapse-item"  href="slider-item-list"><i class="fa-solid fa-images"></i> Slider</a>
                <a class="collapse-item"  href="our-brands-list"><i class="fa-solid fa-tag"></i> Markalarımız</a>
                <a class="collapse-item"  href="k-category-list"><i class="fa-solid fa-folder-tree"></i> Kategoriler</a>
                <a class="collapse-item"  href="k-product-list"><i class="fa-solid fa-box"></i> Ürünler</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#market" aria-expanded="true"
            aria-controls="market">
            <i class="fa-solid fa-store"></i>
            <span>Mağaza</span>
        </a>
        <div id="market" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="bank-account-list"><i class="fa-solid fa-building-columns"></i> Banka Hesapları</a>
                <a class="collapse-item"  href="magaza-slider-list"><i class="fa-solid fa-images"></i> Mağaza Slider</a>
                <a class="collapse-item"  href="user-list"><i class="fa-solid fa-user"></i> Kullanıcılar</a>
                <a class="collapse-item"  href="category-list"><i class="fa-solid fa-folder-tree"></i> Kategoriler</a>
                <a class="collapse-item"  href="product-list"><i class="fa-solid fa-box"></i> Ürünler</a>
                <a class="collapse-item"  href="order-list"><i class="fa-solid fa-truck"></i> Siparişler</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Utilities</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Utilities:</h6>
                <a class="collapse-item" href="utilities-color.html">Colors</a>
                <a class="collapse-item" href="utilities-border.html">Borders</a>
                <a class="collapse-item" href="utilities-animation.html">Animations</a>
                <a class="collapse-item" href="utilities-other.html">Other</a>
            </div>
        </div>
    </li> -->





</ul>
<!-- End of Sidebar -->