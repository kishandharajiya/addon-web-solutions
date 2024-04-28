import "./bootstrap";
import "../sass/app.scss";
import Router from "@/router";
import store from "@/store";
import axios from 'axios';
import { createApp } from "vue/dist/vue.esm-bundler";
import 'bootstrap/dist/css/bootstrap.min.css';
const app = createApp({});

axios.interceptors.response.use(
  response => response, 
    error => {
        if (error.response && error.response.status === 401) {
            store.dispatch('removeUser')
            Router.replace('/login');// Prevent history entry after login
        }
    return Promise.reject(error);
  }
);
app.use(Router);
app.use(store);
app.mount("#app");
 