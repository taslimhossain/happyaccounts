import './bootstrap';
import Alpine from 'alpinejs';
import 'flatpickr/dist/flatpickr.min.css';
import flatpickr from 'flatpickr';
import 'choices.js/public/assets/styles/choices.min.css';
import Choices from 'choices.js';



window.Alpine = Alpine;

flatpickr('.happydate', {
  dateFormat: "d/m/Y",
});

const happyselect = document.querySelector('.happyselect');
if(happyselect){
  const choices = new Choices(happyselect, {

  });
}

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

// Get the "Print" button element
const printButton = document.querySelector('#printButton');
if(printButton){
  printButton.addEventListener('click', () => {
    const form = document.querySelector('#filterForm');

    // Add a hidden input field for "is_print" to the form
    const isPrintField = document.createElement('input');
    isPrintField.setAttribute('type', 'hidden');
    isPrintField.setAttribute('name', 'is_print');
    isPrintField.setAttribute('value', 'yes');
    form.appendChild(isPrintField);

    form.target = '_blank';
    form.submit();
  });
}
