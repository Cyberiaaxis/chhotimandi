document.addEventListener('DOMContentLoaded', function () {
    // Ensure the first active link is set correctly when the DOM is ready
    const defaultLink = document.querySelector('#sidebar .nav-link.active');
    if (defaultLink) {
        toggleActiveLink({ currentTarget: defaultLink });
    }

    // Attach the click event listener for all sidebar links
    const navLinks = document.querySelectorAll('#sidebar .nav-link');
    navLinks.forEach(link => {
        link.addEventListener('click', toggleActiveLink);
    });
});

// Function to toggle the "active" class on the clicked sidebar link
function toggleActiveLink(event) {
    // Remove "active" class from all sidebar links
    const links = document.querySelectorAll('#sidebar .nav-link');
    links.forEach(link => link.classList.remove('active'));

    // Add "active" class to the clicked link
    event.currentTarget.classList.add('active');
}

// Function to check if the sidebar is collapsed
function isSidebarCollapsed() {
    return document.getElementById('sidebar').classList.contains('collapsed');
}

// Function to toggle the sidebar's collapsed state and adjust layout accordingly
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const sidebarIcon = document.querySelector('.sidebar-icon i');
    const submenus = sidebar.querySelectorAll('.collapse');  // Get all submenus (collapsed elements)
    const sidebarToggleContainer = document.getElementById('sidebarToggleContainer');

    // Toggle the "collapsed" class on the sidebar
    sidebar.classList.toggle('collapsed');

    // Adjust the sidebar and its contents depending on the collapsed state
    if (isSidebarCollapsed()) {
        // Change sidebar icon to "bars" and adjust the layout
        sidebarIcon.classList.remove('fa-times');
        sidebarIcon.classList.add('fa-bars');
        sidebarToggleContainer.classList.remove('justify-content-end');
        sidebarToggleContainer.classList.add('justify-content-center');

        // Hide all submenus (collapse them)
        submenus.forEach(submenu => submenu.classList.remove('show'));
    } else {
        // Change sidebar icon to "times" and restore layout
        sidebarIcon.classList.remove('fa-bars');
        sidebarIcon.classList.add('fa-times');
        sidebarToggleContainer.classList.remove('justify-content-center');
        sidebarToggleContainer.classList.add('justify-content-end');
    }

    // If window width is less than 768px, toggle the sidebar visibility for mobile
    if (window.innerWidth < 768) {
        sidebar.classList.toggle('show');
    }
}
