<script setup>
import {navigationStore}from '@/Admin/Stores/navigationStores';
import {storeToRefs} from 'pinia';


const nav = navigationStore()
const{form} = storeToRefs(nav)  

nav.getter();
</script>
<template>
    <admin-layout>
        <template v-slot:main>
            <div>
                <H1>Navigation</H1>
                <p></p>
                <td></td>
            </div>
            <div>
            <label for="">Menu: </label>
            <input type="text" v-model="form.menu">
        </div>
    
        <div>
            <button @click="nav.save()">Save</button>
        </div>

  

    
    <div>
        <table>
            <thead>
                <th>#</th>
                <th>Menu</th>
            </thead>  
            <tbody>
                <tr v-for="(navx, i) in nav.navigations":key="i">
                    <td>{{++i}}</td>
                    <td>{{navx.menu}}</td>
              
                    <td>
                        <button @click="nav.editNav(navx)">Edit</button>
                        <button @click="nav.deleteNavs(navx)">Delete</button>
                    </td>
                   

                </tr>
            </tbody>
        </table>
    </div>
        </template>
    </admin-layout>
</template>