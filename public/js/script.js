// script.js
console.log('File script.js berhasil dimuat!');

// Fungsi untuk mengontrol toggle menu
const menuToggle = document.getElementById('menu-toggle');
const mobileMenu = document.getElementById('mobile-menu');

if (menuToggle && mobileMenu) {
    menuToggle.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });
}




// document.querySelectorAll('[data-hs-overlay]').forEach(button => {
//     button.addEventListener('click', function () {
//         const modalId = this.getAttribute('data-hs-overlay');
//         const modal = document.querySelector(modalId);

//         if (modal) {
//             modal.classList.toggle('hidden');
//             modal.classList.toggle('hs-overlay-open');
//         }
//     });
// });