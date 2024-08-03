<template>
  <div v-if="isVisible" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg w-1/4">
      <div>
        <div class="modal-header">
          <h1>Add FAQ</h1>
        </div>

        <div>
          <label for="question">Question:</label><br>
          <input type="text" v-model="faq.form.question" class="input-text">
        </div>
        <div>
          <label for="answer">Answer:</label><br>
          <input type="text" v-model="faq.form.answer" class="input-text">
        </div>
        <div>
          <label for="category">Category:</label><br>
          <select v-model="faq.form.category" class="input-text">
            <option value="1">1</option>
            <option value="2">2</option>
          </select>
        </div>
        <div>
          <label for="status">Status:</label><br>
          <select v-model="faq.form.status" class="input-text">
            <option value="1">1</option>
            <option value="2">2</option>
          </select>
        </div>
      </div>
      <div class="flex justify-between items-center mt-1 ">
          <button @click="saveFaq" class="bg-green-700 text-white px-2 py-1 rounded">Save</button>
          <button @click="closeModal" class="bg-red-500 text-white px-4 py-1 rounded mr-3">Close</button>
        </div>
    </div>
  </div>
</template>

<script setup>
import { defineProps, defineEmits } from 'vue';
import { faqsStore } from '@/Admin/Stores/faqsStores';

const props = defineProps({
  isVisible: {
    type: Boolean,
    required: true
  }
});

const emit = defineEmits(['close', 'save']);
const faq = faqsStore();

const closeModal = () => {
  faq.form.question = '';
  faq.form.answer = '';
  faq.form.category = '';
  faq.form. status= '';
  emit('close');
};

const saveFaq = () => {
  emit('save');
};
</script>

<style scoped>
/* Add any additional styling for the modal here if needed */
</style>