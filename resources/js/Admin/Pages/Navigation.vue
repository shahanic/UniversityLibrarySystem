<script setup>
import {navigationStore}from '@/Admin/Stores/navigationStores';
import {storeToRefs} from 'pinia';
import CKEditor from '@ckeditor/ckeditor5-vue';

const nav = navigationStore()
const{form} = storeToRefs(nav)  





nav.getter();
</script>
<template>
    <admin-layout>
        <template v-slot:main>

            <div class="container mx-auto p-4">
                <H1 class="text 3xl font-bold mb-4 text-center">Main Navigation List</H1>
                <!-- <p></p>
                <td></td>
            </div> -->
        <!-- <div>
            <label for="">Menu: </label>
            <input type="text" v-model="form.menu">
        </div>
    
        <div>
            <button class="bg-yellow-500 text-black px-2 py-1 rounded mr-3" @click="nav.save()">Save</button>
        </div> -->

  
    <!-- <div> -->
        <table class="min-w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-400">
                <th class="border border-gray-300 text-white p2">#</th>
                <th class="border border-gray-300 text-white p-2">Title</th>
                <th class="border border-gray-300 p-2"></th>
                </tr>
            </thead>  
            <tbody>
                <tr v-for="(navx, i) in nav.navigations":key="i">
                    <td class="border border-gray-300 text-black p-2">{{++i}}</td>
                    <td class="border border-gray-300 text-black p-2" style="width: 78%;">{{navx.menu}}</td>
                    <td class="boder border-gray-300 p-1 text-center">
                        <button class="bg-green-900 text-white px-2 py-1 rounded"  @click="nav.editNav(navx)">view</button>
                        <!-- <button class="bg-yellow-500 text-black px-2 py-1 rounded mr-3"  @click="nav.editNav(navx)">edit</button>
                        <button class="bg-red-500 text-black px-2 py-1 rounded mr-3"  @click="nav.deleteNavs(navx)">delete</button> -->
                    </td>
                   

                </tr>
            </tbody>
        </table>
    </div>
        </template>
    </admin-layout>
</template>