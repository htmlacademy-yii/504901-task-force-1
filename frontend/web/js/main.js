
function handleFormSubmit(event) {
    // Просим форму не отправлять данные самостоятельно
    event.preventDefault()
    $.ajax({
        url: "landing/login",
        type: "POST",
        data: "email=" + $("#loginform-email").val() + "&password=" + $("#loginform-password").val(),
        success: function (answer) {
            alert("ok");
        }
    });
}
// const applicantForm = document.getElementById('login-form-submit')
// applicantForm.addEventListener('click', handleFormSubmit)
// var openModalLinks = document.getElementsByClassName("open-modal");
// var closeModalLinks = document.getElementsByClassName("form-modal-close");
// var overlay = document.getElementsByClassName("overlay")[0];

// for (var i = 0; i < openModalLinks.length; i++) {
//   var modalLink = openModalLinks[i];

//   modalLink.addEventListener("click", function (event) {
//     var modalId = event.currentTarget.getAttribute("data-for");

// var modal = document.getElementById('login-modal');
// modal.setAttribute("style", "display: block");
//overlay.setAttribute("style", "display: block");
// $.ajax({
//   url:"landing/ajaxLogin",
//   type:"POST",
//   //data:"login_user="+$("#loginform-login_user").val()+"&password_user="+$("#loginform-password_user").val(),
//   success:function(answer){
//     alert(answer);
//   }
// });

//   });
// }

// function closeModal(event) {
//   var modal = event.currentTarget.parentElement;

//   modal.removeAttribute("style");
//   overlay.removeAttribute("style");
// }

// for (var j = 0; j < closeModalLinks.length; j++) {
//   var closeModalLink = closeModalLinks[j];

//   closeModalLink.addEventListener("click", closeModal)
// }

// document.getElementById('close-modal').addEventListener("click", closeModal);

// var starRating = document.getElementsByClassName("completion-form-star");

// if (starRating.length) {
//   starRating = starRating[0];

//   starRating.addEventListener("click", function(event) {
//     var stars = event.currentTarget.childNodes;
//     var rating = 0;

//     for (var i = 0; i < stars.length; i++) {
//       var element = stars[i];

//       if (element.nodeName === "SPAN") {
//         element.className = "";
//         rating++;
//       }

//       if (element === event.target) {
//         break;
//       }
//     }

//     var inputField = document.getElementById("rating");
//     inputField.value = rating;
//   });
// }
