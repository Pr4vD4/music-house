import './bootstrap';
import Alpine from 'alpinejs';

// Импорт Swiper и его модулей
import Swiper from 'swiper';
import { Navigation, Pagination } from 'swiper/modules';

// Делаем Swiper и его модули доступными глобально
window.Swiper = Swiper;
window.Navigation = Navigation;
window.Pagination = Pagination;

// Настраиваем Swiper
Swiper.use([Navigation, Pagination]);

window.Alpine = Alpine;
Alpine.start();
