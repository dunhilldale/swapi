// Entry point for Vue
// import { createApp } from 'vue';
import { createApp } from 'vue/dist/vue.esm-bundler';
import SearchBar from './components/SearchBar.vue';
import PeopleList from './components/PeopleList.vue';

const app = createApp({});

// Register components globally
app.component('search-bar', SearchBar);
app.component('people-list', PeopleList);

app.mount('#app');
