
<template>
    <admin-layout>
        <template v-slot:main>
            <div class="container mx-auto p-4">
                <h1 class="text-2xl font-bold mb-4" >Main Navigation List</h1>
                <table class="min-w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border border-gray-300 p-2">Title</th>
                            <th class="border border-gray-300 p-2"></th>
                        </tr>
                        
                    </thead>  
                    <tbody>
                        <tr v-for="navx in nav.navigations":key="i">
                            <td class="border border-gray-300 p-2" style="width: 78%;">{{navx.menu}}</td>
                            <td class="border border-gray-300 p-1 text-center">
                                <router-link class="bg-yellow-500 text-black px-2 py-1 rounded mr-3" :to="{name: 'SubNavigation', params: {id: navx.id}}">View</router-link>
                            </td>
                        </tr>
                    </tbody>
                </table> <br><br>


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
subnav.getter();

</script>