import.meta.glob([
    '../images/**',
    '../fonts/**',
]);

import './redirect-overlay.js';

import * as websiteBase from '../../../../../Modules/WebsiteBase/resources/assets/tailwind/js/website';

window.websiteBase = websiteBase;

import popoverHandler from '../../../../../Modules/WebsiteBase/resources/assets/tailwind/js/popover-handler';
// Register the component globally
Alpine.data('popoverHandler', popoverHandler);
