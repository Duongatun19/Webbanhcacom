
import DropDown from './components/Dropdown.vue';
import Card from './components/layouts/Cards/Card.vue';
import fgInput from './components/layouts/Inputs/formGroupInput.vue';
/**
 * You can register global components here and use them as a plugin in your main Vue instance
 */

const GlobalComponents = {
  install(Vue) {
    Vue.component('drop-down', DropDown);
    Vue.component('card', Card);
    Vue.component('fg-input', fgInput);
  }
};

export default GlobalComponents;
