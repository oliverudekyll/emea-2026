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
    const prevArrow = document.querySelector(".year-menu__arrow--prev");
    const nextArrow = document.querySelector(".year-menu__arrow--next");

    if (!yearButtons.length || !nomineesContainer) {
      return;
    }

    let currentStartIndex = 0;

    /**
     * Limit visible years based on screen size
     * Mobile: 3 years, Desktop: 5 years
     */
    function limitVisibleYears(centerOnActive = true) {
      const isMobile = window.innerWidth < 1000;
      const maxVisible = isMobile ? 3 : 5;
      
      if (centerOnActive) {
        // Find the active button
        let activeIndex = -1;
        yearButtons.forEach((btn, index) => {
          if (btn.classList.contains("year-menu__list-item--active")) {
            activeIndex = index;
          }
        });

        // Calculate start and end indices centered around active
        currentStartIndex = Math.max(0, activeIndex - Math.floor(maxVisible / 2));
      }

      let endIndex = currentStartIndex + maxVisible;

      // Adjust if we're at the end
      if (endIndex > yearButtons.length) {
        endIndex = yearButtons.length;
        currentStartIndex = Math.max(0, endIndex - maxVisible);
      }

      // Show/hide buttons
      yearButtons.forEach((btn, index) => {
        if (index >= currentStartIndex && index < endIndex) {
          btn.parentElement.style.display = "";
        } else {
          btn.parentElement.style.display = "none";
        }
      });

      // Update arrow visibility
      updateArrowVisibility(maxVisible);
    }

    /**
     * Update arrow button state based on current position
     */
    function updateArrowVisibility(maxVisible) {
      if (!prevArrow || !nextArrow) return;

      // Disable prev arrow if at the beginning
      if (currentStartIndex === 0) {
        prevArrow.disabled = true;
        prevArrow.style.opacity = "0.3";
        prevArrow.style.cursor = "not-allowed";
      } else {
        prevArrow.disabled = false;
        prevArrow.style.opacity = "1";
        prevArrow.style.cursor = "pointer";
      }

      // Disable next arrow if at the end
      if (currentStartIndex + maxVisible >= yearButtons.length) {
        nextArrow.disabled = true;
        nextArrow.style.opacity = "0.3";
        nextArrow.style.cursor = "not-allowed";
      } else {
        nextArrow.disabled = false;
        nextArrow.style.opacity = "1";
        nextArrow.style.cursor = "pointer";
      }
    }

    /**
     * Navigate to previous set of years
     */
    function navigatePrev() {
      const isMobile = window.innerWidth < 1000;
      const maxVisible = isMobile ? 3 : 5;
      
      if (currentStartIndex > 0) {
        currentStartIndex = Math.max(0, currentStartIndex - 1);
        limitVisibleYears(false);
      }
    }

    /**
     * Navigate to next set of years
     */
    function navigateNext() {
      const isMobile = window.innerWidth < 1000;
      const maxVisible = isMobile ? 3 : 5;
      
      if (currentStartIndex + maxVisible < yearButtons.length) {
        currentStartIndex = Math.min(yearButtons.length - maxVisible, currentStartIndex + 1);
        limitVisibleYears(false);
      }
    }

    // Initialize visibility on load
    limitVisibleYears();

    // Arrow click handlers
    if (prevArrow) {
      prevArrow.addEventListener("click", navigatePrev);
    }
    if (nextArrow) {
      nextArrow.addEventListener("click", navigateNext);
    }

    // Update on window resize
    let resizeTimeout;
    window.addEventListener("resize", function () {
      clearTimeout(resizeTimeout);
      resizeTimeout = setTimeout(function() {
        limitVisibleYears(true);
      }, 150);
    });

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

              // Update visible years after switching (center on new active)
              limitVisibleYears(true);

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
