document.addEventListener("DOMContentLoaded", function () {
  const modal = document.querySelector(".modal");
  const contactButtons = document.querySelectorAll(".modale-button");

  // Afficher la modale lorsqu'un bouton est cliqué
  contactButtons.forEach(function (button) {
      button.addEventListener("click", function (event) {
          event.preventDefault();
          modal.classList.add("visible");
      });
  });

  // Fermer la modale en cliquant en dehors de celle-ci
  window.addEventListener("click", function (event) {
      if (event.target === modal) {
          modal.classList.remove("visible");
      }
  });

  // Fermer la modale avec la touche Échap
  window.addEventListener("keydown", function (event) {
      if (event.key === "Escape" || event.key === "Esc") {
          modal.classList.remove("visible");
      }
  });
});