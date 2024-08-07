<template>
  <div v-if="isVisible" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg w-1/3">
      <div>
        <div class="modal-header mb-4 text-center">
          <h1 class="text-xl font-bold">Add Menu</h1>
        </div>
        <div class="mb-4">
          <label for="title" class="block text-sm font-medium text-gray-700">Title:</label>
          <input
            type="text"
            v-model="gal.form.title"
            class="mt-1 block w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            placeholder="Enter title"
          >
        </div>
      </div>
      <div class="flex justify-end items-center mt-4">
        <button
          @click="saveGallery"
          class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mr-2"
        >
          Save
        </button>
        <button
          @click="closeModal"
          class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
        >
          Close
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { defineProps, defineEmits } from 'vue';
import { galleriesStore } from '@/Admin/Stores/galleriesStores';

const props = defineProps({
  isVisible: {
    type: Boolean,
    required: true
  }
});

const emit = defineEmits(['close', 'save']);
const gal = galleriesStore();

const closeModal = () => {
  gal.form.id = '';
  gal.form.title = '';
  gal.form.slug = '';
  gal.form.created_at = '';
  gal.form.updated_at = '';
  emit('close');
};

const saveGallery = () => {
  emit('save');
};
</script>

<style scoped>
/* Add any additional styling for the modal here if needed */
</style>