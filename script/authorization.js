pwShowHide = document.querySelectorAll(".pw_hide");

pwShowHide.forEach((icon) => {
  icon.addEventListener("click", () => {
    let getPwInput = icon.parentElement.querySelector("input")
    if (getPwInput.type === "password") {
      getPwInput.type = "text";
      icon.classList.replace("pw_hide", "pw_visible")
    }
    else {
      getPwInput.type = "password";
      icon.classList.replace("pw_visible", "pw_hide")
    }
  });
});