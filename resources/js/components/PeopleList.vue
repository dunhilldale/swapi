<template>
  <div>
    <div class="flex justify-between items-center mb-4">
      <h1 class="text-2xl">People</h1>
      <button @click="openCreate" class="px-3 py-1 border rounded">Create</button>
    </div>

    <create-character-modal v-if="showCreate" @close="showCreate=false" @created="fetchList" />

    <table class="w-full table-auto">
      <thead><tr><th>Name</th><th>Gender</th><th>Birth Year</th><th>Height</th><th>Mass</th><th>Action</th></tr></thead>
      <tbody>
        <tr v-for="(p, idx) in people" :key="idx" class="border-b">
          <td>{{ p.name }}</td>
          <td>{{ p.gender }}</td>
          <td>{{ p.birth_year }}</td>
          <td>{{ p.height }}</td>
          <td>{{ p.mass }}</td>
          <td>
            <button v-if="p.custom" @click="showAlert(p.id)" class="text-red-600">Delete</button>
            <span v-else class="text-gray-400">—</span>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import CreateCharacterModal from './CreateCharacterModal.vue';

export default {
  components: { CreateCharacterModal },
  data() {
    return {
      people: [],
      showCreate: false,
    }
  },
  mounted() {
    this.fetchList();
  },
  methods: {
    fetchList() {
      fetch('/api/people')
        .then(r => r.json())
        .then(data => {
          this.people = data;
        });
    },
    openCreate() {
      this.showCreate = true;
    },
    // confirmRemove(id) {
    //   const confirmed = confirm('Delete this custom character?');
    // },
    showAlert(id) {
        console.log(id);
        alert('Delete this custom character? ' + id);
    },
    remove(id) {
      const confirmed = confirm('Delete this custom character?');
      if (!confirmed) return;

      fetch(`/api/characters/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(r => r.json())
        .then(() => {
            this.fetchList();
        })
        .catch(err => console.error('Delete error:', err));
    }
  }
}
</script>
