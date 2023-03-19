import {createPinia,defineStore} from 'pinia'
const pinia = createPinia();

export const useProductsStore = defineStore({
    state: () => ({
        products: [],
    }),
    actions: {
        async fetchProducts() {
            try {
                const response = await fetch("/gallery/:id");
                const products = await response.json();
                this.products = products;
            } catch (error) {
                console.error(error);
            }
        },
    },
});
