import {formatDate} from "devextreme/localization";

require('./bootstrap');

import { createApp } from 'vue'
import UsersGrid from './components/UsersGrid'


createApp({
    components: {
        UsersGrid,
    }
}).mount('#app');

