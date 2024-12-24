let Toast = Swal.mixin({
  toast: true,
  position: "top-end",
  showConfirmButton: false,
  timer: 3000,
});

// Preview image

function handleImageChange(input) {
  const file = input.files[0];
  $("#imageclick").hide();
  if (file) {
    const reader = new FileReader();
    let previewImage = $("#previewImage");
    previewImage.removeClass("d-none");
    reader.onload = (e) => previewImage.attr("src", e.target.result).show();
    reader.readAsDataURL(file);
  }
}


// Date time picker
function globalDateTimePicker(dateTimePicker) {
  $(dateTimePicker).datetimepicker({
    icons: { time: "far fa-clock" },
    format: "DD/MM/YYYY HH:mm",
    useCurrent: false,
  });

  $(dateTimePicker).keydown((e) => e.preventDefault());
}

// Copy to clipboard(input type)
window.copyToClipboard = function (elementId, message) {
  navigator.clipboard.writeText($(`#${elementId}`).val());
  toastr.success(message);
};

function debounce(func, delay) {
  let timerId;
  return function (...args) {
    clearTimeout(timerId);
    timerId = setTimeout(() => {
      func.apply(this, args);
    }, delay);
  };
}

hideOverlay = () => $(".overlay").hide();

function compatitionPoin(resultCompetiiton) {
  if (!resultCompetiiton) {
    return;
  }
  Swal.fire({
    title: `${userResultContent.title}`,
    html: `
            <p>${userResultContent.question}: <strong>${resultCompetition.totalWasAnswer} / ${resultCompetition.totalQuestions}</strong></p>
            <p>${userResultContent.time}: <strong>${resultCompetition.completion_time}</strong></p>
            <p>${userResultContent.poin}: <strong>${resultCompetition.score}</strong></p>
        `,
    confirmButtonText: "OK",
  });
}

function sweetCompetitionError(message, routeHome = "") {
    Swal.fire({
        title: `${message}`,
        icon: "error"
    }).then(result => {
        if (result.isConfirmed) {
            if (routeHome) {
                window.location.replace(routeHome);
            }
        }
    });
}

// Note: fix layout screen when zoom in and then zoom out to original size
$(document).ready(function() {
    const widthDefault = window.innerWidth;
    $(window).resize(function() {
        if (window.innerWidth == widthDefault) {
            $('.content-wrapper').css('min-height', 'auto');
        }
    })
})

function stopInputDate(event) {
  event.preventDefault();
}