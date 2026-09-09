document.addEventListener('DOMContentLoaded', () => {
  const page = document.body.dataset.page;

  initNavigation();
  initPasswordToggle();

  if (page === 'home') {
    initHomeSearch();
  }

  if (page === 'movies') {
    initMovieFiltering();
    initWatchButtons();
  }

  if (page === 'plans') {
    initPlanButtons();
    initBillingToggle();
  }

  if (page === 'feedback') {
    initFeedbackForm();
  }
});

function initNavigation() {
  const toggle = document.querySelector('[data-nav-toggle]');
  const menu = document.querySelector('[data-nav-menu]');

  if (!toggle || !menu) {
    return;
  }

  const closeMenu = () => {
    menu.classList.remove('is-open');
    toggle.setAttribute('aria-expanded', 'false');
  };

  toggle.addEventListener('click', () => {
    const isOpen = menu.classList.toggle('is-open');
    toggle.setAttribute('aria-expanded', String(isOpen));
  });

  menu.addEventListener('click', (event) => {
    if (event.target.closest('a')) {
      closeMenu();
    }
  });

  document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') {
      closeMenu();
      toggle.focus();
    }
  });
}

function initPasswordToggle() {
  const toggleButton = document.querySelector('[data-toggle-password]');
  const passwordInput = document.getElementById('password');

  if (!toggleButton || !passwordInput) {
    return;
  }

  toggleButton.addEventListener('click', () => {
    const isHidden = passwordInput.type === 'password';
    passwordInput.type = isHidden ? 'text' : 'password';
    toggleButton.textContent = isHidden ? 'Hide password' : 'Show password';
  });
}

function initHomeSearch() {
  const searchBar = document.getElementById('searchbar');
  const searchFeedback = document.getElementById('search-feedback');

  if (!searchBar || !searchFeedback) {
    return;
  }

  searchBar.addEventListener('input', (event) => {
    const value = event.target.value.trim();

    if (value.length === 0) {
      searchFeedback.textContent = 'Try: Inception, Avengers, Sci-Fi';
      return;
    }

    searchFeedback.textContent = `Searching for "${value}"...`;
  });

  searchBar.addEventListener('keydown', (event) => {
    if (event.key !== 'Enter') {
      return;
    }

    const query = searchBar.value.trim();
    if (query) {
      window.location.href = `movies.php?search=${encodeURIComponent(query)}`;
    }
  });
}

function initMovieFiltering() {
  const movieSearch = document.getElementById('movie-search');
  const movieGenre = document.getElementById('movie-genre');
  const movieSort = document.getElementById('movie-sort');
  const moviesGrid = document.getElementById('movies-grid');
  const movieCards = Array.from(document.querySelectorAll('.movie-card'));
  const movieCount = document.getElementById('movie-count');

  if (!movieSearch || !movieGenre || !movieSort || !moviesGrid || movieCards.length === 0 || !movieCount) {
    return;
  }

  const sortCards = (cards, sortValue) => {
    const sorted = [...cards];

    sorted.sort((a, b) => {
      const titleA = (a.dataset.title || '').toLowerCase();
      const titleB = (b.dataset.title || '').toLowerCase();
      const yearA = Number(a.dataset.year || 0);
      const yearB = Number(b.dataset.year || 0);
      const ratingA = Number(a.dataset.rating || 0);
      const ratingB = Number(b.dataset.rating || 0);

      if (sortValue === 'title-desc') return titleB.localeCompare(titleA);
      if (sortValue === 'year-desc') return yearB - yearA;
      if (sortValue === 'year-asc') return yearA - yearB;
      if (sortValue === 'rating-desc') return ratingB - ratingA;
      return titleA.localeCompare(titleB);
    });

    sorted.forEach((card) => moviesGrid.appendChild(card));
  };

  const renderCount = () => {
    const visibleCount = movieCards.filter((card) => card.style.display !== 'none').length;
    movieCount.textContent = `${visibleCount} movie(s) shown`;
  };

  const applyFilters = () => {
    const query = movieSearch.value.trim().toLowerCase();
    const selectedGenre = movieGenre.value;

    movieCards.forEach((card) => {
      const title = (card.dataset.title || '').toLowerCase();
      const genre = (card.dataset.genre || '').toLowerCase();
      const titleMatch = title.includes(query);
      const genreMatch = selectedGenre === 'all' || genre === selectedGenre;
      card.style.display = titleMatch && genreMatch ? 'block' : 'none';
    });

    sortCards(movieCards, movieSort.value);
    renderCount();
  };

  movieSearch.addEventListener('input', applyFilters);
  movieGenre.addEventListener('change', applyFilters);
  movieSort.addEventListener('change', applyFilters);

  const queryFromHome = new URLSearchParams(window.location.search).get('search');
  if (queryFromHome) {
    movieSearch.value = queryFromHome;
  }

  applyFilters();
}

function initWatchButtons() {
  const watchButtons = document.querySelectorAll('.watch-button');
  const movieAction = document.getElementById('movie-action');

  if (watchButtons.length === 0 || !movieAction) {
    return;
  }

  watchButtons.forEach((button) => {
    button.addEventListener('click', (event) => {
      event.preventDefault();
      const title = button.dataset.movie || 'this movie';
      movieAction.textContent = `Now playing preview: ${title}`;
    });
  });
}

function initPlanButtons() {
  const planButtons = document.querySelectorAll('[data-plan-button]');
  const planMessage = document.getElementById('plan-message');

  if (planButtons.length === 0 || !planMessage) {
    return;
  }

  planButtons.forEach((button) => {
    button.addEventListener('click', (event) => {
      event.preventDefault();
      const selectedPlan = button.dataset.plan || 'this';
      planMessage.textContent = `${selectedPlan} plan selected.`;
    });
  });
}

function initBillingToggle() {
  const billingButtons = Array.from(document.querySelectorAll('.billing-button'));
  const prices = Array.from(document.querySelectorAll('.price'));

  if (billingButtons.length === 0 || prices.length === 0) {
    return;
  }

  const updatePricing = (mode) => {
    billingButtons.forEach((button) => {
      button.classList.toggle('active', button.dataset.billing === mode);
    });

    prices.forEach((price) => {
      const value = mode === 'yearly' ? price.dataset.yearly : price.dataset.monthly;
      if (value) {
        price.textContent = value;
      }
    });
  };

  billingButtons.forEach((button) => {
    button.addEventListener('click', () => {
      updatePricing(button.dataset.billing || 'monthly');
    });
  });
}

function initFeedbackForm() {
  const input = document.getElementById('feedback-message');
  const count = document.getElementById('feedback-count');
  const button = document.querySelector('[data-feedback-submit]');
  const status = document.getElementById('feedback-status');

  if (!input || !count || !button || !status) {
    return;
  }

  const updateCounter = () => {
    count.textContent = String(input.value.length);
  };

  input.addEventListener('input', updateCounter);

  button.addEventListener('click', () => {
    status.style.display = 'block';
    status.className = 'form-message success';
    status.textContent = 'Thanks for your feedback! Backend save can be added next.';
  });

  updateCounter();
}
