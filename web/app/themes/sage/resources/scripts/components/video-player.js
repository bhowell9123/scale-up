/**
 * Video Player Component
 * 
 * Handles custom video player functionality and YouTube/Vimeo embeds
 */
export const videoPlayer = {
  players: {},
  
  init() {
    this.initCustomPlayers()
    this.initVideoModals()
  },
  
  /**
   * Initialize custom video players
   */
  initCustomPlayers() {
    const videoPlayers = document.querySelectorAll('.video-player')
    
    videoPlayers.forEach(player => {
      const videoId = player.dataset.videoId
      const playButton = player.querySelector('.play-button')
      
      if (!videoId || !playButton) return
      
      playButton.addEventListener('click', () => {
        this.playVideo(player, videoId)
      })
    })
  },
  
  /**
   * Initialize video modal functionality
   */
  initVideoModals() {
    const modalTriggers = document.querySelectorAll('[data-video-modal]')
    
    modalTriggers.forEach(trigger => {
      const videoId = trigger.dataset.videoModal
      
      trigger.addEventListener('click', (e) => {
        e.preventDefault()
        this.openVideoModal(videoId)
      })
    })
    
    // Close modal when clicking outside content
    document.addEventListener('click', (e) => {
      const modal = document.querySelector('.video-modal.active')
      if (modal && !modal.querySelector('.video-modal-content').contains(e.target)) {
        this.closeVideoModal(modal)
      }
    })
    
    // Close modal with escape key
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') {
        const modal = document.querySelector('.video-modal.active')
        if (modal) {
          this.closeVideoModal(modal)
        }
      }
    })
  },
  
  /**
   * Play video in player
   * 
   * @param {HTMLElement} player - The video player element
   * @param {string} videoId - The video ID
   */
  playVideo(player, videoId) {
    // Check if video is YouTube
    if (videoId.includes('youtube') || videoId.match(/^[a-zA-Z0-9_-]{11}$/)) {
      this.playYouTubeVideo(player, videoId)
    } 
    // Check if video is Vimeo
    else if (videoId.includes('vimeo') || videoId.match(/^\d+$/)) {
      this.playVimeoVideo(player, videoId)
    }
    // Otherwise assume it's a local video
    else {
      this.playLocalVideo(player, videoId)
    }
  },
  
  /**
   * Play YouTube video
   * 
   * @param {HTMLElement} player - The video player element
   * @param {string} videoId - The YouTube video ID
   */
  playYouTubeVideo(player, videoId) {
    // Extract YouTube ID if full URL is provided
    if (videoId.includes('youtube.com') || videoId.includes('youtu.be')) {
      const regex = /(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/
      const match = videoId.match(regex)
      videoId = match ? match[1] : videoId
    }
    
    // Create iframe
    const iframe = document.createElement('iframe')
    iframe.src = `https://www.youtube.com/embed/${videoId}?autoplay=1&rel=0`
    iframe.width = '100%'
    iframe.height = '100%'
    iframe.allow = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture'
    iframe.allowFullscreen = true
    
    // Replace player content with iframe
    player.innerHTML = ''
    player.appendChild(iframe)
  },
  
  /**
   * Play Vimeo video
   * 
   * @param {HTMLElement} player - The video player element
   * @param {string} videoId - The Vimeo video ID
   */
  playVimeoVideo(player, videoId) {
    // Extract Vimeo ID if full URL is provided
    if (videoId.includes('vimeo.com')) {
      const regex = /vimeo\.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|)(\d+)(?:$|\/|\?)/
      const match = videoId.match(regex)
      videoId = match ? match[2] : videoId
    }
    
    // Create iframe
    const iframe = document.createElement('iframe')
    iframe.src = `https://player.vimeo.com/video/${videoId}?autoplay=1&title=0&byline=0&portrait=0`
    iframe.width = '100%'
    iframe.height = '100%'
    iframe.allow = 'autoplay; fullscreen; picture-in-picture'
    iframe.allowFullscreen = true
    
    // Replace player content with iframe
    player.innerHTML = ''
    player.appendChild(iframe)
  },
  
  /**
   * Play local video
   * 
   * @param {HTMLElement} player - The video player element
   * @param {string} videoId - The video ID or path
   */
  playLocalVideo(player, videoId) {
    // Create video element
    const video = document.createElement('video')
    video.src = videoId.includes('/') ? videoId : `/assets/videos/${videoId}.mp4`
    video.controls = true
    video.autoplay = true
    video.width = '100%'
    video.height = '100%'
    
    // Replace player content with video
    player.innerHTML = ''
    player.appendChild(video)
  },
  
  /**
   * Open video modal
   * 
   * @param {string} videoId - The video ID
   */
  openVideoModal(videoId) {
    // Create modal if it doesn't exist
    let modal = document.querySelector('.video-modal')
    
    if (!modal) {
      modal = document.createElement('div')
      modal.className = 'video-modal'
      modal.innerHTML = `
        <div class="video-modal-content">
          <button class="video-modal-close">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <line x1="18" y1="6" x2="6" y2="18"></line>
              <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
          </button>
          <div class="video-player" data-video-id="${videoId}"></div>
        </div>
      `
      document.body.appendChild(modal)
      
      // Add close button event listener
      const closeButton = modal.querySelector('.video-modal-close')
      closeButton.addEventListener('click', () => {
        this.closeVideoModal(modal)
      })
    }
    
    // Show modal
    setTimeout(() => {
      modal.classList.add('active')
      document.body.classList.add('modal-open')
      
      // Play video
      const player = modal.querySelector('.video-player')
      this.playVideo(player, videoId)
    }, 10)
  },
  
  /**
   * Close video modal
   * 
   * @param {HTMLElement} modal - The modal element
   */
  closeVideoModal(modal) {
    modal.classList.remove('active')
    document.body.classList.remove('modal-open')
    
    // Stop video
    setTimeout(() => {
      const player = modal.querySelector('.video-player')
      player.innerHTML = ''
    }, 300)
  }
}