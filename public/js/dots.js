window.onload = function() {
  const slider = document.querySelector('.slider_inner');
  const dots = document.querySelectorAll('.dot');
  let index = 0;

  function updateDots() {
    dots.forEach(dot => dot.classList.remove('active'));
    dots[index].classList.add('active');
  }

  function slide() {
    index++;
    if (index > 1) index = 0; // quay lại dot 0 (bên trái)

    slider.style.transform = `translateX(-${(430 + 30) * index}px)`;
    updateDots();
  }

  // Click từng dot để chuyển slide
  dots.forEach(dot => {
    dot.addEventListener('click', () => {
      index = parseInt(dot.dataset.index);
      slider.style.transform = `translateX(-${(430 + 30) * index}px)`;
      updateDots();
    });
  });

  updateDots();
  slide(); // chạy lần đầu set đúng vị trí
  setInterval(slide, 3000);
}
