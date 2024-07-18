import axios from "axios";
import { defineStore } from "pinia";

export const navigationStore = defineStore('nav', {
    state: () =>{
        return{
            form:{
                menu: '',

            },
            navigations: [],
            sub_menus: [],
            submenu: "",
            
        }
    },

    actions: {
        save(){
            let {form} = this;
            axios.post('/save-nav', form).then(({data})=>{
                this.$reset();
                this.getter();
            });

        },
        getter(){
            axios.post('/get-navs').then(({data})=>{
                this.navigations = data;
            })
        },
        editNav(navx){
            this.form = {...navx};
        },
        deleteNavs(navx){
            if(confirm('are you sure you want to delete this nav?')){
                axios.post('/delete-navs', navx).then(({data})=>{
                    this.getter();
                })
            }
        },



    }
});