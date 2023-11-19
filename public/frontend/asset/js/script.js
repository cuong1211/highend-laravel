window.onscroll = function () { stickyHeader() };
var header = document.getElementById("header");
var sticky = header.offsetTop;
function stickyHeader() {
    if (window.scrollY > sticky) {
        header.classList.add("sticky");
    } else {
        header.classList.remove("sticky");
    }
}
$('.banner').owlCarousel({
    loop: true,
    nav: true,
    autoWidth: true,
    autoplay: true,
    autoplayTimeout: 3000,
    autoplayHoverPause: true,
    navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
})
$('.flash-sale_product').owlCarousel({
    loop: true,
    nav: true,
    dots: false,
    items: 6,
    autoplay: true,
    autoplayTimeout: 3000,
    autoplayHoverPause: true,
    navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
})
$('.product-slide').owlCarousel({
    loop: true,
    nav: true,
    dots: false,
    items: 4,
    autoplay: true,
    autoplayTimeout: 3000,
    autoplayHoverPause: true,
    navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
})