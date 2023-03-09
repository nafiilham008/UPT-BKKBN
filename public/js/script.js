document.addEventListener("DOMContentLoaded", function () {
  const elements = document.querySelectorAll(".fade-in");
  const options = {
    rootMargin: "0px 0px -100px 0px",
  };

  const observer = new IntersectionObserver(function (entries, observer) {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add("visible");
        observer.unobserve(entry.target);
      }
    });
  }, options);

  elements.forEach((element) => {
    observer.observe(element);
  });
});

