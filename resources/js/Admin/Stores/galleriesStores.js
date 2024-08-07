import axios from "axios";
import { defineStore } from "pinia";

export const galleriesStore = defineStore('gal', {
    state: () =>{
        return{
            form:{
                title: '',
                slug: '',

            },
            galleries: [],
            photos: [],

        }
    },

    actions: {
        generateSlug(title) {
            return title.toLowerCase().replace(/\s+/g, '-');
        },
        save(){
            let {form} = this;
            form.slug = this.generateSlug(form.title);
            axios.post('/save-gallery', form).then(({data})=>{
                this.$reset();
                this.getter();
            });
        },
        getter(){
            axios.post('/get-galleries').then(({data})=>{
                this.galleries = data;
            })
        },
        editGallery(galx){
            this.form = {...galx};
        },
        deleteGalleries(galx){
            if(confirm('are you sure you want to delete this gallery?')){
                axios.post('/delete-galleries', galx).then(({data})=>{
                    this.getter();
                })
            }
        },



    }
});