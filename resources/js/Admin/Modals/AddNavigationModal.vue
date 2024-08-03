<template>
  <div v-if="isVisible" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg w-1/4">
      <div>
              <div class="modal-header">
                <h1>Add Menu</h1>
              </div>
              <div>
                <label for="menu">Menu:</label><br>
                <input type="text" v-model="nav.form.menu" class="input-text">
              </div>
            </div>
      <div class="flex justify-between items-center mt-1 ">
          <button @click="saveNav" class="bg-green-700 text-white px-2 py-1 rounded">Save</button>
          <button @click="closeModal" class="bg-red-500 text-white px-4 py-1 rounded mr-3">Close</button>
        </div>
    </div>
  </div>
</template>

<script setup>
import { defineProps, defineEmits } from 'vue';
import { navigationStore } from '@/Admin/Stores/navigationStores';

const props = defineProps({
  isVisible: {
    type: Boolean,
    required: true
  }
});

const emit = defineEmits(['close', 'save']);
const nav = navigationStore();

const closeModal = () => {
  nav.form.id = '';
  nav.form.menu = '';
  nav.form.slug = '';
  nav.form.created_at = '';
  nav.form.updated_at = '';
  emit('close');
};

const saveNav = () => {
  emit('save');
};
</script>


<style scoped>
/* Add any additional styling for the modal here if needed */
</style>