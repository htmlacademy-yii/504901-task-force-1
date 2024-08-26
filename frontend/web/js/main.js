function getErrors() {
    const errors = document.querySelectorAll('.invalid-feedback')
    const itemError = document.querySelector('#item-error')
    itemError.innerHTML = "";
    for (let error of errors) {
      if (error.innerText) {
        itemError.innerText += error.innerText + "\n"
      }; 
    }
}
