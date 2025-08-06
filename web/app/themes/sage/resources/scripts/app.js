import { domReady } from '@roots/sage/client'
import { mobileNavigation } from './components/mobile-navigation'
import { videoPlayer } from './components/video-player'
import { formHandler } from './components/form-handler'
import { smoothScroll } from './components/smooth-scroll'
import { ghlIntegration } from './components/ghl-integration'

/**
 * Application entrypoint
 */
domReady(async () => {
  // Initialize components
  mobileNavigation.init()
  videoPlayer.init()
  formHandler.init()
  smoothScroll.init()
  ghlIntegration.init()
})

/**
 * @see {@link https://webpack.js.org/api/hot-module-replacement/}
 */
if (import.meta.webpackHot) import.meta.webpackHot.accept(console.error)