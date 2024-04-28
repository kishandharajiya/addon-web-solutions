import axios from "axios";
const auth = {
    state: {
        authenticated: false,
        user: {},
    },
    getters: {
        authenticated(state) {
            return state.authenticated;
        },
        user(state) {
            axios.defaults.headers.common['Authorization'] = `Bearer `+ state.user.token
            return state.user;
        },
    },
    mutations: {
        SET_AUTHENTICATED(state, value) {
            state.authenticated = value;
        },
        SET_USER(state, value) {
            console.log(value);
            state.user = value;
        },
    },
    actions: {
        setUser(context, payload) {
            context.commit("SET_USER", payload);
            context.commit("SET_AUTHENTICATED", true);
        },
        removeUser(context) {
            context.commit("SET_USER", {});
            context.commit("SET_AUTHENTICATED", false);
        },
    },
};
export default auth;
