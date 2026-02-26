import CookieHandleSelect from './fieldtypes/CookieHandleSelect.vue';
import Settings from './pages/Settings.vue';


Statamic.booting(() => {
    Statamic.$inertia.register('cookie-byte::settings', Settings);

    Statamic.$components.register('cookie_cover-fieldtype', CookieHandleSelect);
    Statamic.$components.register('cookie_category-fieldtype', CookieHandleSelect);
});