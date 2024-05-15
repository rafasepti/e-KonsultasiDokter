// import './bootstrap';

// import Alpine from 'alpinejs';

// window.Alpine = Alpine;

// Alpine.start();

import './bootstrap';

Echo.channel('my-channel')
    .listen('NewDataCreated', (e) => {
        console.log(e.data);
        // Perbarui UI dengan data baru
    });
