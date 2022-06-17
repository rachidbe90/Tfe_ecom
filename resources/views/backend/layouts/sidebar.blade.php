<div id="left-sidebar" class="sidebar">
    <div class="sidebar-scroll">
        <div class="user-account">
            <img src="{{ucfirst(auth('admin')->user()->photo)==null ? Helper::userDefaultImage() : ucfirst(auth('admin')->user()->photo)}}" class="rounded-circle user-photo" alt="User Profile Picture">
            <div class="dropdown">
                <span>Welcome,</span>
                <a href="{{route('profile')}}" class="dropdown-toggle user-name"><strong>{{ucfirst(auth('admin')->user()->first_name)}} {{ucfirst(auth('admin')->user()->last_name)}}</strong></a>
            </div>
        </div>
        <nav class="sidebar-nav">
            <ul class="main-menu metismenu">
                <li class="{{request()->is('admin') ? 'active' : ''}}"><a href="{{route('admin')}}"><i class="icon-grid"></i><span>Dashboard</span></a></li>

                <li class="{{request()->is('admin/aboutus') ? 'active' : ''}}"><a href="{{route('about.index')}}"><i class="icon-info"></i><span>About Us Content</span></a></li>

                <li><a href="javascript:void(0);" class="has-arrow"><i class="icon-picture"></i><span>Banner Management</span> </a>
                    <ul>
                        <li><a href="{{route('banner.index')}}">All Banners</a></li>
                        <li><a href="{{route('banner.create')}}">Add Banner</a></li>
                    </ul>
                </li>
                <li><a href="javascript:void(0);" class="has-arrow"><i class="icon-organization"></i><span>Category Management</span> </a>
                    <ul>
                        <li><a href="{{route('category.index')}}">All Category</a></li>
                        <li><a href="{{route('category.create')}}">Add Category</a></li>
                    </ul>
                </li>

                <li><a href="javascript:void(0);" class="has-arrow"><i class="icon-briefcase"></i><span>Products Management</span> </a>
                    <ul>
                        <li><a href="{{route('product.index')}}">All Products</a></li>
                        <li><a href="{{route('product.create')}}">Add Product</a></li>
                    </ul>
                </li>

                <li><a href="javascript:void(0);" class="has-arrow"><i class="icon-briefcase"></i><span>Coupon Management</span> </a>
                    <ul>
                        <li><a href="{{route('coupon.index')}}">All Coupons</a></li>
                        <li><a href="{{route('coupon.create')}}">Add Coupon</a></li>
                    </ul>
                </li>

                <li><a href="javascript:void(0);" class="has-arrow"><i class="fas fa-truck"></i><span>Shipping Management</span> </a>
                    <ul>
                        <li><a href="{{route('shipping.index')}}">All Shippings</a></li>
                        <li><a href="{{route('shipping.create')}}">Add Shipping</a></li>
                    </ul>
                </li>

                <li class="{{request()->is('admin/order') ? 'active' : ''}}"><a href="{{route('order.index')}}"><i class="icon-layers"></i>Order Management</a></li>


                <li><a href="javascript:void(0);" class="has-arrow"><i class="icon-people"></i><span>User Management</span> </a>
                    <ul>
                        <li><a href="{{route('user.index')}}">All Users</a></li>
                        <li><a href="{{route('user.create')}}">Add User</a></li>
                    </ul>
                </li>

                <li><a href="javascript:void(0);" class="has-arrow"><i class="icon icon-settings"></i><span>General Settings</span> </a>
                    <ul>
                        <li><a href="{{route('settings')}}">Settings</a></li>
                        <li><a href="{{route('payment')}}">Payment Settings (PAYPAL)</a></li>
                        <li><a href="{{route('smtp')}}">SMTP Settings</a></li>
                    </ul>
                </li>

            </ul>
        </nav>
    </div>
</div>
