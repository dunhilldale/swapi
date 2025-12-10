<template>
  <div class="relative w-full max-w-xl">
    <input v-model="q" @input="onInput" placeholder="Search SWAPI..." class="w-full p-2 border rounded" />
    <div v-if="showDropdown" class="absolute left-0 right-0 bg-white shadow mt-1 rounded max-h-64 overflow-auto z-50">
      <div v-for="(items, category) in results" :key="category" class="p-2 border-b">
        <div class="flex justify-between items-center">
          <strong class="capitalize">{{ category }}</strong>
          <button @click="viewAll(category)" class="text-sm underline">View All</button>
        </div>
        <ul>
          <li v-for="item in items" :key="item.name" class="py-1">{{ item.name || item.title }}</li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
import debounce from 'lodash/debounce';
export default {
  data() {
    return {
      q: '',
      results: {},
      showDropdown: false,
    }
  },
  methods: {
    onInput: debounce(function () {
      if (!this.q) {
        this.showDropdown = false;
        this.results = {};
        return;
      }
      fetch(`/api/search?q=${encodeURIComponent(this.q)}`)
        .then(r => r.json())
        .then(data => {
          this.results = data;
          this.showDropdown = Object.keys(data).length > 0;
        });
    }, 200),
    viewAll(category) {
      // navigate to category list; only 'people' is implemented
      if (category === 'people') {
        window.location.href = '/people';
      } else {
        alert('View All for ' + category + ' not implemented (only People page required).');
      }
    }
  }
}
</script>
