import.meta.glob([
    '../images/**',
    '../fonts/**',
]);

import * as websiteBase from '../../../../../Modules/WebsiteBase/resources/assets/tailwind/js/website';
window.websiteBase = websiteBase;

import popoverHandler from '../../../../../Modules/WebsiteBase/resources/assets/tailwind/js/popover-handler';
// register global
Alpine.data('popoverHandler', popoverHandler);
