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
        environments: [],
        selectedEnv: {},
        isLoading: false,
        fullPage: false,
    },
    mutations: {
        updateEnvs(state, payload) {
            state.environments = payload;
        },
        updateSelectedEnv(state, payload) {
            state.selectedEnv = payload;
        },
        SET_IS_LOADING(state, payload) {
            state.isLoading = payload;
        },
        SET_IS_FULLPAGE(state, payload) {
            state.fullPage = payload;
        }
    },
    getters: {
        myenvs: state => state.environments,
        selenv: state => state.selectedEnv,
        getIsLoading: state => state.isLoading,
        getIsFullpage: state => state.fullPage,
    },
    actions: {
        updateenvs({ commit, dispatch }, payLoad) {
            commit("updateEnvs", payLoad);
        },
        updateSelEnv({ commit, dispatch }, payLoad) {
            commit("updateSelectedEnv", payLoad);
        },
        updateEnv({ commit, dispatch , getters}, payLoad) {
            let myenvs = getters.myenvs;
            let newenvarr = myenvs.filter(function(env) {
                return env.id != payLoad.id;
            });
            newenvarr.push(payLoad);
            commit("updateEnvs", newenvarr);
        },

        deleteEnv({ commit, dispatch, getters }) {
            let myenvs = getters.myenvs;
            let newenvarr = myenvs.filter(function(env) {
                return env.id != getters.selenv.id;
            });
            commit("updateEnvs", newenvarr);
            $("#deleteenvModal").modal("hide");
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