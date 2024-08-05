<template>
  <admin-layout>
    <template v-slot:main>
      <div class="main-container">
        <!-- <router-link :to="{ name: 'Navigation'}" ><</router-link> -->

        <AddSubNavigationModal :isVisible="showModal" @close="showModal = false" @save="saveSubNav"></AddSubNavigationModal>

        <div v-if="subnav.sub_menus.length">
          <h2 class="header-title">Sub Navigation List</h2>
          <button @click="addSubNav" class="button button-add">Add Sub Menu</button>
          <br>
          <table class="styled-table">
            <thead>
              <tr>
                <th class="header-cell">Title</th>
                <th class="header-cell">Navigation</th>
                <th style="width: 50%; font-weight: bold; text-transform: uppercase; font-size: 0.875em; "  >Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="item in subnav.sub_menus" :key="item.id" class="table-row">
                <td class="table-cell">{{ item.submenu }}</td>
                <td class="table-cell">{{ item.menu }}</td>
                <td class="table-cell actions">
                  <router-link :to="{ name: 'GenericPage', params: { subslug:item.slug }, query: { id: item.id } }" custom v-slot="{ navigate }">
                    <button @click="navigate" class="button button-view">
                      <i class="bi bi-eye" style="margin-right: 8px;"></i>Pages</button>
                  </router-link>
                  <button @click="editSubNav(item)" class="button button-edit">
                    <i class="bi bi-pencil-square"></i>
                  </button>
                  <button @click="deleteSubNav(item)" class="button button-delete">
                    <i class="bi bi-trash"></i>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div> 
        <div v-if="!subnav.sub_menus.length">
          <h2 class="header-title">Sub Navigation List</h2><br>
          <p style="max-width: fit-content; margin-left: auto; margin-right: auto; text-align: center">SORRY! NO RESULTS FOUND:( <br>Seems like there's no sub navigation, would you like to add one or check out its pages instead?</p>
          <br>
            <div style="max-width: fit-content; margin-left: auto; margin-right: auto;">
              <button style="margin-right: 10px;"@click="addSubNav" class="button button-add">Add Sub Menu</button>
            <router-link style= "margin-left: 10px" :to="{ name: 'GenericPage', params: { subslug: nav_slug }, query: { id: id } }" custom v-slot="{ navigate }">
              <button  @click="navigate" class="button button-view">
                <i class="bi bi-eye" style="margin-right: 8px;"></i>Pages</button>
            </router-link>
            </div>
          </div>
        </div>
    </template>
  </admin-layout>
</template>

<script setup>
import AddSubNavigationModal from '@/Admin/Modals/AddSubNavigationModal.vue';
import { useRoute } from 'vue-router';
import { watchEffect, ref } from 'vue';
import { subnavigationsStore } from '@/Admin/Stores/subnavigationStore';
import { storeToRefs } from 'pinia';

import { navigationStore } from '@/Admin/Stores/navigationStores';
const nav = navigationStore();

const route = useRoute();
const subnav = subnavigationsStore();
const { form } = storeToRefs(subnav);
const id = route.query.id;
const nav_slug = route.params.slug

watchEffect(() => {
  subnav.fetchSubNavData(id);
});

const showModal = ref(false);
const currentSubNav = ref(null);

const saveSubNav = () => {
  const id = route.params.id;
  if (currentSubNav.value) {
    subnav.editSubNav(form.value);
    subnav.save(id);
  } else {
    subnav.save(id);
  }
  showModal.value = false;
};

const addSubNav = () => {
  currentSubNav.value = null;
  showModal.value = true;
};

const editSubNav = (subnavx) => {
  currentSubNav.value = subnavx;
  Object.assign(form.value, subnavx);
  showModal.value = true;
};

const deleteSubNav = (subnavx) => {
  subnav.deleteSubNav(subnavx);
};
</script>


<style scoped>
.main-container {
  width: 90%;
  margin: 0 auto;
  margin-top: 2%;
}

.header-title {
  text-align: center;
  margin-bottom: 10px;
  font-size: 1.2em;
  font-weight: bold;
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
}

.button-add {
  margin-bottom: 20px;
}

.button-view {
  background-color: #4CAF50;
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

.header-cell {
  padding: 10px 15px;
  font-weight: bold;
  text-transform: uppercase;
  font-size: 0.875em;
  text-align: left;
}

.table-cell {
  padding: 10px 15px;
  font-size: 0.875em;
  color: #333;
}

.table-row {
  border-bottom: 1px solid #e0e0e0;
  height: 50px;
}

.table-row:nth-child(even) {
  background-color: #f9f9f9;
}

.table-row:hover {
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
