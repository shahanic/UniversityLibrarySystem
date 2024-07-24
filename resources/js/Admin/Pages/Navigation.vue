
<template>
    <admin-layout>
        <template v-slot:main>
            <!-- <h1 style="padding:20px"></h1> -->
            <div class="container mx-auto p-4">
                <h2>Main Navigation List</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th></th>
                        </tr>
                        
                    </thead>  
                    <tbody>
                        <tr v-for="navx in nav.navigations":key="i">
                            <td style="width: 78%;">{{navx.menu}}</td>
                            <td>
                                <router-link :to="{name: 'SubNavigation', params: {id: navx.id}}">View</router-link>
                            </td>
                        </tr>
                    </tbody>
                </table><br>


            </div>
        </template>
    </admin-layout>
</template>

<script setup>

import {navigationStore}from '@/Admin/Stores/navigationStores';
import {subnavigationsStore}from '@/Admin/Stores/subnavigationsStore';
import {storeToRefs} from 'pinia';

const nav = navigationStore()
const subnav = subnavigationsStore()
const{form} = storeToRefs(nav)  

nav.getter();

</script>

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