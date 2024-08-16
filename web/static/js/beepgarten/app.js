document.addEventListener('DOMContentLoaded', function() {

  const beepgartenContainer = document.querySelector('.beepgarten');
  const featuresSection = beepgartenContainer.querySelector('.features');
  const featureCards = featuresSection.querySelectorAll('.card-wrapper');
  const fullscreenFeature = beepgartenContainer.querySelector('.feature-fullscreen');
  const fullscreenCard = fullscreenFeature.querySelector('.card-wrapper');
  const closeButton = fullscreenFeature.querySelector('.close');

  function openFullscreenFeature() {
    const icon = this.querySelector('.icon').innerHTML;
    const title = this.querySelector('.feature-title').textContent;
    const description = this.querySelector('.feature-desc div[data-full-text]').dataset.fullText;
    
    fullscreenCard.querySelector('.icon').innerHTML = icon;
    fullscreenCard.querySelector('.feature-title').textContent = title;
    fullscreenCard.querySelector('.feature-desc').textContent = description;
    
    fullscreenFeature.classList.add('active');
    fullscreenFeature.setAttribute('aria-hidden', 'false');
    closeButton.focus();
    
    const triggerButton = document.querySelector('button.show-more-btn[aria-controls="' + fullscreenFeature.id + '"]');
    if (triggerButton) {
      triggerButton.setAttribute('aria-expanded', 'true');
    }
  }

  function closeFullscreenFeature() {
    fullscreenFeature.classList.remove('active');
    fullscreenFeature.setAttribute('aria-hidden', 'true'); 
    
    const triggerButton = document.querySelector('button.show-more-btn[aria-controls="' + fullscreenFeature.id + '"]');
    if (triggerButton) {
      triggerButton.setAttribute('aria-expanded', 'false');
    }
  }

  function handleFullscreenClick(event) {
    if (event.target === fullscreenFeature || event.target === closeButton) {
      closeFullscreenFeature();
    }
  }

  featureCards.forEach(function(card) {
    const showMoreButton = card.querySelector('button.show-more-btn');
    
    if (showMoreButton) {
      showMoreButton.setAttribute('aria-expanded', 'false');
      showMoreButton.setAttribute('aria-controls', fullscreenFeature.id);
      showMoreButton.addEventListener('click', openFullscreenFeature.bind(card));
    }
    
    card.addEventListener('click', openFullscreenFeature.bind(card));
  });

  if (closeButton) {
    closeButton.addEventListener('click', closeFullscreenFeature);
  }

  fullscreenFeature.addEventListener('click', handleFullscreenClick);

});
