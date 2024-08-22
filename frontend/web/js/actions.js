let starRating = document.querySelector(".active-stars");
    if (starRating) {
        executeRating(starRating);
    }
    function executeRating(starRating) {
      const stars = [...starRating.getElementsByClassName('stars-rating__star')];
      const ratingInput = document.querySelector('.stars-rating__value');
  
      const starClassInactive = 'stars-rating__star';
      const starClassActive = 'stars-rating__star stars-rating__star--fill';
      const starsLength = stars.length;
      let i;
  
      stars.map(star => {
          star.onclick = () => {
              i = stars.indexOf(star);
  
              if (star.className === starClassInactive) {
                  for (i; i >= 0; --i) {
                      stars[i].className = starClassActive;
                  }
              } else {
                  for (i; i < starsLength; ++i) {
                      stars[i].className = starClassInactive;
                  }
              }
  
              ratingInput.value = stars.filter(star => star.classList.contains('stars-rating__star--fill')).length;
          }
      })
  }