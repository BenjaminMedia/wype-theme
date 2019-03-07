// import external dependencies
import 'intersection-observer';
import 'jquery';

// Import everything from autoload
import './autoload/**/*'

// import local dependencies
import Router from './util/Router';
import common from './routes/common';
import home from './routes/home';
import templateFaq from './routes/faq';

/** Populate Router instance with DOM routes */
const routes = new Router({
  // All pages
  common,
  // Home page
  home,
  templateFaq,
});

// Load Events
jQuery(document).ready(() => routes.loadEvents());
