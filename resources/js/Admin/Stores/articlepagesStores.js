// import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import { defineStore } from 'pinia';
import axios from 'axios';
import AddArticle from '../Modals/AddArticle.vue';

export const articlesStore = defineStore('articles', {
  state: () => ({
    currentArticle: null,
    newArticle: {
      title: '',
      abstract: '',
      slug: '',
      content: '',
      status: '',
      gallery_id: '', 
      date: new Date().toISOString().split('T')[0],
    },
    articles: [],
    adding: false,
  }),

  actions: {
    generateSlug(title) { 
      return title.toLowerCase().replace(/\s+/g, '-'); 
  },
  
    cancel(){
      // this.editing = false;
      this.adding = false;    
      // this.preview = false;
  },

    save(){
      if (this.currentArticle){
        axios.post('/save-article', this.currentArticle)
        .then(() =>{
          alert('Content saved successfully!');
        })
        .catch((error) => {
          console.error('Error saving article:', error);
          alert('Failed to save content.');
        })
      }
    },

    addNewArticle(){
      this.newArticle.slug = this.generateSlug(this.newArticle.title);
      if (this.newArticle){
        axios.post('/save-article', this.newArticle)
        .then(() =>{
          alert('Content saved successfully!');
          this.adding = false;
        })
        .catch((error) => {
          console.error('Error saving article:', error);
          alert('Failed to save content.');
        })
      }
    },


    addArticle(article){
      this.newArticle = article;
      this.adding = true;
    },

    fetchArticlesData(){
      this.$reset();
      axios.post('/get-articles')
      .then((response) => {
        this.articles = response.data;
      })
      .catch((error) => {
        console.error('Error fetching articles:', error);

      })
    },



    // editArticle(articlex) {
    //   this.title = articlex.title;
    //   this.abstract = articlex.abstract;
    //   this.content = articlex.content;
    // },

    async deleteArticle(id) {
      if (!id) return;
      try {
        await axios.post('/delete-article', { id });
        this.$reset();
        await this.fetchArticlesData();
        alert('Article deleted successfully!');
      } catch (error) {
        console.error('Error deleting article:', error);
        alert('Failed to delete article.');
      }
    },

    async fetchArticleData(id){
        try {
            const response = await axios.get(`/get-article/${id}`);
            // Assuming the response data is an object for a single article
            this.currentArticle = response.data[0]||null;

        } catch (error) {
            console.error('Error fetching article data:', error);
        }
    }

  },
});
