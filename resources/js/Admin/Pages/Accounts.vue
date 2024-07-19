<script setup>
import { accountsStore } from '@/Admin/Stores/accountsStores';
import { storeToRefs } from 'pinia';
import { ref } from 'vue';
import AddAccountModal from '@/Admin/Modals/AddAccountModal.vue';

const user = accountsStore();
const { form, users } = storeToRefs(user);

const showModal = ref(false);

user.getter();

const openModal = () => {
  showModal.value = true;
};

const closeModal = () => {
  showModal.value = false;
};

const saveUser = () => {
  user.save();
  closeModal();
};
</script>

<template>
  <admin-layout>
    <template v-slot:main>
      <div>
        <h1>Accounts Ditoy</h1>
        <button @click="openModal">Add New User</button>
      </div>
      <div>
        <table>
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Email</th>
              <th>Username</th>
              <th>Role</th>
              <th>Password</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(userx, i) in user.users" :key="i">
              <td>{{ i + 1 }}</td>
              <td>{{ userx.name }}</td>
              <td>{{ userx.email }}</td>
              <td>{{ userx.username }}</td>
              <td>{{ userx.role }}</td>
              <td>{{ userx.password }}</td>
              <td>
                <button @click="user.editUser(userx)">Edit</button>
                <button @click="user.deleteUser(userx)">Delete</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <AddAccountModal
        :isVisible="showModal"
        :form="form"
        @close="closeModal"
        @save="saveUser"
      />
    </template>
  </admin-layout>
</template>

<style scoped>
button {
  padding: 10px 20px;
  font-size: 16px;
  cursor: pointer;
}

h1 {
  margin-top: 0;
}

p {
  margin-bottom: 0;
}
</style>




