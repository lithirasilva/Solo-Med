import { createVuetify } from 'vuetify';
import 'vuetify/styles'; // Global Vuetify styles
import '@fortawesome/fontawesome-free/css/all.css'; // Import FontAwesome styles

// FontAwesome icons set
import { aliases, fa } from 'vuetify/iconsets/fa';

const vuetify = createVuetify({
    icons: {
        defaultSet: 'fa', // Set FontAwesome as the default icon set
        aliases,
        sets: { fa }, // Register FontAwesome set
    },
});

export default vuetify;
