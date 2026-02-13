/**
 * Nominees Year Menu Handler
 */
(function () {
  "use strict";

  document.addEventListener("DOMContentLoaded", function () {
    const yearButtons = document.querySelectorAll(".year-menu__list-item");
    const nomineesContainer = document.querySelector(".nominees-container");
    const nomineesSection = document.querySelector("#nominendid");
    const galleryLink = document.querySelector("#nominees-gallery-link");

    if (!yearButtons.length || !nomineesContainer) {
      return;
    }

    yearButtons.forEach(function (button) {
      button.addEventListener("click", function () {
        const yearId = this.getAttribute("data-year-id");

        // Don't reload if clicking the already active year
        if (this.classList.contains("year-menu__list-item--active")) {
          return;
        }

        // Show loading state
        nomineesContainer.style.opacity = "0.5";
        nomineesContainer.style.pointerEvents = "none";

        // Make AJAX request
        fetch(emeaAjax.ajaxurl, {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded",
          },
          body: new URLSearchParams({
            action: "load_nominees_by_year",
            year_id: yearId,
            nonce: emeaAjax.nonce,
          }),
        })
          .then((response) => response.json())
          .then((data) => {
            if (data.success) {
              // Update the nominees container
              nomineesContainer.innerHTML = data.data.html;

              // Update active state on buttons
              yearButtons.forEach((btn) => {
                btn.classList.remove("year-menu__list-item--active");
                btn.removeAttribute("aria-current");
              });
              button.classList.add("year-menu__list-item--active");
              button.setAttribute("aria-current", "true");

              // Update gallery link
              if (galleryLink) {
                const newGalleryLink = button.getAttribute("data-gallery-link");
                if (newGalleryLink) {
                  galleryLink.href = newGalleryLink;
                  galleryLink.style.display = "";
                } else {
                  galleryLink.style.display = "none";
                }
              }

              // Restore container state
              nomineesContainer.style.opacity = "1";
              nomineesContainer.style.pointerEvents = "auto";

              // Smooth scroll to the nominees section (or container if section not found)
              const scrollTarget = nomineesSection || nomineesContainer;
              scrollTarget.scrollIntoView({
                behavior: "smooth",
                block: "start",
              });
            } else {
              console.error("Error loading nominees:", data.data);
              alert("Error loading nominees. Please try again.");
              nomineesContainer.style.opacity = "1";
              nomineesContainer.style.pointerEvents = "auto";
            }
          })
          .catch((error) => {
            console.error("Error:", error);
            alert("Error loading nominees. Please try again.");
            nomineesContainer.style.opacity = "1";
            nomineesContainer.style.pointerEvents = "auto";
          });
      });
    });
  });
})();
