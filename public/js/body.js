document.addEventListener('DOMContentLoaded', () => {
  const images = document.querySelectorAll('.body_1 img.logo');
  let currentIndex = 0;
  const totalImages = images.length;
  const delay = 5000; // 5 giây

  // Xếp ảnh theo thứ tự ngang
  images.forEach((img, index) => {
    img.style.transform = `translateX(${index * 100}%)`;
  });

  function showNextImage() {
    currentIndex = (currentIndex + 1) % totalImages;
    images.forEach((img, index) => {
      img.style.transform = `translateX(${(index - currentIndex) * 100}%)`;
    });
  }

  setInterval(showNextImage, delay);
});
