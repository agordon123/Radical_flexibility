import "./bootstrap";
import "../css/app.css";
import {  h,  createApp } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy/dist/vue.m";
import i18n from "./i18n/i18n";
import { loadStripe } from "@stripe/stripe-js";
const stripe = loadStripe("pk_test_51Mmj2MDxs152QbBr97fqNjqKtSUEyafFaoNgfip4Uj2fwepJ5vnxcutN6GEXPGGq2Ydv9D5vuBIbs1fwmncclwSn00BFSCTNFs");
const appName =
    window.document.getElementsByTagName("title")[0]?.innerText ||
    "Radical Flexibility";
createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        ),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy, i18n,stripe)
            .mount(el);
    },
    progress: {
        color: "#4B5563",
    },
});
