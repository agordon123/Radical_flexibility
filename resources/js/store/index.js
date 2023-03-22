import {createPinia,defineStore} from 'pinia'
const pinia = createPinia();

export const usePaintingStore = defineStore({
    state: () => ({
        paintings: [],
    }),
    actions: {
        async fetchPaintings() {
            try {
                const response = await fetch("/paintings/:id");
                const products = await response.json();
                this.products = products;
            } catch (error) {
                console.error(error);
            }
        },
    },
});
