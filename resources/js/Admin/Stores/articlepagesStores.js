import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import { defineStore } from 'pinia';
import axios from 'axios';

export const articlesStore = defineStore('articles', {
  state: () => ({
    editor: ClassicEditor,
    editorConfig: {
      toolbar: ['undo', 'redo', '|', 'heading', '|', 'bold', 'italic', '|', 'bulletedList', 'numberedList', '|', 'blockQuote'],
    },
    currentArticle: null,
    articles: [],
  }),
  actions: {
    async save() {
      if (this.currentArticle) {
      try {
        await axios.post('/save-article', this.currentArticle);
        alert('Content saved successfully!');
      } catch (error) {
        console.error('Error saving article:', error);
        alert('Failed to save content.');
      }
    }
  },
    async fetchArticlesData() {
      try {
        const response = await axios.post('/get-articles');
        this.articles = response.data;
      } catch (error) {
        console.error('Error fetching articles:', error);
      }
    },

    editArticle(articlex) {
      this.title = articlex.title;
      this.abstract = articlex.abstract;
      this.content = articlex.content;
    },

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
