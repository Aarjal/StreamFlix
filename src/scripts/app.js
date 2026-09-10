// Movie data for the details modal
const MOVIE_DATA = {
    'Avengers': {
        title: 'Avengers',
        year: 2012,
        duration: '2h 23m',
        genre: 'Action',
        rating: 8.0,
        poster: '../../assets/images/avengers.jpg',
        backdrop: '../../assets/images/avengers.jpg',
        synopsis: 'Earth\'s mightiest heroes must come together and learn to fight as a team if they are going to stop the mischievous Loki and his alien army from enslaving humanity.',
        cast: ['Robert Downey Jr.', 'Chris Evans', 'Mark Ruffalo', 'Chris Hemsworth', 'Scarlett Johansson', 'Jeremy Renner'],
        related: ['Inception', 'The Prestige', 'Interstellar']
    },
    'Life of Pi': {
        title: 'Life of Pi',
        year: 2012,
        duration: '2h 7m',
        genre: 'Adventure',
        rating: 7.9,
        poster: '../../assets/images/lifeofpie.jpg',
        backdrop: '../../assets/images/lifeofpie.jpg',
        synopsis: 'A young man who survives a disaster at sea is hurtled into an epic journey of adventure and discovery. While cast away, he forms an unexpected connection with another survivor: a fearsome Bengal tiger.',
        cast: ['Suraj Sharma', 'Irrfan Khan', 'Adil Hussain', 'Tabu', 'Rafe Spall', 'Gérard Depardieu'],
        related: ['Shutter Island', 'The Prestige', 'Interstellar']
    },
    'Inception': {
        title: 'Inception',
        year: 2010,
        duration: '2h 28m',
        genre: 'Sci-Fi',
        rating: 8.8,
        poster: '../../assets/images/inception.jpg',
        backdrop: '../../assets/images/inception.jpg',
        synopsis: 'A thief who steals corporate secrets through the use of dream-sharing technology is given the inverse task of planting an idea into the mind of a C.E.O., but his tragic past may doom the project and his team to disaster.',
        cast: ['Leonardo DiCaprio', 'Marion Cotillard', 'Tom Hardy', 'Elliot Page', 'Ken Watanabe', 'Joseph Gordon-Levitt'],
        related: ['The Prestige', 'Interstellar', 'Shutter Island']
    },
    'The Prestige': {
        title: 'The Prestige',
        year: 2006,
        duration: '2h 10m',
        genre: 'Thriller',
        rating: 8.5,
        poster: '../../assets/images/inception.jpg',
        backdrop: '../../assets/images/inception.jpg',
        synopsis: 'After a tragic accident, two stage magicians engage in a battle to create the ultimate illusion while sacrificing everything they have to outwit each other.',
        cast: ['Christian Bale', 'Hugh Jackman', 'Scarlett Johansson', 'Michael Caine', 'Rebecca Hall', 'David Bowie'],
        related: ['Inception', 'Interstellar', 'Shutter Island']
    },
    'Interstellar': {
        title: 'Interstellar',
        year: 2014,
        duration: '2h 49m',
        genre: 'Sci-Fi',
        rating: 8.7,
        poster: '../../assets/images/inception.jpg',
        backdrop: '../../assets/images/inception.jpg',
        synopsis: 'A team of explorers travel through a wormhole in space in an attempt to ensure humanity\'s survival as Earth\'s time comes to an end.',
        cast: ['Matthew McConaughey', 'Anne Hathaway', 'Jessica Chastain', 'Bill Irwin', 'Ellen Burstyn', 'Michael Caine'],
        related: ['Inception', 'The Prestige', 'Life of Pi']
    },
    'Shutter Island': {
        title: 'Shutter Island',
        year: 2010,
        duration: '2h 18m',
        genre: 'Drama',
        rating: 8.2,
        poster: '../../assets/images/lifeofpie.jpg',
        backdrop: '../../assets/images/lifeofpie.jpg',
        synopsis: 'In 1954, a U.S. Marshal investigates the disappearance of a murderer who escaped from a hospital for the criminally insane on Shutter Island.',
        cast: ['Leonardo DiCaprio', 'Mark Ruffalo', 'Ben Kingsley', 'Max von Sydow', 'Michelle Williams', 'Emily Mortimer'],
        related: ['Inception', 'The Prestige', 'Interstellar']
    }
};

const savedTitles = new Set();

function isTitleSaved(title) {
  return savedTitles.has(title);
}

function toggleSavedTitle(title) {
  if (savedTitles.has(title)) {
    savedTitles.delete(title);
    return false;
  }

  savedTitles.add(title);
  return true;
}

function updateSaveButtonState(button, title) {
  const saved = isTitleSaved(title);

  button.classList.toggle('is-saved', saved);
  button.setAttribute('aria-pressed', String(saved));

  if (button.id === 'movie-modal-save') {
    button.innerHTML = saved ? '&#9829;&nbsp; Saved to List' : '&#9825;&nbsp; Save to List';
    return;
  }

  button.innerHTML = saved ? '&#9829; Saved' : '&#9825; Save';
}

function syncSaveButtons(title) {
  document.querySelectorAll('[data-save-movie]').forEach((button) => {
    if (button.dataset.saveMovie === title) {
      updateSaveButtonState(button, title);
    }
  });
}

function showActionStatus(element, message, isSuccess = true) {
  if (!element) {
    return;
  }

  element.textContent = message;
  element.classList.toggle('success', isSuccess);
}

function handleSaveTitle(title, { statusEl } = {}) {
  const nowSaved = toggleSavedTitle(title);
  syncSaveButtons(title);

  const message = nowSaved
    ? `Saved "${title}" to your list (demo only — not stored yet).`
    : `Removed "${title}" from your list.`;

  const browseStatus = document.getElementById('movie-action');
  showActionStatus(statusEl || browseStatus, message, nowSaved);
}

document.addEventListener('DOMContentLoaded', () => {
  const page = document.body.dataset.page;

  initNavigation();
  initPasswordToggle();
  initMovieModal();

  if (page === 'home') {
    initHomeSearch();
    initPosterCards();
  }

  if (page === 'movies') {
    initMovieFiltering();
    initWatchButtons();
    initMovieCards();
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
  const moviesEmpty = document.getElementById('movies-empty');
  const moviesEmptyMessage = document.getElementById('movies-empty-message');
  const clearFiltersButton = document.getElementById('movies-clear-filters');
  const activeFiltersBar = document.getElementById('movie-active-filters');
  const filterChipsContainer = document.getElementById('movie-filter-chips');
  const clearAllChipsButton = document.getElementById('movie-filter-chips-clear');
  const movieCards = Array.from(document.querySelectorAll('.movie-card'));
  const movieCount = document.getElementById('movie-count');

  if (!movieSearch || !movieGenre || !movieSort || !moviesGrid || movieCards.length === 0 || !movieCount) {
    return;
  }

  const genreLabels = {
    action: 'Action',
    adventure: 'Adventure',
    drama: 'Drama',
    thriller: 'Thriller',
    'sci-fi': 'Sci-Fi',
  };

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

  const getVisibleCount = () => movieCards.filter((card) => card.style.display !== 'none').length;

  const buildEmptyMessage = (query, selectedGenre) => {
    const genreLabel = genreLabels[selectedGenre];

    if (query && selectedGenre !== 'all') {
      return `No titles match "${query}" in ${genreLabel}. Try another search or genre.`;
    }

    if (query) {
      return `No titles match "${query}". Try a different spelling or browse all genres.`;
    }

    if (selectedGenre !== 'all') {
      return `No ${genreLabel} titles in the collection yet. Try another genre.`;
    }

    return 'Try adjusting your search or filters.';
  };

  const renderEmptyState = (visibleCount, query, selectedGenre) => {
    if (!moviesEmpty) {
      return;
    }

    const isEmpty = visibleCount === 0;
    moviesEmpty.hidden = !isEmpty;
    moviesGrid.hidden = isEmpty;

    if (isEmpty && moviesEmptyMessage) {
      moviesEmptyMessage.textContent = buildEmptyMessage(query, selectedGenre);
    }
  };

  const renderCount = (visibleCount) => {
    movieCount.textContent = visibleCount === 1 ? '1 movie shown' : `${visibleCount} movies shown`;
  };

  const createFilterChip = (filterKey, label) => {
    const chip = document.createElement('button');
    chip.type = 'button';
    chip.className = 'movie-filter-chip';
    chip.dataset.filter = filterKey;
    chip.setAttribute('aria-label', `Remove ${label} filter`);
    chip.innerHTML = `<span class="movie-filter-chip__label">${label}</span><span class="movie-filter-chip__remove" aria-hidden="true">&times;</span>`;
    return chip;
  };

  const renderFilterChips = (query, selectedGenre) => {
    if (!filterChipsContainer || !activeFiltersBar) {
      return;
    }

    filterChipsContainer.replaceChildren();

    const chips = [];

    if (query) {
      chips.push(createFilterChip('search', `Search: ${query}`));
    }

    if (selectedGenre !== 'all') {
      chips.push(createFilterChip('genre', genreLabels[selectedGenre] || selectedGenre));
    }

    chips.forEach((chip) => filterChipsContainer.appendChild(chip));

    const hasActiveFilters = chips.length > 0;
    activeFiltersBar.hidden = !hasActiveFilters;
    if (clearAllChipsButton) {
      clearAllChipsButton.hidden = !hasActiveFilters;
    }
  };

  const removeFilter = (filterKey) => {
    if (filterKey === 'search') {
      movieSearch.value = '';
      movieSearch.focus();
    }

    if (filterKey === 'genre') {
      movieGenre.value = 'all';
      movieGenre.focus();
    }

    applyFilters();
  };

  const applyFilters = () => {
    const query = movieSearch.value.trim().toLowerCase();
    const selectedGenre = movieGenre.value;
    const displayQuery = movieSearch.value.trim();

    movieCards.forEach((card) => {
      const title = (card.dataset.title || '').toLowerCase();
      const genre = (card.dataset.genre || '').toLowerCase();
      const titleMatch = title.includes(query);
      const genreMatch = selectedGenre === 'all' || genre === selectedGenre;
      card.style.display = titleMatch && genreMatch ? 'block' : 'none';
    });

    sortCards(movieCards, movieSort.value);

    const visibleCount = getVisibleCount();
    renderCount(visibleCount);
    renderFilterChips(displayQuery, selectedGenre);
    renderEmptyState(visibleCount, displayQuery, selectedGenre);
  };

  const clearFilters = () => {
    movieSearch.value = '';
    movieGenre.value = 'all';
    applyFilters();
    movieSearch.focus();
  };

  movieSearch.addEventListener('input', applyFilters);
  movieGenre.addEventListener('change', applyFilters);
  movieSort.addEventListener('change', applyFilters);
  clearFiltersButton?.addEventListener('click', clearFilters);
  clearAllChipsButton?.addEventListener('click', clearFilters);
  filterChipsContainer?.addEventListener('click', (event) => {
    const chip = event.target.closest('.movie-filter-chip');
    if (!chip) {
      return;
    }

    removeFilter(chip.dataset.filter || '');
  });

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

// Movie Modal Functions
function initMovieModal() {
  // Create modal HTML and inject into body
  const modalHTML = createMovieModalHTML();
  document.body.insertAdjacentHTML('beforeend', modalHTML);

  const modal = document.getElementById('movie-modal');
  const closeBtn = modal?.querySelector('.movie-modal__close');

  if (!modal || !closeBtn) {
    return;
  }

  // Close on backdrop click
  modal.querySelector('.movie-modal__backdrop').addEventListener('click', () => closeMovieModal());

  // Close on close button
  closeBtn.addEventListener('click', () => closeMovieModal());

  // Close on Escape key
  document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape' && modal.classList.contains('is-open')) {
      closeMovieModal();
    }
  });

  // Trap focus in modal when open
  modal.addEventListener('keydown', (event) => {
    if (event.key === 'Tab' && modal.classList.contains('is-open')) {
      trapFocus(event, modal);
    }
  });

  const saveBtn = document.getElementById('movie-modal-save');
  const modalStatus = document.getElementById('movie-modal-status');

  saveBtn?.addEventListener('click', () => {
    const title = modal.dataset.currentTitle;
    if (title) {
      handleSaveTitle(title, { statusEl: modalStatus });
    }
  });

  // Make openMovieModal globally accessible
  window.openMovieModal = openMovieModal;
}

function createMovieModalHTML() {
  return `
    <div class="movie-modal" id="movie-modal" role="dialog" aria-modal="true" aria-labelledby="movie-modal-title">
      <div class="movie-modal__backdrop" tabindex="-1"></div>
      <div class="movie-modal__content">
        <button class="movie-modal__close" aria-label="Close movie details">&times;</button>
        <div class="movie-modal__header">
          <img class="movie-modal__backdrop-image" id="movie-modal-backdrop" src="" alt="">
          <div class="movie-modal__header-overlay"></div>
          <div class="movie-modal__header-content">
            <img class="movie-modal__poster" id="movie-modal-poster" src="" alt="">
            <div class="movie-modal__meta">
              <div class="movie-modal__badges" id="movie-modal-badges"></div>
              <h1 class="movie-modal__title" id="movie-modal-title"></h1>
              <div class="movie-modal__details" id="movie-modal-details"></div>
            </div>
          </div>
        </div>
        <div class="movie-modal__body">
          <section class="movie-modal__section">
            <h2 class="movie-modal__section-title">Synopsis</h2>
            <p class="movie-modal__synopsis" id="movie-modal-synopsis"></p>
          </section>
          <section class="movie-modal__section">
            <h2 class="movie-modal__section-title">Cast</h2>
            <ul class="movie-modal__cast-list" id="movie-modal-cast"></ul>
          </section>
          <section class="movie-modal__section">
            <h2 class="movie-modal__section-title">More Like This</h2>
            <div class="movie-modal__related" id="movie-modal-related"></div>
          </section>
        </div>
        <div class="movie-modal__actions">
          <p id="movie-modal-status" class="movie-modal__status status-text" aria-live="polite"></p>
          <button class="movie-modal__action" id="movie-modal-play" aria-disabled="true">
            &#9656;&nbsp; Play Trailer (Demo)
          </button>
          <button class="movie-modal__action movie-modal__action--ghost" id="movie-modal-save" type="button" aria-pressed="false">
            &#9825;&nbsp; Save to List
          </button>
        </div>
      </div>
    </div>
  `;
}

function openMovieModal(title) {
  const movie = MOVIE_DATA[title];
  if (!movie) {
    console.warn('Movie not found:', title);
    return;
  }

  const modal = document.getElementById('movie-modal');
  if (!modal) return;

  // Populate modal content
  document.getElementById('movie-modal-poster').src = movie.poster;
  document.getElementById('movie-modal-poster').alt = `${movie.title} poster`;
  document.getElementById('movie-modal-backdrop').src = movie.backdrop;
  document.getElementById('movie-modal-backdrop').alt = '';
  document.getElementById('movie-modal-title').textContent = movie.title;
  document.getElementById('movie-modal-synopsis').textContent = movie.synopsis;

  // Badges
  const badgesContainer = document.getElementById('movie-modal-badges');
  badgesContainer.innerHTML = `
    <span class="movie-modal__badge">${movie.year}</span>
    <span class="movie-modal__badge">${movie.duration}</span>
    <span class="movie-modal__badge">${movie.genre}</span>
    <span class="movie-modal__badge movie-modal__badge--rating">&#9733; ${movie.rating}</span>
  `;

  // Details
  document.getElementById('movie-modal-details').innerHTML = `
    <span class="movie-modal__detail">${movie.year}</span>
    <span class="movie-modal__detail">${movie.duration}</span>
    <span class="movie-modal__detail">${movie.genre}</span>
  `;

  // Cast
  const castList = document.getElementById('movie-modal-cast');
  castList.innerHTML = movie.cast.map(actor => `<li class="movie-modal__cast-item">${actor}</li>`).join('');

  // Related movies
  const relatedContainer = document.getElementById('movie-modal-related');
  relatedContainer.innerHTML = movie.related.map(relatedTitle => {
    const relatedMovie = MOVIE_DATA[relatedTitle];
    if (!relatedMovie) return '';
    return `
      <article class="movie-modal__related-item" data-movie-title="${relatedTitle}" tabindex="0" role="button" aria-label="View ${relatedTitle} details">
        <img class="movie-modal__related-poster" src="${relatedMovie.poster}" alt="${relatedTitle} poster" loading="lazy">
        <div class="movie-modal__related-info">
          <h3 class="movie-modal__related-title">${relatedTitle}</h3>
          <p class="movie-modal__related-meta">${relatedMovie.year} &middot; &#9733; ${relatedMovie.rating}</p>
        </div>
      </article>
    `;
  }).join('');

  // Add click handlers for related movies
  relatedContainer.querySelectorAll('.movie-modal__related-item').forEach(item => {
    item.addEventListener('click', () => {
      const relatedTitle = item.dataset.movieTitle;
      openMovieModal(relatedTitle);
    });
    item.addEventListener('keydown', (event) => {
      if (event.key === 'Enter' || event.key === ' ') {
        event.preventDefault();
        const relatedTitle = item.dataset.movieTitle;
        openMovieModal(relatedTitle);
      }
    });
  });

  const saveBtn = document.getElementById('movie-modal-save');
  const modalStatus = document.getElementById('movie-modal-status');

  modal.dataset.currentTitle = title;

  if (saveBtn) {
    saveBtn.dataset.saveMovie = title;
    updateSaveButtonState(saveBtn, title);
  }

  if (modalStatus) {
    modalStatus.textContent = '';
    modalStatus.classList.remove('success');
  }

  // Show modal
  modal.classList.add('is-open');
  document.body.style.overflow = 'hidden';

  // Focus the close button for accessibility
  setTimeout(() => {
    modal.querySelector('.movie-modal__close').focus();
  }, 50);
}

function closeMovieModal() {
  const modal = document.getElementById('movie-modal');
  if (!modal) return;

  modal.classList.remove('is-open');
  document.body.style.overflow = '';
}

function trapFocus(event, modal) {
  const focusableElements = modal.querySelectorAll(
    'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'
  );
  const firstElement = focusableElements[0];
  const lastElement = focusableElements[focusableElements.length - 1];

  if (event.shiftKey && document.activeElement === firstElement) {
    event.preventDefault();
    lastElement.focus();
  } else if (!event.shiftKey && document.activeElement === lastElement) {
    event.preventDefault();
    firstElement.focus();
  }
}

// Initialize poster cards on home page
function initPosterCards() {
  const posterCards = document.querySelectorAll('.poster-card');
  if (posterCards.length === 0) return;

  posterCards.forEach(card => {
    const title = card.querySelector('h3')?.textContent?.trim();
    if (!title) return;

    // Add overlay with Details button
    const overlayHTML = `
      <div class="poster-card__overlay">
        <button class="poster-card__overlay-btn" data-movie-title="${title}" type="button">Details</button>
      </div>
    `;
    card.insertAdjacentHTML('beforeend', overlayHTML);

    // Add click handler
    const overlayBtn = card.querySelector('.poster-card__overlay-btn');
    overlayBtn?.addEventListener('click', (event) => {
      event.preventDefault();
      event.stopPropagation();
      openMovieModal(title);
    });
  });
}

// Initialize movie cards on movies page
function initMovieCards() {
  const movieCards = document.querySelectorAll('.movie-card');
  if (movieCards.length === 0) return;

  movieCards.forEach(card => {
    const title = card.dataset.title;
    if (!title) return;

    // Add overlay with Details button
    const overlayHTML = `
      <div class="movie-card__overlay">
        <button class="movie-card__overlay-btn" data-movie-title="${title}" type="button">Details</button>
        <button class="movie-card__overlay-btn movie-card__overlay-btn--ghost" data-save-movie="${title}" type="button" aria-pressed="false">&#9825; Save</button>
      </div>
    `;
    card.insertAdjacentHTML('beforeend', overlayHTML);

    const detailsBtn = card.querySelector('.movie-card__overlay-btn:not([data-save-movie])');
    const saveBtn = card.querySelector('[data-save-movie]');

    detailsBtn?.addEventListener('click', (event) => {
      event.preventDefault();
      event.stopPropagation();
      openMovieModal(title);
    });

    saveBtn?.addEventListener('click', (event) => {
      event.preventDefault();
      event.stopPropagation();
      handleSaveTitle(title);
    });

    if (saveBtn) {
      updateSaveButtonState(saveBtn, title);
    }
  });
}
