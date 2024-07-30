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
        <h1>Accounts Here</h1>
        <p></p>
        <button @click="addUser" class="bg-green-700 text-white px-2 py-1 rounded mr-3">Add New Account</button>
        <br><br>
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

        
        <table class="min-w-full border-collapse border border-gray-300 shadow-lg rounded-lg">
    <thead>
        <tr class="bg-gray-200 text-white">
            <th class="border border-gray-300 p-2 font-bold">Name</th>
            <th class="border border-gray-300 p-2 font-bold">Email</th>
            <th class="border border-gray-300 p-2 font-bold">Username</th>
            <th class="border border-gray-300 p-2 font-bold">Role</th>
            <th class="border border-gray-300 p-2 font-bold">Password</th>
            <th class="border border-gray-300 p-2"></th>
        </tr>
    </thead>
    <tbody>
        <tr v-for="(userx, index) in user.users" :key="index" class="bg-white">
            <td class="border border-gray-300 text-gray-700 p-2" style="width: 15%">{{ userx.name }}</td>
            <td class="border border-gray-300 text-gray-700 p-2" style="width: 30%">{{ userx.email }}</td>
            <td class="border border-gray-300 text-gray-700 p-2" style="width: 15%">{{ userx.username }}</td>
            <td class="border border-gray-300 text-gray-700 p-2" style="width: 7%">{{ userx.role }}</td>
            <td class="border border-gray-300 text-gray-700 p-2" style="width: 15%">{{ userx.password }}</td>
            <td class="border border-gray-300 text-center p-2">
                <button @click="editUser(userx)" class="bg-yellow-500 text-white px-3 py-2 rounded mr-3 hover:bg-yellow-500 transition duration-300"><i class="bi bi-pencil-square fw-bold text-black"></i></button>
                <button @click="deleteUser(userx)" class="bg-red-500 text-white px-3 py-2 rounded hover:bg-red-600 transition duration-300"><i class="bi bi-trash fw-bold text-white "> </i></button>
            </td>
        </tr>
    </tbody>
</table>


      </div>
    </template>
  </admin-layout>
</template>


<style scoped>
.container {
  width: 100%;
  padding: 100px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  border-radius: 8px;
  background-color: #fff;
}

.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 10px;
}

h2 {
  margin: 0;
  font-size: 1.2em;
  font-weight: bold;
  padding-left: 7px;
  text-align: center;
}

.view-details {
  text-decoration: none;
  color: #007BFF;
  font-size: 0.9em;
}

table {
  width: 100%;
  border-collapse: collapse;
}

th, td {
  padding: 8px;
  text-align: left;
  border-bottom: 1px solid #eee;
}

th {
  font-weight: normal;
  color: #666;
}

.avatar {
  border-radius: 50%;
  width: 32px;
  height: 32px;
  margin-right: 8px;
  vertical-align: middle;
}

.leave {
  color: #FF4500;
}

.negative {
  color: #FF4500;
}

.positive {
  color: #4CAF50;
}
</style>