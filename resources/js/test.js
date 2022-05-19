import Vue from "vue";
import App from "./Layouts/test.vue";
import axios from "axios";
import Vuex from "vuex";
Vue.prototype.$http = axios;
Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        users: [],
        selectedUsers: {},
    },
    mutations: {
        updateUsers(state, payload) {
            state.users = payload;
        },
        updateSelectedUsers(state, payload) {
            state.selectedUsers = payload;
        },
    },
    getters: {
        users: state => state.users,
        selusers: state => state.selectedUsers,
    },
    actions: {
        updateusers({ commit, dispatch }, payLoad) {
            commit("updateUsers", payLoad);
        },
        updateSelUsers({ commit, dispatch }, payLoad) {
            commit("updateSelectedUsers", payLoad);
        },
    }
});
new Vue({
    render: h => h(App),
    store
}).$mount("#appTest");