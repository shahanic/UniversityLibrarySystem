import { defineStore } from "pinia";

export const navigationStore = defineStore('subnav', {
    state: () =>{
        return{
            form:{
                submenu: '',

            }
            
        }
    },

    actions: {
        save(){
            let {form} = this;
            axios.post('/save-subnav', form).then(({data})=>{
                this.$reset();
                this.getter();
            });

        },
        getter(){
            axios.post('/get-subnavs').then(({data})=>{
                this.navigations = data;
            })
        },
        editNav(navx){
            this.form = {...subnavx};
        },
        deleteNavs(navx){
            if(confirm('are you sure you want to delete this subnav?')){
                axios.post('/delete-subnavs', navx).then(({data})=>{
                    this.getter();
                })
            }
        }
    }
})