<script setup>
import {accountsStore}from '@/Admin/Stores/accountsStores';
import {storeToRefs} from 'pinia';




const user = accountsStore()
const{form} = storeToRefs(user)  

user.getter();
</script>
<template>
    <admin-layout>
        <template v-slot:main>
            <div>
                <H1>Accounts Ditoy</H1> 
                <p> </p>
                <td></td>
            </div>
            <div>

        <div>
            <label for="">Name: </label>
            <input type="text" v-model="form.name">
        </div>
        <div>
            <label for="">Email: </label>
            <input type="text" v-model="form.email"> 
        </div>
        <div>
            <label for="">Username: </label>
            <input type="text" v-model="form.username"> 
        </div>
        <div>
            <label for="">Role: </label>
            <input type="text" v-model="form.role"> 
        </div>
        <div>
            <label for="">Password: </label>
            <input type="text" v-model="form.password"> 
        </div>
        <div>
            <button @click="user.save()">Save</button>
        </div>

    </div>

    
    <div>
        <table>
            <thead>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Username</th>
                <th>Role</th>
                <th>Password</th>
            </thead>
            <tbody>
                <tr v-for="(userx, i) in user.users":key="i">
                    
                    <td>{{++i}}</td>
                    <td>{{userx.name}}</td>
                    <td>{{userx.email}}</td>
                    <td>{{userx.username}}</td>
                    <td>{{userx.role}}</td>
                    <td>{{userx.password}}</td>
                    <td>
                        
                        <button @click="user.editUser(userx)">Edit</button>
                        <button @click="user.deleteUser(userx)">Delete</button>
                    </td>
                       
                </tr>
            </tbody>
        </table>
    </div>



        </template>
    </admin-layout>
</template>