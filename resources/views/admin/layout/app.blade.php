<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional Dark Dashboard</title>
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" xintegrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+pfYnFfW3l/ux+WfM1Qx0sC2v5Jc/V/0z0t/0j0A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

</head>
<body>
    @include('admin.layout.header')

    <div class="d-flex">
        @include('admin.layout.sidebar')
        <main class="app-main flex-grow-1">
            <div class="layout-container">
                @yield('content')
            </div>
        </main>
    </div>


    @include('admin.layout.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.querySelector('.sidebar-toggle');
            const body = document.body;
            const appMain = document.querySelector('.app-main');
            const appFooter = document.querySelector('.app-footer');
            const appHeader = document.querySelector('.app-header');

            // Function to toggle sidebar state
            function toggleSidebar() {
                // Toggle the 'sidebar-open' class on the body.
                // On larger screens (>= 992px), 'sidebar-closed' will hide it
                // On smaller screens (< 992px), 'sidebar-open' will show it
                if (window.innerWidth < 992) {
                    body.classList.toggle('sidebar-open');
                    // Add/remove overlay for smaller screens
                    if (body.classList.contains('sidebar-open')) {
                        const overlay = document.createElement('div');
                        overlay.id = 'sidebar-overlay';
                        overlay.style.cssText = `
                            position: fixed;
                            top: 0;
                            left: 0;
                            right: 0;
                            bottom: 0;
                            background-color: rgba(0, 0, 0, 0.5);
                            z-index: 1005;
                            cursor: pointer;
                        `;
                        document.body.appendChild(overlay);
                        overlay.addEventListener('click', toggleSidebar); // Close sidebar when overlay clicked
                    } else {
                        const overlay = document.getElementById('sidebar-overlay');
                        if (overlay) overlay.remove();
                    }
                } else {
                    body.classList.toggle('sidebar-closed');
                }
            }

            // Event listener for sidebar toggle button
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', toggleSidebar);
            }

            // Close sidebar when clicking outside on small screens (if overlay is not used)
            // Or handle clicks on the overlay if it exists
            // Since we're adding an overlay, this specific event listener might not be needed
            // if the overlay handles closing.
            // document.addEventListener('click', function(event) {
            //     const sidebar = document.querySelector('.app-sidebar');
            //     if (window.innerWidth < 992 && body.classList.contains('sidebar-open') &&
            //         !sidebar.contains(event.target) && !sidebarToggle.contains(event.target)) {
            //         toggleSidebar(); // Close sidebar if click outside sidebar and toggle button
            //     }
            // });


            // Handle window resize to adjust sidebar state
            let resizeTimeout;
            window.addEventListener('resize', function() {
                clearTimeout(resizeTimeout);
                resizeTimeout = setTimeout(() => {
                    const overlay = document.getElementById('sidebar-overlay');
                    if (window.innerWidth >= 992) {
                        // On large screens, ensure sidebar is open and no overlay
                        body.classList.remove('sidebar-closed');
                        body.classList.remove('sidebar-open');
                        if (overlay) overlay.remove();
                    } else {
                        // On small screens, ensure sidebar is initially closed unless toggled open
                        // And remove overlay if window resized to smaller and sidebar isn't explicitly open
                        if (!body.classList.contains('sidebar-open')) {
                             body.classList.add('sidebar-closed'); // Ensure it's closed by default
                             if (overlay) overlay.remove(); // Remove overlay if it exists when not sidebar-open
                        }
                    }
                }, 100); // Debounce resize event
            });

            // Initial setup based on screen size
            if (window.innerWidth < 992) {
                body.classList.add('sidebar-closed'); // Hide sidebar by default on small screens
            } else {
                body.classList.remove('sidebar-closed'); // Show sidebar by default on large screens
            }

            // Add active class to clicked menu item (existing logic)
            document.querySelectorAll('.sidebar-menu li').forEach(item => {
                item.addEventListener('click', function() {
                    document.querySelectorAll('.sidebar-menu li').forEach(i => i.classList.remove('active'));
                    this.classList.add('active');
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
    // Handle AJAX navigation
    $(document).on('click', '.ajax-link', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        
        // Show loading indicator if needed
        $('#main-content-container').html('<div class="text-center py-5">Loading...</div>');
        
        // Make AJAX request
        $.ajax({
            url: url,
            type: 'GET',
            success: function(response) {
                // Update main content
                $('#main-content-container').html(response);
                
                // Update URL in browser without reload
                history.pushState(null, null, url);
                
                // Update active class in sidebar
                $('.sidebar-menu li').removeClass('active');
                $(e.target).closest('li').addClass('active');
            },
            error: function(xhr) {
                $('#main-content-container').html('<div class="alert alert-danger">Error loading page</div>');
            }
        });
    });
    
    // Handle browser back/forward buttons
    $(window).on('popstate', function() {
        $.ajax({
            url: location.pathname,
            type: 'GET',
            success: function(response) {
                $('#main-content-container').html(response);
                updateActiveNavItem();
            }
        });
    });
    
    // Function to update active nav item based on current URL
    function updateActiveNavItem() {
        $('.sidebar-menu li').removeClass('active');
        $('.sidebar-menu a[href="' + location.pathname + '"]').closest('li').addClass('active');
    }
});
    </script>
    @yield('scripts') {{-- This will be for page-specific scripts --}}
</body>
</html>
