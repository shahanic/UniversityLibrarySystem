<script setup>
import { navigationStore } from '@/Admin/Stores/navigationStores';
import { subnavigationsStore } from '@/Admin/Stores/subnavigationsStore';
import { storeToRefs } from 'pinia';

const nav = navigationStore();
const subnav = subnavigationsStore();
const { form } = storeToRefs(nav);

nav.getter();
subnav.getter();

import { ref } from 'vue';
import axios from 'axios';

const subNavData = ref([]);

const fetchSubNavData = async (id) => {
    try {
        const response = await axios.post('/get-sub-nav', { params: { id } });
        subNavData.value = response.data;
    } catch (error) {
        console.error('Error fetching sub navigation data:', error);
    }
};
</script>

<template>
    <admin-layout>
        <template v-slot:main>
            <div class="container mx-auto p-4">
                <h1 class="text-3xl text-black font-bold mb-4 text-center">Main Navigation</h1>
                
                <table class="min-w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-500">
                            <th class="border border-gray-300 p-1 text-black font-bold">#</th>
                            <th class="border border-gray-300 p-1 text-black font-bold">Menu</th>
                            <th class="border border-gray-300 p-1 text-black font-bold">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(navx, i) in nav.navigations" :key="i" class="bg-gray">
                            <td class="border border-gray-300 p-1">{{ ++i }}</td>
                            <td class="border border-gray-300 p-1">{{ navx.menu }}</td>
                            <td class="border border-gray-300 p-1 text-center">
                                <button class="bg-green-500 text-black px-2 py-1 rounded mr-1" @click="fetchSubNavData(navx.id)">View</button>
                                <button class="bg-yellow-500 text-black px-2 py-1 rounded mr-1" @click="nav.editNav(navx)">Edit</button>
                                <button class="bg-red-500 text-black px-2 py-1 rounded mr-1" @click="nav.deleteNavs(navx)">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div v-if="subNavData.length">
                    <div>
                        <h1>Sub Navigation</h1>
                        <p></p>
                        <td></td>
                    </div>
                    <table class="min-w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="border border-gray-300 p-2">Submenu</th>
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
        </template>
    </admin-layout>
</template>
