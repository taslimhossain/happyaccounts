import './bootstrap';

import Alpine from 'alpinejs';
window.Alpine = Alpine;

// Alpine.data('data', () => ({
//     dark            : 'dark',
//     isSideMenuOpen  : false,
//     isPagesMenuOpen : false,
// }))

function getThemeFromLocalStorage() {
    // if user already changed the theme, use it
    if (window.localStorage.getItem('dark')) {
      return JSON.parse(window.localStorage.getItem('dark'))
    }

    // else return their preferences
    return (
      !!window.matchMedia &&
      window.matchMedia('(prefers-color-scheme: dark)').matches
    )
}
function setThemeToLocalStorage(value) {
    window.localStorage.setItem('dark', value)
}

Alpine.data('data', () => ({


    dark: getThemeFromLocalStorage(),
    toggleTheme() {
        this.dark = !this.dark
        setThemeToLocalStorage(this.dark)
    },
    isSideMenuOpen: false,
    toggleSideMenu() {
      this.isSideMenuOpen = !this.isSideMenuOpen
    },
    closeSideMenu() {
      this.isSideMenuOpen = false
    },
    isNotificationsMenuOpen: false,
    toggleNotificationsMenu() {
      this.isNotificationsMenuOpen = !this.isNotificationsMenuOpen
    },
    closeNotificationsMenu() {
      this.isNotificationsMenuOpen = false
    },

    isProfileMenuOpen: false,
    toggleProfileMenu() {
      this.isProfileMenuOpen = !this.isProfileMenuOpen
    },

    isPagesMenuOpen: false,
    togglePagesMenu() {
      this.isPagesMenuOpen = !this.isPagesMenuOpen
      this.is_banking_index = !this.is_banking_index
    },

    toogleMenu($key) {
      this[$key] = !this[$key];
    },




    // Modal
    isModalOpen: false,
    trapCleanup: null,
    openModal() {
      this.isModalOpen = true
      this.trapCleanup = focusTrap(document.querySelector('#modal'))
    },
    closeModal() {
      this.isModalOpen = false
      this.trapCleanup()
    },
    
    open: false,
    toggle() {
        this.open = ! this.open
    },


}))

Alpine.start();
