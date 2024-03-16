


document.write('<style>.custom-toast {\
    background-color: #fff; /* Background color */\
    color: #333; /* Text color */\
    border: 2px solid #ccc; /* Border */\
    border-radius: 8px; /* Border radius */\
    padding: 16px; /* Padding */\
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); /* Box shadow */\
}</style>');


document.addEventListener('DOMContentLoaded', function() {
    var newElement = document.createElement('div');
    newElement.innerHTML = '<div class="toast-container position-fixed bottom-0 end-0 p-4">\
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">\
          <div class="toast-header">\
            <svg class="bd-placeholder-img rounded me-2" width="20" height="20"\
              xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice"\
              focusable="false">\
              <rect width="100%" height="100%" fill="#007aff"></rect>\
            </svg>\
            <strong class="me-auto">Bootstrap</strong>\
            <small>11 mins ago</small>\
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>\
          </div>\
          <div class="toast-body">\
            Hello, world! This is a\
            toast message.\
          </div>\
        </div>\
        </div>';
    document.body.appendChild(newElement);
});




function Alert(title="", message="", type=""){
    Swal.fire({
        title: title,
        text: message,
        icon: type === 'success' ? "success" : "error",
        confirmButtonText: "Ok",
    });
}


function AlertReload(title="", message="", type=""){
    Swal.fire({
        title: title,
        text: message,
        icon: type === 'success' ? "success" : "error",
        confirmButtonText: "Ok",
    }).then((result) => {
        if (result.isConfirmed) {
            location.reload(); 
        }
    });
}

$(document).ready(function() {
    // Alert('Testing', 'hello sir', 'error');
    // AlertReload('Testing', 'hello sir', 'error');
    Toastify({
        text: "This is a toast",
        className: "custom-toast",
        style: {
            // You can customize the style here
        },
        duration: 3000, // Display duration in milliseconds
        newWindow: true, // Open in a new window/tab
        close: true, // Show close button
        gravity: "top", // toast position
        position: "right", // toast position
        stopOnFocus: true, // Prevents dismissing toast on hover/focus
        offset: {
            x: 20, // Horizontal offset
            y: 20, // Vertical offset
        },
    }).showToast();

    const toastTrigger = document.getElementById("liveToastBtn");
    const toastLiveExample = document.getElementById("liveToast");

    const toast = new bootstrap.Toast(toastLiveExample);

    toast.show();

});


