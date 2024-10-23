// DOM Elements
const hamburgerMenu = document.getElementById('hamburger-menu');
const navLinks = document.getElementById('nav-links');
const darkModeToggle = document.getElementById('dark-mode-toggle');
const body = document.body;
const popup = document.getElementById('popup');
const openPopupButton = document.getElementById('open-popup');
const closePopupButton = document.querySelector('.popup .close');
const inventoryTable = document.getElementById('inventory-table');

// Sample inventory data
const inventoryData = [
    { name: 'Beras', stock: 1000, unit: 'kg' },
    { name: 'Gula Pasir', stock: 500, unit: 'kg' },
    { name: 'Minyak Goreng', stock: 750, unit: 'liter' },
    { name: 'Telur', stock: 5000, unit: 'butir' },
    { name: 'Tepung Terigu', stock: 300, unit: 'kg' },
    { name: 'Kopi', stock: 100, unit: 'kg' },
    { name: 'Susu Bubuk', stock: 200, unit: 'kg' },
    { name: 'Garam', stock: 150, unit: 'kg' },
];

// Toggle mobile menu
hamburgerMenu.addEventListener('click', () => {
    navLinks.classList.toggle('active');
});

// Dark mode toggle
darkModeToggle.addEventListener('click', () => {
    body.classList.toggle('dark-mode');
    const icon = darkModeToggle.querySelector('i');
    if (body.classList.contains('dark-mode')) {
        icon.classList.replace('bi-moon', 'bi-sun');
    } else {
        icon.classList.replace('bi-sun', 'bi-moon');
    }
});

// Popup functionality
openPopupButton.addEventListener('click', () => {
    popup.style.display = 'flex';
    populateInventoryTable();
});

closePopupButton.addEventListener('click', () => {
    popup.style.display = 'none';
});

window.addEventListener('click', (event) => {
    if (event.target === popup) {
        popup.style.display = 'flex';
    }
});

// Populate inventory table
function populateInventoryTable() {
    const tableBody = inventoryTable.querySelector('tbody');
    tableBody.innerHTML = '';

    inventoryData.forEach(item => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${item.name}</td>
            <td>${item.stock}</td>
            <td>${item.unit}</td>
        `;
        tableBody.appendChild(row);
    });
}

// Smooth scrolling for navigation links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});


// Newsletter subscription handling
const newsletterForm = document.querySelector('.newsletter-form');
newsletterForm.addEventListener('submit', function(e) {
    e.preventDefault();
    const email = this.querySelector('input[type="email"]').value;
    console.log('Newsletter subscription:', email);
    // Here you would typically send this email to a server
    alert('Terima kasih telah berlangganan newsletter kami!');
    this.reset();
});

// Simple product slider functionality
const productSlider = document.querySelector('.product-slider');
let isDown = false;
let startX;
let scrollLeft;

productSlider.addEventListener('mousedown', (e) => {
    isDown = true;
    startX = e.pageX - productSlider.offsetLeft;
    scrollLeft = productSlider.scrollLeft;
});

productSlider.addEventListener('mouseleave', () => {
    isDown = false;
});

productSlider.addEventListener('mouseup', () => {
    isDown = false;
});

productSlider.addEventListener('mousemove', (e) => {
    if (!isDown) return;
    e.preventDefault();
    const x = e.pageX - productSlider.offsetLeft;
    const walk = (x - startX) * 3;
    productSlider.scrollLeft = scrollLeft - walk;
});

// Intersection Observer for fade-in effect
const fadeElements = document.querySelectorAll('.service-card, .product-card');

const fadeObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('fade-in');
        }
    });
}, {
    threshold: 0.1
});

fadeElements.forEach(element => {
    fadeObserver.observe(element);
});

// Add fade-in class for CSS animation
document.head.insertAdjacentHTML('beforeend', `
    <style>
        .service-card, .product-card {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }
        .fade-in {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
`);