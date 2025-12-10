<template>
  <div class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center">
    <div class="bg-white p-4 rounded w-96">
      <h2 class="text-lg mb-2">Create Character</h2>
      <form @submit.prevent="submit">
        <div class="mb-2">
          <label class="block">Name</label>
          <input v-model="form.name" required class="w-full p-1 border rounded" />
        </div>
        <div class="mb-2">
          <label class="block">Gender</label>
          <select v-model="form.gender" class="w-full p-1 border rounded">
            <option value="">Select Gender</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="n/a">N/A</option>
          </select>
        </div>
        <div class="mb-2">
          <label class="block">Birth Year</label>
          <input v-model="form.birth_year" type="date" class="w-full p-1 border rounded" />
        </div>
        <div class="mb-2 flex space-x-2">
          <input v-model="form.height" type="number" placeholder="Height (cm)" class="w-1/2 p-1 border rounded" />
          <input v-model="form.mass" type="number" placeholder="Mass (kg)" class="w-1/2 p-1 border rounded" />
        </div>
        <div class="flex justify-end space-x-2">
          <button type="button" @click="$emit('close')" class="px-3 py-1 border rounded">Cancel</button>
          <button type="submit" class="px-3 py-1 bg-blue-600 text-white rounded">Save</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {
    data() {
        return {
            form: { name: '', gender: '', birth_year: '', height: '', mass: '' }
        }
    },
    methods: {
        submit() {
            fetch('/api/characters', {
                method: 'post',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(this.form)
            }).then((result) => {
                if(result.status === 201) {
                    console.log('character created successfully!');
                    this.$emit('created');
                    this.$emit('close');
                } else {
                    console.error('error creating character', result.statusText);
                }
            }).catch((err) => {
                console.error('error creating character', err);
            });
        }
    }
}
</script>
