

<div class="vertical-menu">

<div data-simplebar class="h-100">

    <!--- Sidemenu -->
    <div id="sidebar-menu">
        <!-- Left Menu Start -->
        <ul class="metismenu list-unstyled" id="side-menu">
            <li class="menu-title" key="t-menu">Menu</li>
            <li>
                <a href="{{url('admin/dashboard')}}" class="waves-effect">
                    <i class="bx bx-home-circle"></i>
                    <span key="t-chat">Dashboard</span>
                </a>
            </li>

            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="bx bx-layout"></i>
                    <span key="t-layouts">Category</span>
                </a>
                <ul class="sub-menu" aria-expanded="true">
                    <li>
                        <li><a href="{{route('admin.category.create')}}" key="t-light-sidebar">Add Category</a></li>
                        <li><a href="{{route('admin.category.index')}}" key="t-compact-sidebar">Manage Category</a></li>
                </ul>
            </li>
            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="bx bx-layout"></i>
                    <span key="t-layouts">Role and Permissions</span>
                </a>
                <ul class="sub-menu" aria-expanded="true">
                    <li>
                        <li><a href="{{route('roleIndex')}}" key="t-light-sidebar">Roles</a></li>
                        <li><a href="{{route('permissionIndex')}}" key="t-compact-sidebar">Permissions</a></li>

                </ul>
            </li>

        </ul>
    </div>
    <!-- Sidebar -->
</div>
</div>
