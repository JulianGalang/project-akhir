import './bootstrap';
import Alpine from 'alpinejs';
import mask from '@alpinejs/mask';
import 'flowbite';

Alpine.plugin(mask);
window.Alpine = Alpine;
Alpine.start();
