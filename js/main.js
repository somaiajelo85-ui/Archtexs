
document.addEventListener('DOMContentLoaded', () => {
    // Highlight active link in the navigation
    const currentLocation = location.href;
    const menuItems = document.querySelectorAll('.nav-links a');
    
    menuItems.forEach(item => {
        if (item.href === currentLocation) {
            item.classList.add("active");
        }
    });
});
