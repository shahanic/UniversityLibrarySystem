<template>
  <div v-if="isVisible" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg w-1/4">
      <div>
        <div class="modal-header">
          <h1>Add Account</h1>
        </div>

        <div>
          <label for="name">Name:</label><br>
          <input type="text" v-model="account.form.name" class="input-text">
        </div>
        <div>
          <label for="email">Email:</label><br>
          <input type="text" v-model="account.form.email" class="input-text">
        </div>
        <div>
          <label for="username">Username:</label><br>
          <input type="text" v-model="account.form.username" class="input-text">
        </div>
        <div>
          <label for="role">Role:</label><br>
          <select v-model="account.form.role" class="input-text">
            <option value="1">1</option>
            <option value="2">2</option>
          </select>
        </div>
        <div>
          <label for="password">Password:</label><br>
          <input type="text" v-model="account.form.password" class="input-text">
        </div>
      </div>
      <div class="flex justify-between items-center mt-1 ">
          <button @click="saveUser" class="bg-green-700 text-white px-2 py-1 rounded">Save</button>
          <button @click="closeModal" class="bg-red-500 text-white px-4 py-1 rounded mr-3">Close</button>
        </div>
    </div>
  </div>
</template>

<script setup>
import { defineEmits } from 'vue';
import { accountsStore } from '@/Admin/Stores/accountsStores';

const props = defineProps({
  isVisible: {
    type: Boolean,
    required: true
  }
});

const emit = defineEmits(['close', 'save']);
const account = accountsStore();

const closeModal = () => {
  // account.form.id = '';
  // account.form.username = '';
  // account.form.email = '';
  // account.form.role = '';
  // account.form.password = '';
  emit('close');
};

const saveUser = () => {
  emit('save');
};

</script>

<style scoped>
/* Add any additional styling for the modal here if needed */
</style>