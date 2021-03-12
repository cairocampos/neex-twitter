import Vue from 'vue'
import { ObserveVisibility } from 'vue-observe-visibility'
 
Vue.directive('observe-visibility', ObserveVisibility);
Vue.prototype.moment = window.moment;