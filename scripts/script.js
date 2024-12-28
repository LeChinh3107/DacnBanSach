let slideIndex = 0;
showSlides(slideIndex);

function changeSlide(n) {
    showSlides(slideIndex += n);
}

function showSlides(n) {
    const slides = document.querySelectorAll('.slide');

    // Xoay vòng slide
    if (n >= slides.length) slideIndex = 0;
    if (n < 0) slideIndex = slides.length - 1;

    // Ẩn tất cả các slide
    slides.forEach(slide => slide.style.display = 'none');

    // Hiển thị slide hiện tại
    slides[slideIndex].style.display = 'block';
}

