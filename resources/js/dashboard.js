import Vue from "vue";
import App from "./Layouts/admin.vue";
import axios from "axios";
import Vuex from "vuex";
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';

Vue.component('loading', Loading)

Vue.prototype.$http = axios;
Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        clientlist: [],
        contactlist: [],
        contactlocation: [],
        isLoading: false,
        fullPage: false,
    },
    mutations: {
        updateClientList(state, payload) {
            state.clientlist = payload;
        },
        updateContactList(state, payload) {
            state.contactlist = payload;
        },
        updateContactLocation(state, payload) {
            state.contactlocation = payload;
        },
        SET_IS_LOADING(state, payload) {
            state.isLoading = payload;
        },
        SET_IS_FULLPAGE(state, payload) {
            state.fullPage = payload;
        }
    },
    getters: {
        clientlist: state => state.clientlist,
        contactlist: state => state.contactlist,
        contactlocation: state => state.contactlocation,
        getIsLoading: state => state.isLoading,
        getIsFullpage: state => state.fullPage,
    },
    actions: {
        setclientlist({ commit }, payLoad) {
            commit("updateClientList", payLoad);
        },
        setcontactlist({ commit }, payLoad) {
            commit("updateContactList", payLoad);
        },
        setcontactlocation({ commit }, payLoad) {
            commit("updateContactLocation", payLoad);
        },
        actionSetIsLoading({ commit, dispatch }, payLoad) {
            commit("SET_IS_LOADING", payLoad);
        },
        actionIsfullpage({ commit, dispatch }, payLoad) {
            commit("SET_IS_FULLPAGE", payLoad);
        },
    }
});
new Vue({
    render: h => h(App),
    store
}).$mount("#appDashboard");