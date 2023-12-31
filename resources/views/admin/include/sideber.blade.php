<div class="sidebar-wrapper">
    <div id="sidebarEffect"></div>
    <div>
        <div class="logo-wrapper logo-wrapper-center">
            <a href="index.html" data-bs-original-title="" title="">
                <img class="img-fluid for-white" src="{{asset('backend')}}/assets/images/logo/full-white.png" alt="logo">
            </a>
            <div class="back-btn">
                <i class="fa fa-angle-left"></i>
            </div>
            <div class="toggle-sidebar">
                <i class="ri-apps-line status_toggle middle sidebar-toggle"></i>
            </div>
        </div>
        <div class="logo-icon-wrapper">
            <a href="index.html">
                <img class="img-fluid main-logo main-white" src="{{asset('backend')}}/assets/images/logo/logo.png" alt="logo">
                <img class="img-fluid main-logo main-dark" src="{{asset('backend')}}/assets/images/logo/logo-white.png"
                    alt="logo">
            </a>
        </div>
        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow">
                <i data-feather="arrow-left"></i>
            </div>
  
            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    <li class="back-btn"></li>
  
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="index.html">
                            <i class="ri-home-line"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
  
                    <li class="sidebar-list">
                      <a class="">
                          <span class="disabled">PRODUCTS</span>
                      </a>
                    </li>

                    <li class="sidebar-list">
                        <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
                            <i class="ri-list-check-2"></i>
                            <span>Category</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="{{route('categories.index')}}">Category List</a>
                            </li>
  
                            <li>
                                <a href="{{route('categories.create')}}">Add New Category</a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-list">
                        <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
                            <i class="ri-list-check-2"></i>
                            <span>SubCategory</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="{{route('subcategories.index')}}">Category List</a>
                            </li>
  
                            <li>
                                <a href="{{route('subcategories.create')}}">Add New Category</a>
                            </li>
                        </ul>
                    </li>
  
                    <li class="sidebar-list">
                        <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
                            <i class="ri-store-3-line"></i>
                            <span>Product</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="{{route('products.index')}}">Prodcts</a>
                            </li>
  
                            <li>
                                <a href="{{route('products.create')}}">Add New Products</a>
                            </li>
                            <li>
                                <a href="{{route('products.variation')}}">Variation</a>
                            </li>
                        </ul>
                    </li>
  

                    <li class="sidebar-list">
                        <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
                            <i class="ri-list-settings-line"></i>
                            <span>Units</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="">Unit List</a>
                            </li>
  
                            <li>
                                <a href="">Add Unit</a>
                            </li>
                        </ul>
                    </li>
  
                    <li class="sidebar-list">
                      <a class="">
                          <span class="disabled">USERS</span>
                      </a>
                    </li>
  
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title" href="javascript:void(0)">
                            <i class="ri-user-3-line"></i>
                            <span>Users</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="">All users</a>
                            </li>
                            <li>
                                <a href="">Add new user</a>
                            </li>
                        </ul>
                    </li>
  
                    <li class="sidebar-list">
                      <a class="">
                          <span class="disabled">pages</span>
                      </a>
                    </li>
                    <li class="sidebar-list">
                      <a class="sidebar-link sidebar-title" href="">
                          <i class="ri-user-3-line"></i>
                          <span>customers</span>
                      </a>
                      <a class="sidebar-link sidebar-title" href="">
                          <i class="ri-user-3-line"></i>
                          <span>suppliers</span>
                      </a>
  
                      
                  </li>
  
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title" href="javascript:void(0)">
                            <i class="ri-user-3-line"></i>
                            <span>Roles</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="{{ route('role') }}">All roles</a>
                            </li>
                            <li>
                                <a href="create-role.html">Create Role</a>
                            </li>
                        </ul>
                    </li>
  
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="media.html">
                            <i class="ri-price-tag-3-line"></i>
                            <span>Media</span>
                        </a>
                    </li>
  
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title" href="javascript:void(0)">
                            <i class="ri-archive-line"></i>
                            <span>Orders</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="{{route('orders')}}">Order List</a>
                            </li>
                            <li>
                                <a href="order-detail.html">Order Detail</a>
                            </li>
                            <li>
                                <a href="order-tracking.html">Order Tracking</a>
                            </li>
                        </ul>
                    </li>
  
                    <li class="sidebar-list">
                        <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
                            <i class="ri-focus-3-line"></i>
                            <span>Localization</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="translation.html">Translation</a>
                            </li>
  
                            <li>
                                <a href="currency-rates.html">Currency Rates</a>
                            </li>
                        </ul>
                    </li>
  
                    <li class="sidebar-list">
                        <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
                            <i class="ri-price-tag-3-line"></i>
                            <span>Coupons</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="{{route('coupons.index')}}">Coupon List</a>
                            </li>
  
                            <li>
                                <a href="{{route('coupons.create')}}">Create Coupon</a>
                            </li>
                        </ul>
                    </li>
  
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="taxes.html">
                            <i class="ri-price-tag-3-line"></i>
                            <span>Tax</span>
                        </a>
                    </li>
  
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="product-review.html">
                            <i class="ri-star-line"></i>
                            <span>Product Review</span>
                        </a>
                    </li>
  
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="support-ticket.html">
                            <i class="ri-phone-line"></i>
                            <span>Support Ticket</span>
                        </a>
                    </li>
  
                    <li class="sidebar-list">
                        <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
                            <i class="ri-settings-line"></i>
                            <span>Settings</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="profile-setting.html">Profile Setting</a>
                            </li>
                        </ul>
                    </li>
  
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="reports.html">
                            <i class="ri-file-chart-line"></i>
                            <span>Reports</span>
                        </a>
                    </li>
  
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="list-page.html">
                            <i class="ri-list-check"></i>
                            <span>List Page</span>
                        </a>
                    </li>
                </ul>
            </div>
  
            <div class="right-arrow" id="right-arrow">
                <i data-feather="arrow-right"></i>
            </div>
        </nav>
    </div>
  </div>