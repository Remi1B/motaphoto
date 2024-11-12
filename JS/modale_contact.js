document.addEventListener("DOMContentLoaded", function() {
    const menuLinks = document.querySelectorAll("a");
    menuLinks.forEach(function(link) {
      if (link.textContent.trim() === "Contact") {
        link.classList.add("modale-button");
    }
});
    const modal = document.getElementById('myModal');
    const span = document.getElementsByClassName("close")[0];
    const contactButtons = document.querySelectorAll(".modale-button");
    contactButtons.forEach(function(button) {
      button.addEventListener("click", function(event) {
        event.preventDefault();
        modal.style.display = "block";
      });
    });

    span.addEventListener("click", function() {
      modal.style.display = "none";
    });

    window.addEventListener("click", function(event) {
      if (event.target === modal) {
        modal.style.display = "none";
      }
    });
  });