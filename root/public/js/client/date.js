document.addEventListener("DOMContentLoaded", function () {
  flatpickr("#check_in_date", {
    minDate: "today", // Ngày chọn không nhỏ hơn hôm nay
    dateFormat: "Y-m-d", // Định dạng ngày (YYYY-MM-DD)
    onChange: function (selectedDates, dateStr, instance) {
      // Cập nhật giá trị cho ngày trả phòng nếu ngày nhận phòng thay đổi
      let checkOutDateInput = document.getElementById("check_out_date");
      if (
        checkOutDateInput.value &&
        new Date(dateStr) >= new Date(checkOutDateInput.value)
      ) {
        checkOutDateInput.value = ""; // Nếu ngày nhận phòng lớn hơn hoặc bằng ngày trả phòng, xóa giá trị ngày trả phòng
      }
    },
  });

  flatpickr("#check_out_date", {
    minDate: "today", // Ngày chọn không nhỏ hơn hôm nay
    locale: "vi", // Sử dụng tiếng Việt

    dateFormat: "Y-m-d", // Định dạng ngày (YYYY-MM-DD)
    onChange: function (selectedDates, dateStr, instance) {
      // Cập nhật giá trị cho ngày nhận phòng nếu ngày trả phòng thay đổi
      let checkInDateInput = document.getElementById("check_in_date");
      if (
        checkInDateInput.value &&
        new Date(dateStr) <= new Date(checkInDateInput.value)
      ) {
        checkInDateInput.value = ""; // Nếu ngày trả phòng nhỏ hơn hoặc bằng ngày nhận phòng, xóa giá trị ngày nhận phòng
      }
    },
  });
});
