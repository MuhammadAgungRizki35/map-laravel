 // Toggle sidebar saat tombol ☰ ditekan
 document.getElementById('toggleSidebar').addEventListener('click', function() {
    let sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('d-none');
});

// Highlight menu sidebar yang sedang aktif
document.addEventListener('DOMContentLoaded', function(){
    const navLinks = document.querySelectorAll("#SidebarMenu .nav-link");
    navLinks.forEach(link => {
        if (link.href === window.location.href) {
            link.classList.add("active", "bg-primary", "text-white");
        }
        link.addEventListener("click", function(){
            navLinks.forEach(nav => nav.classList.remove("active", "bg-primary", "text-white"));
            this.classList.add("active", "bg-primary", "text-white");
        });
    });
});