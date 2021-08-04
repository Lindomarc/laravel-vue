import defaultSettings from '../store/modules/settings'

const title = defaultSettings.title || 'Admin Title'

export default function getPageTitle(pageTitle) {
  if (pageTitle) {
    return `${pageTitle} - ${title}`
  }
  return `${title}`
}
