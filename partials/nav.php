<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
        <a href="dashboard" class="navbar-brand">
            <span class="brand-text font-weight-light">eReservation</span>
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="dashboard" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="rooms" class="nav-link">Rooms</a>
                </li>
                <li class="nav-item">
                    <a href="reservations" class="nav-link">Reservations</a>
                </li>
                <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Reports</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                        <li><a href="reports_reservations" class="dropdown-item">Reservations </a></li>
                        <li><a href="reports_card_payments" class="dropdown-item">Card Payments</a></li>
                        <li><a href="reports_mpesa_payments" class="dropdown-item">Mpesa Payments</a></li>
                    </ul>
                </li>
            </ul>

        </div>

        <!-- Right navbar links -->
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="logout"><i class="fas fa-power-off"></i></a>
            </li>
        </ul>
    </div>
</nav>