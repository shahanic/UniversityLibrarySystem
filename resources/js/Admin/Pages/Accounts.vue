<script setup>
import { ref } from 'vue';
import { accountsStore } from '@/Admin/Stores/accountsStores';
import { storeToRefs } from 'pinia';
import AddAccountModal from '@/Admin/Modals/AddAccountModal.vue';


const user = accountsStore();
const { form } = storeToRefs(user);

user.getter();

const showModal = ref(false);
const currentUser = ref(null);  // To store the user being edited

const saveUser = () => {
  if (currentUser.value) {
    user.editUser(form.value);
    user.save();
  } else {
    user.save();
  }
  showModal.value = false;  // Close the modal after saving
};

const addUser = () => {
  currentUser.value = null;  // Clear current user for adding a new user
  showModal.value = true;
};

const editUser = (userx) => {
  currentUser.value = userx;  // Set the user to be edited
  Object.assign(form.value, userx);  // Populate form with user data
  showModal.value = true;
};

const deleteUser = (userx) => {
  user.deleteUser(userx);
};
</script>

<template>
  <admin-layout>
    <template v-slot:main>
      <div>
        <h1>Accounts</h1>
        <p></p>
        <button @click="addUser" class="bg-green-700 text-white px-2 py-1 rounded mr-3">Add New Account</button>
        
        <AddAccountModal :isVisible="showModal" @close="showModal = false "@save="saveUser">
          <div>
        <!--  -->
        <div>
          <h1 style="text-align: center;">Add Account</h1>
        </div>
        <!--  -->

        <div>
            <label for="name">Name:</label><br>
            <input type="text" v-model="form.name" class="w-full rounded-lg border-gray-300">
        </div>
        <div>
          <label for="email">Email:</label><br>
          <input type="text" v-model="form.email" class="w-full rounded-lg border-gray-300">
        </div>
        <div>
          <label for="username">Username:</label><br>
          <input type="text" v-model="form.username" class="w-full rounded-lg border-gray-300">
        </div>
        <div>
          <label for="role">Role:</label><br>
          <select v-model="form.role" class="w-full rounded-lg border-gray-300">
              <option value="1">1</option>
              <option value="2">2</option>
          </select>
        </div>
        <div>
          <label for="password">Password:</label><br>
          <input type="text" v-model="form.password" class="w-full rounded-lg border-gray-300">
        </div>
        <br>
        <!-- <div class="flex justify-start  ">
          <button @click="saveUser" class="bg-green-700 text-white px-2 py-1 rounded mr-3">Save</button>
        </div> -->
      </div>
        </AddAccountModal>

        <table class="min-w-full border-collapse border border-gray-300">
          <thead>
            <tr class="bg-gray-500">
              <th class="border border-white-300 text-white p-2">#</th>
              <th class="border border-white-300 text-white p-2">Name</th>
              <th class="border border-white-300 text-white p-2">Email</th>
              <th class="border border-white-300 text-white p-2">Username</th>
              <th class="border border-white-300 text-white p-2">Role</th>
              <th class="border border-white-300 text-white p-2">Password</th>    
              <th class="border border-white-300 text-white p-2">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(userx, index) in user.users" :key="index" class="bg-white-200">
              <td class="border border-white-300 text-black p-2">{{ index + 1 }}</td>
              <td class="border border-white-300 text-black p-2">{{ userx.name }}</td>
              <td class="border border-white-300 text-black p-2">{{ userx.email }}</td>
              <td class="border border-white-300 text-black p-2">{{ userx.username }}</td>
              <td class="border border-white-300 text-black p-2">{{ userx.role }}</td>
              <td class="border border-white-300 text-black p-2">{{ userx.password }}</td>
              <td class="border border-white-300 text-black p-2 text-center">
                <button @click="editUser(userx)" class="bg-yellow-400 text-black px-2 py-1 rounded mr-3">Edit</button>
                <button @click="deleteUser(userx)" class="bg-red-400 text-black px-2 py-1 rounded">Delete</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </template>
  </admin-layout>
</template>