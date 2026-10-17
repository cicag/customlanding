(function () {
  "use strict";

  /* ---- Mobile navigation ---- */
  var toggle = document.querySelector(".nav-toggle");
  var nav = document.getElementById("primary-nav");

  function setMenu(open) {
    if (!toggle || !nav) { return; }
    nav.classList.toggle("is-open", open);
    toggle.setAttribute("aria-expanded", open ? "true" : "false");
    toggle.setAttribute("aria-label", open ? "Tutup menu navigasi" : "Buka menu navigasi");
  }

  if (toggle && nav) {
    toggle.addEventListener("click", function () {
      setMenu(!nav.classList.contains("is-open"));
    });

    nav.addEventListener("click", function (event) {
      if (event.target.closest("a")) {
        setMenu(false);
      }
    });

    document.addEventListener("keydown", function (event) {
      if (event.key === "Escape" && nav.classList.contains("is-open")) {
        setMenu(false);
        toggle.focus();
      }
    });

    window.addEventListener("resize", function () {
      if (window.innerWidth > 860) {
        setMenu(false);
      }
    });
  }

  /* ---- Active section highlight (keyboard/AT friendly) ---- */
  var navLinks = Array.prototype.slice.call(
    document.querySelectorAll(".nav-list a:not(.btn-flat)[href^='#']")
  );

  var sections = navLinks
    .map(function (link) {
      return document.querySelector(link.getAttribute("href"));
    })
    .filter(Boolean);

  if ("IntersectionObserver" in window && sections.length) {
    var observer = new IntersectionObserver(
      function (entries) {
        entries.forEach(function (entry) {
          if (!entry.isIntersecting) { return; }
          navLinks.forEach(function (link) {
            var current = link.getAttribute("href") === "#" + entry.target.id;
            if (current) {
              link.setAttribute("aria-current", "true");
            } else {
              link.removeAttribute("aria-current");
            }
          });
        });
      },
      { rootMargin: "-45% 0px -50% 0px", threshold: 0 }
    );

    sections.forEach(function (section) {
      observer.observe(section);
    });
  }

  /* ---- Offering image lightbox ---- */
  var lightbox = document.getElementById("lightbox");
  var lightboxImg = lightbox ? lightbox.querySelector(".lightbox__img") : null;
  var lightboxClose = lightbox ? lightbox.querySelector(".lightbox__close") : null;
  var lastTrigger = null;

  function openLightbox(src, alt, trigger) {
    if (!lightbox || !lightboxImg || !src) { return; }
    lightboxImg.src = src;
    lightboxImg.alt = alt || "";
    lightbox.hidden = false;
    document.body.classList.add("has-lightbox");
    lastTrigger = trigger || null;
    if (lightboxClose) { lightboxClose.focus(); }
  }

  function closeLightbox() {
    if (!lightbox || lightbox.hidden) { return; }
    lightbox.hidden = true;
    lightboxImg.removeAttribute("src");
    lightboxImg.alt = "";
    document.body.classList.remove("has-lightbox");
    if (lastTrigger) { lastTrigger.focus(); }
  }

  if (lightbox && lightboxImg) {
    var mediaButtons = document.querySelectorAll(".service__point-media");
    var tapX = 0;
    var tapY = 0;

    function openFromButton(btn) {
      var img = btn.querySelector("img");
      if (img) { openLightbox(img.getAttribute("src"), img.alt, btn); }
    }

    Array.prototype.forEach.call(mediaButtons, function (btn) {
      btn.addEventListener("click", function () {
        openFromButton(btn);
      });

      btn.addEventListener("touchstart", function (event) {
        var t = event.changedTouches[0];
        tapX = t.clientX;
        tapY = t.clientY;
      }, { passive: true });

      btn.addEventListener("touchend", function (event) {
        var t = event.changedTouches[0];
        if (Math.abs(t.clientX - tapX) > 10 || Math.abs(t.clientY - tapY) > 10) {
          return;
        }
        event.preventDefault();
        openFromButton(btn);
      });
    });

    if (lightboxClose) {
      lightboxClose.addEventListener("click", closeLightbox);
    }

    lightbox.addEventListener("click", function (event) {
      if (event.target === lightbox) { closeLightbox(); }
    });

    document.addEventListener("keydown", function (event) {
      if (event.key === "Escape") { closeLightbox(); }
    });
  }
})();
