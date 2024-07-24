import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import { defineStore } from "pinia";

export const articlesStore = defineStore('articles', {
    state: () =>{
        return{
            editor: ClassicEditor,
            editorData: "ckeditor 5 for laravel and vuejs",
            editorConfig: {
                toolbar: [
                    'undo',
                    'redo',
                    '|',
                    'heading',
                    '|',
                    'bold',
                    'italic',
                    '|',
                    'bulletedList',
                    'numberedList',
                    '|',
                    'blockQuote',
                  ],
            },
            title: '',
            abstract: '',
            content: '',
            articles: [],
        }
    },

 

    actions: {
        save(){
            let {form} = this;
            axios.post('/save-article', form).then(({data})=>{
                this.$reset();
                this.getter();
            });
        },
        getter(){
            axios.post('/get-articles').then(({data})=>{
                this.articles = data;
            })
        },
        editArticle(articlex){
            this.form = {...articlex};
        },
        deleteArticle(articlex){
            if(confirm('are you sure you want to delete this article?')){
                axios.post('/delete-articles', articlex).then(({data})=>{
                    this.getter();
                })
            }
        }
    }
})