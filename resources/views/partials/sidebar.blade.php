<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">Amirul Products</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Home</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('transactions.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-file"></i>
                        <p>Transaction History</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('products.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-cube"></i>
                        <p>Product</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('wallet.deposit_withdrawal') }}" class="nav-link">
                        <i class="nav-icon fas fa-wallet"></i>
                        <p>Deposit Wallet</p>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a href="{{ route('wallet.withdrawal') }}" class="nav-link">
                        <i class="nav-icon fas fa-coins"></i>
                        <p>Withdrawal Wallet</p>
                    </a>
                </li> --}}



                @if(auth()->check())
                    @if(auth()->user()->role == 'admin')
                    <li class="nav-item">
                        <a href="{{ route('account-permission.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Account Permission</p>
                        </a>
                    </li>
                    @endif
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
