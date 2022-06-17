<ul style="border:1px solid #ddd;padding:10px 6px;">
    <li class="{{\Request::is('user/dashboard')? 'active' : ''}}"><a style="padding: 10px;color:black;" href="{{route('user.dashboard')}}">Dashboard</a></li>
    <li class="{{\Request::is('user/order')? 'active' : ''}}"><a style="padding: 10px;color:black;" href="{{route('user.order')}}">Orders</a></li>
    <li class="{{\Request::is('user/address')? 'active' : ''}}"><a style="padding: 10px;color:black;" href="{{route('user.address')}}">Address</a></li>
    <li class="{{\Request::is('user/account-detail')? 'active' : ''}}"><a style="padding: 10px;color:black;" href="{{route('user.account')}}">Account Details</a></li>
    <li><a style="padding: 10px;color:black;" href="{{route('user.logout')}}">Logout</a></li>
</ul>
