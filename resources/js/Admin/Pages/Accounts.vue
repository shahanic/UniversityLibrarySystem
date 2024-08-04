<template>
  <admin-layout>
    <template v-slot:main>
      <div style="width: 90%; margin: 0 auto; margin-top: 2%;">
        <h1 style="text-align: center; margin-bottom: 10px;">Accounts Here</h1>
        
        <button @click="addUser" class="button button-add">Add New Account</button>
        <br><br>

        <AddAccountModal :isVisible="showModal" @close="showModal = false" @save="saveUser"></AddAccountModal>
        <br>
        <table class="styled-table">
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Username</th>
              <th>Role</th>
              <th>Password</th>
              <th class="actions-header"> Action </th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(userx, index) in user.users" :key="index">
              <td>{{ userx.name }}</td>
              <td>{{ userx.email }}</td>
              <td>{{ userx.username }}</td>
              <td>{{ userx.role }}</td>
              <td>{{ userx.password }}</td>
              <td class="actions">
                <button @click="editUser(userx)" class="button button-edit">
                  <i class="bi bi-pencil-square"></i>
                </button>
                <button @click="deleteUser(userx)" class="button button-delete">
                  <i class="bi bi-trash"></i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </template>
  </admin-layout>
</template>

<script setup>
import { ref } from 'vue';
import { accountsStore } from '@/Admin/Stores/accountsStores';
import { storeToRefs } from 'pinia';
import AddAccountModal from '@/Admin/Modals/AddAccountModal.vue';

const user = accountsStore();
const { form } = storeToRefs(user);

user.getter();

const showModal = ref(false);
const currentUser = ref(null);

const saveUser = () => {
  if (currentUser.value) {
    user.editUser(form.value);
    user.save();
  } else {
    user.save();
  }
  showModal.value = false;
};

const addUser = () => {
  currentUser.value = null;
  showModal.value = true;
};

const editUser = (userx) => {
  currentUser.value = userx;
  Object.assign(form.value, userx);
  showModal.value = true;
};

const deleteUser = (userx) => {
  user.deleteUser(userx);
};
</script>

<style scoped>
.button {
  background-color: #4CAF50;
  color: white;
  padding: 8px 12px;
  border: none;
  border-radius: 4px;
  font-size: 0.875em;
  font-weight: 600;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.button-add {
  margin-bottom: 20px;
}

.button-edit {
  background-color: #ffc107;
  color: black;
}

.button-edit:hover {
  background-color: #e0a800;
}

.button-delete {
  background-color: #dc3545;
  color: white;
}

.button-delete:hover {
  background-color: #c82333;
}

.input-text {
  width: 100%;
  border-radius: 4px;
  border: 1px solid #ccc;
  padding: 8px;
}

.styled-table {
  width: 100%;
  border-collapse: collapse;
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  margin: 0 auto;
}

.styled-table thead {
  background-color: #d3d3d3;
  color: black;
}

.styled-table th {
  padding: 10px 15px;
  font-weight: bold;
  text-transform: uppercase;
  font-size: 0.875em;
  text-align: left;
}

.styled-table th.actions-header {
  text-align: center;
}

.styled-table tbody {
  background-color: #ffffff;
}

.styled-table tbody tr {
  border-bottom: 1px solid #e0e0e0;
  height: 50px;
}

.styled-table tbody td {
  padding: 10px 15px;
  font-size: 0.875em;
  color: #333;
}

.styled-table tbody tr:nth-child(even) {
  background-color: #f9f9f9;
}

.styled-table tbody tr:hover {
  background-color: #f1f1f1;
}

.actions {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 10px;
}

.modal-header {
  text-align: center;
  margin-bottom: 20px;
}
</style>
