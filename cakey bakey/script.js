const searchIcon = document.querySelector(".search-icon");
const searchForm = document.querySelector(".search-form");

searchIcon.addEventListener("click", () => {
    searchForm.classList.add("active");
    cartItemContainer.classList.remove("active");
    profileForm.classList.remove("active"); // Hide profile form when search icon is clicked
});

const cartIcon = document.querySelector(".cart-icon");
const cartItemContainer = document.querySelector(".cart-items-container");

cartIcon.addEventListener("click", () => {
    cartItemContainer.classList.add("active");
    searchForm.classList.remove("active");
    profileForm.classList.remove("active"); // Hide profile form when cart icon is clicked
});





const profileIcon = document.querySelector(".profile");
const profileForm = document.querySelector(".profile-form");

profileIcon.addEventListener("click", () => {
    profileForm.classList.toggle("active"); // Toggle visibility of profile form
    searchForm.classList.remove("active"); // Hide search form when profile icon is clicked
    cartItemContainer.classList.remove("active"); // Hide cart items when profile icon is clicked
});
console.log("Profile icon:", profileIcon);
console.log("Profile form:", profileForm);


// JavaScript code to adjust the position of the cart items container

// Function to adjust the position of the cart items container
function adjustCartPosition() {
    const cartContainer = document.querySelector('.header .cart-items-container');
    const windowHeight = window.innerHeight;
    const containerHeight = cartContainer.scrollHeight;
    const cartButtonHeight = document.querySelector('.header .cart-button').offsetHeight; // Adjust selector according to your HTML structure

    // Check if container height exceeds the window height
    if (containerHeight > windowHeight - cartButtonHeight) {
        cartContainer.style.top = 'auto';
        cartContainer.style.bottom = cartButtonHeight + 'px';
    } else {
        cartContainer.style.top = '100%';
        cartContainer.style.bottom = 'auto';
    }
}

// Call the adjustCartPosition function when the window is resized
window.addEventListener('resize', adjustCartPosition);

// Call the adjustCartPosition function initially
adjustCartPosition();
