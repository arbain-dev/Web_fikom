document.addEventListener('DOMContentLoaded', function() {
    const hamburger = document.getElementById('hamburger');
    const sidebar   = document.getElementById('sidebar');
    const body      = document.body;

    if (hamburger && sidebar) {
        hamburger.addEventListener('click', function(e) {
            e.stopPropagation();
            sidebar.classList.toggle('active');
            body.classList.toggle('sidebar-open');
        });
        document.addEventListener('click', function(e) {
            if (window.innerWidth <= 992) {
                if (!sidebar.contains(e.target) && !hamburger.contains(e.target)) {
                    sidebar.classList.remove('active');
                    body.classList.remove('sidebar-open');
                }
            }
        });
        sidebar.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    }
    document.querySelectorAll('.has-submenu > a').forEach(function(menuLink) {
        menuLink.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const parentLi = this.parentElement;
            const isOpen = parentLi.classList.contains('open');
            document.querySelectorAll('.has-submenu.open').forEach(function(li) {
                if (li !== parentLi) {
                    li.classList.remove('open');
                }
            });
            if (isOpen) {
                parentLi.classList.remove('open');
            } else {
                parentLi.classList.add('open');
            }
        });
    });

    document.querySelectorAll('.submenu li a').forEach(function(link) {
        link.addEventListener('click', function() {
            if (window.innerWidth > 992) {
                const parentLi = this.closest('.has-submenu');
                if (parentLi) {
                    parentLi.classList.remove('open');
                }
            } else {
                setTimeout(function() {
                    sidebar.classList.remove('active');
                    body.classList.remove('sidebar-open');
                }, 200);
            }
        });
    });
    let resizeTimer;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            if (window.innerWidth > 992) {
                sidebar.classList.remove('active');
                body.classList.remove('sidebar-open');
            }
        }, 250);
    });

    console.log('✓ Sidebar JS loaded successfully');
});