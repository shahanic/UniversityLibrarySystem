<template>
  <admin-layout>
    <template v-slot:main>
      <div style="width: 90%; margin: 0 auto; margin-top: 2%;">
        <h2 style="text-align: center; margin-bottom: 10px;">MAIN NAVIGATION</h2>
        <div class="add-menu-button">
          <button @click="addNav" class="button button-add">ADD NEW MENU</button>
        </div>

        <transition name="modal-fade" @before-enter="beforeEnter" @enter="enter" @leave="leave">
          <AddNavigationModal v-if="showModal" :isVisible="showModal" @close="showModal = false" @save="saveNav"></AddNavigationModal>
        </transition>
        <table class="styled-table">
          <thead>
            <tr>
              <th>Title</th>
              <th class="actions-header">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="navx in nav.navigations" :key="navx.id">
              <td>{{ navx.menu }}</td>
              <td class="actions">
                <router-link :to="{ name: 'SubNavigation', params: {slug: navx.slug }, query: { id: navx.id }}">
                  <button class="button button-view">
                  <i class="bi bi-eye" style="margin-right: 8px;"></i> View
                  </button>
                </router-link>
                
                <button @click="editNav(navx)" class="button button-edit">
                  <i class="bi bi-pencil-square"></i>
                </button>
                <button @click="deleteNav(navx)" class="button button-delete">
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
import { navigationStore } from '@/Admin/Stores/navigationStores';
import { storeToRefs } from 'pinia';
import AddNavigationModal from '@/Admin/Modals/AddNavigationModal.vue';

const nav = navigationStore();
const { form } = storeToRefs(nav);

nav.getter();
const showModal = ref(false);
const currentNav = ref(null);

const saveNav = () => {
  if (currentNav.value) {
    nav.editNav(form.value);
    nav.save();
  } else {
    nav.save();
  }
  showModal.value = false;
};

const addNav = () => {
  currentNav.value = null;
  showModal.value = true;
};

const editNav = (navx) => {
  currentNav.value = navx;
  Object.assign(form.value, navx);
  showModal.value = true;
};

const deleteNav = (navx) => {
  nav.deleteNavs(navx);
};
</script>

<style scoped>
.add-menu-button {
  text-align: left;
  margin-bottom: 20px;
}

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
  /* margin-right: 10px; */
}

.button-add {
  margin-bottom: 0;
}

.input-text {
  width: 100%;
  border-radius: 4px;
  border: 1px solid #ccc;
  padding: 8px;
}

.styled-table {
  width: 100%;
  margin: 0 auto;
  border-collapse: collapse;
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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
  width: 50%;
  text-align: center;
}

.styled-table tbody {
  background-color: #ffffff;
}

.styled-table tbody tr {
  border-bottom: 1px solid #e0e0e0;
  height: 50px; /* Adjusted row height */
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

.button-view, .button-edit, .button-delete {
  display: flex;
  justify-content: center;
  align-items: center;
}

.button-view i, .button-edit i, .button-delete i {
  font-size: 1.2em; /* Adjusted icon size */
}

.button-view {
  background-color: #4CAF50;
  color: white;
}

.button-view:hover {
  background-color: #45a049;
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

.modal-header {
  text-align: center;
  margin-bottom: 20px;
}
</style>
