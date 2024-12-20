<!-- Store Icon with Tooltip -->
<span
    class="store-icon"
    data-bs-toggle="tooltip"
    data-bs-placement="bottom"
    title="E-Commerce">
    <i class="fas fa-store"></i> <!-- Icon representing store -->
</span>

<!-- Flex container for header icons -->
<div class="d-flex align-items-center">

    <!-- Cart Icon -->
    <a
        href="#"
        class="header-icon header-cart-icon d-flex align-items-center me-3"
        data-bs-toggle="tooltip"
        data-bs-placement="bottom"
        title="Cart">
        <i class="fas fa-shopping-cart" style="font-size: 1.6rem;"></i> <!-- Cart icon -->
    </a>

    <!-- Watchlist Icon -->
    <a
        href="#"
        class="header-icon header-watchlist-icon d-flex align-items-center me-3"
        data-bs-toggle="tooltip"
        data-bs-placement="bottom"
        title="Watchlist">
        <i class="fas fa-eye" style="font-size: 1.6rem;"></i> <!-- Watchlist icon -->
    </a>

    <!-- Profile Icon and Dropdown Menu -->
    <div class="dropdown d-inline">
        <a
            href="#"
            class="header-icon header-profile-icon d-flex align-items-center"
            id="dropdownContact"
            data-bs-toggle="dropdown"
            aria-expanded="false"
            title="Profile">
            <img
                src="https://www.gravatar.com/avatar/?d=mp&s=30"
                alt="Profile"
                class="profile-img"
                width="40"
                height="40"> <!-- Profile image -->
        </a>

        <!-- Dropdown menu for profile actions -->
        <ul class="dropdown-menu" aria-labelledby="dropdownContact">
            <li><a class="dropdown-item" href="#">Email Us</a></li> <!-- Contact Email -->
            <li><a class="dropdown-item" href="#">Support</a></li> <!-- Support link -->
            <!-- Logout Form -->
            <li>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="dropdown-item" style="border: none; background: none;">
                        Logout
                    </button>
                </form>
            </li>

        </ul>
    </div>
</div>