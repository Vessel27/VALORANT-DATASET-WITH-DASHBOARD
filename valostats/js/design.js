document.addEventListener("DOMContentLoaded", function () {
    // Select all sidebar links
    const sidebarLinks = document.querySelectorAll(".sidebar .nav-link");

    // Get the current page's file name from the URL
    const currentUrl = window.location.pathname.split("/").pop();

    // Iterate through each link and apply the "active" class if the href matches the current URL
    sidebarLinks.forEach(function (link) {
        const linkHref = link.getAttribute("href");

        // Remove "active" from all links to avoid conflicts
        link.classList.remove("active");

        // Add the "active" class if the current URL matches the link's href
        if (linkHref === currentUrl) {
            link.classList.add("active");
        }
    });
});
