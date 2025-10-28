import { createApp } from "vue";
import Toast from "vue3-toastify";
import "vue3-toastify/dist/index.css";

import App from "./App.vue";

const app = createApp(App);
app.use(Toast, {
    autoClose: 3000,
    position: "top-right",
});
app.mount("#app");
