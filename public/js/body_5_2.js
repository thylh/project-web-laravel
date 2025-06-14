window.onload = function() {
  const slider = document.querySelector('.slider_inner');
  let index = 0;

  function slide() {
    index++;
    if (index > 1) index = 0; // max index là 1 (2 trạng thái)

    slider.style.transform = `translateX(-${(430 + 30) * index}px)`;
  }

  slide(); // chạy ngay lần đầu để set đúng vị trí ban đầu
  setInterval(slide, 3000);
}
