<header>
    <b-navbar :sticky="true" class="py-4" toggleable="lg" type="dark" variant="secondary">
        <div class="container-fluid">
            <b-navbar-brand href="#">Bulveyz Market</b-navbar-brand>

            <b-navbar-toggle target="nav_collapse"></b-navbar-toggle>

            <b-collapse is-nav id="nav_collapse">

                <!-- Center Aligned Nav Items -->
                <b-navbar-nav class="ml-auto">
                    <b-nav-item href="/">Home</b-nav-item>
                    <b-nav-item href="/product">All Products</b-nav-item>
                    <b-nav-item href="/cart">Cart</b-nav-item>
                    <b-nav-item href="/contacts">Contacts</b-nav-item>
                </b-navbar-nav>

                <!-- Right Aligned Nav Items -->
            @if (Auth::check())
                <!-- If Auth -->
                    <b-navbar-nav class="ml-auto">

                        <!-- Cart Menu -->
                        <cart-menu></cart-menu>

                        <!-- Profile Menu -->
                        <b-nav-item-dropdown right>
                            <template slot="text">
                                {{auth()->user()->name}}
                                <i class="fa fa-angle-down"></i>
                            </template>
                            <b-dropdown-item href="/profile">Profile</b-dropdown-item>
                            <b-dropdown-item href="/settings">Settings</b-dropdown-item>
                            <b-dropdown-item href="/help">Help</b-dropdown-item>
                            <b-dropdown-item href="/logout">LogOut</b-dropdown-item>
                        </b-nav-item-dropdown>
                        <!-- End Profile Menu -->

                    </b-navbar-nav>
            @else
                <!-- If Unauth -->
                    <b-navbar-nav class="ml-auto">
                        <b-nav-item href="/login">Login</b-nav-item>
                        <b-nav-item href="/register">SignUp</b-nav-item>
                    </b-navbar-nav>
                @endif

            </b-collapse>
        </div>
    </b-navbar>
</header>