<template>
    <admin-layout>
        <template v-slot:main> 
            <div class="container mx-auto p-4">
                <h1 class="text-2xl font-bold mb-4" >{{ pagesStore.pages.length > 0 ? pagesStore.pages[0].submenu : 'No' }} </h1>
                    <div v-if="pagesStore.pages.length">
                        <table class="min-w-full border-collapse border border-gray-300">
                            <thead>
                                <tr class="bg-gray-200" >
                                    <th class="border border-gray-300 p-2" >Title</th>
                                    <th class="border border-gray-300 p-2"> </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in pagesStore.pages" :key="item.id">
                                    <td class="border border-gray-300 p-2">{{ item.name }}</td>
                                    <td class="border border-gray-300 p-1 text-center">
                                        <router-link class="bg-yellow-500 text-black px-2 py-1 rounded mr-3":to="{name: 'ArticlePages', params: {id: item.id}}">Preview</router-link>
                                        <button class="bg-yellow-500 text-black px-2 py-1 rounded mr-3"  @click="subnav.editPage(item)">Edit</button>
                                        <button class="bg-yellow-500 text-black px-2 py-1 rounded mr-3"  @click="subnav.deletePages(item)">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
            </div>
        </template>
    </admin-layout>
</template>

<script setup>
import { useRoute } from 'vue-router';
import {onMounted, ref } from 'vue';

import {pagesStores} from '@/Admin/Stores/pagesStores';
import {storeToRefs} from 'pinia';

const route = useRoute();


const pagesStore = pagesStores()
const{form} = storeToRefs(pagesStore)  

onMounted(async () => {
    const id = ref(route.params.id);
    await pagesStore.fetchPageData(id.value);
});     

pagesStore.getter();
</script>