const next = document.querySelector('.next')
const prev = document.querySelector('.prev')
const comment = document.querySelector('#list-comment')
const commentItem = document.querySelectorAll('#list-comment .item')
var translateY = 0
var count = commentItem.length

next.addEventListener('click', function (event) {
  event.preventDefault()
  if (count == 1) {
    // Xem hết bình luận
    return false
  }
  translateY += -400
  comment.style.transform = `translateY(${translateY}px)`
  count--
})

prev.addEventListener('click', function (event) {
  event.preventDefault()
  if (count == 3) {
    // Xem hết bình luận
    return false
  }
  translateY += 400
  comment.style.transform = `translateY(${translateY}px)`
  count++
})

document.getElementById("datSanForm").addEventListener("submit", function (e) {
  const startTime = document.getElementById("gio_bat_dau").value;
  const endTime = document.getElementById("gio_ket_thuc").value;

  if (startTime >= endTime) {
      e.preventDefault();
      alert("Giờ kết thúc phải lớn hơn giờ bắt đầu.");
  }
});
