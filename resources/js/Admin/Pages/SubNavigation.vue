<!-- <script setup>
import {subnavigationsStore}from '@/Admin/Stores/subnavigationsStore';
import {navigationStore}from '@/Admin/Stores/navigationStores';
import {storeToRefs} from 'pinia';


const subnav = subnavigationsStore()
const{form} = storeToRefs(subnav)  

subnav.getter();

import { ref } from 'vue';
import axios from 'axios';

const subNavData = ref([]);

const fetchSubNavData = async (id) => {
    try {
        const response = await axios.get('/get-sub-nav', {params: {id} });
        subNavData.value = response.data;
    } catch (error) {
        console.error('Error fetching sub navigation data:', error);
    }
};
</script>
<template>
    <admin-layout>
        <template v-slot:main>
            <div>
                <H1>Main Navigation</H1>
                <p></p>
                <td></td>
            </div>
            <div>
            <label for="">Navigation id: </label>
            <input type="text" v-model="form.navigation_id">
            <label for="">Submenu: </label>
            <input type="text" v-model="form.submenu">
        </div>
    
        <div>
            <button @click="subnav.save()">Save</button>
        </div>

        <div>
        <table class="min-w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 p-2">#</th>
                    <th class="border border-gray-300 p-2">Navigation ID</th>
                    <th class="border border-gray-300 p-2">Sub Menu</th>
                    <th class="border border-gray-300 p-2">Actions</th>
                </tr>
                
            </thead>  
            <tbody>
                <tr v-for="(subnavx, i) in subnav.sub_menus":key="i">
                    
                    <td class="border border-gray-300 p-2">{{++i}}</td>
                    <td class="border border-gray-300 p-2">{{subnavx.navigation_id}}</td>
                    <td class="border border-gray-300 p-2">{{subnavx.submenu}}</td>
                    
              
                    <td class="border border-gray-300 p-2 text-center">
                        <button class="bg-yellow-500 text-black px-2 py-1 rounded mr-3"  @click="fetchSubNavData(navx.id)">View</button>
                        <button class="bg-yellow-500 text-black px-2 py-1 rounded mr-3"  @click="subnav.editSubNav(navx)">Edit</button>
                        <button class="bg-yellow-500 text-black px-2 py-1 rounded mr-3"  @click="subnav.deleteSubNavs(navx)">Delete</button>
                    </td>
                    <div>
                    <div v-if="subNavData.length">
                        <table class="min-w-full border-collapse border border-gray-300">
                            <thead>
                                <tr class="bg-gray-200">
                                    <th class="border border-gray-300 p-2">Submenus</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in subNavData" :key="item.id">
                                    <td class="border border-gray-300 p-2">{{ item.submenu }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                </tr>
            </tbody>
        </table>
    </div>
        </template>
    </admin-layout>
</template> -->

<script setup>
import {subnavigationsStore}from '@/Admin/Stores/subnavigationsStore';
import {navigationStore}from '@/Admin/Stores/navigationStores';
import {storeToRefs} from 'pinia';
import { useRoute } from 'vue-router';
import {ref} from 'vue';
import axios from 'axios';

const subnav = subnavigationsStore()
const{form} = storeToRefs(subnav)  

const subNavData = ref([]);

const fetchSubNavData = async (id) => {
    try {
        const response = await axios.get('/get-sub-nav', {params: {id} });
        subNavData.value = response.data;
    } catch (error) {
        console.error('Error fetching sub navigation data:', error);
    }
};


</script>
<template>
    <admin-layout>
        <template v-slot:main>
            <div>
                <h1>Sub Navigation</h1>
                
                <table class="min-w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border border-gray-300 p-2">#</th>
                            <th class="border border-gray-300 p-2">Navigation ID</th>
                            <th class="border border-gray-300 p-2">Submenu</th>
                            <th class="border border-gray-300 p-2 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(subnavx, index) in subnav.sub_menus" :key="index">
                            <td class="border border-gray-300 p-2">{{ index + 1 }}</td>
                            <td class="border border-gray-300 p-2">{{ subnavx.navigation_id }}</td>
                            <td class="border border-gray-300 p-2">{{ subnavx.submenu }}</td>
                            <td class="border border-gray-300 p-2 text-center">
                                <button class="bg-yellow-500 text-black px-2 py-1 rounded mr-3" @click="fetchSubNavData(navx.id)">View</button>
                                <button class="bg-yellow-500 text-black px-2 py-1 rounded mr-3" @click="subnav.editSubNav(navx)">Edit</button>
                                <button class="bg-yellow-500 text-black px-2 py-1 rounded mr-3" @click="subnav.deleteSubNavs(navx)">Delete</button>
                            </td>
                            <td>
                                <div v-if="subNavData.length">
                                    <table class="min-w-full border-collapse border border-gray-300">
                                        <thead>
                                            <tr class="bg-gray-200">
                                                <th class="border border-gray-300 p-2">Submenus</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="item in subNavData" :key="item.id">
                                                <td class="border border-gray-300 p-2">{{ item.submenu }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </template>
    </admin-layout>
</template>
