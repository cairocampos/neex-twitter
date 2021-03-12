import axios from 'axios';
import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

const store = {
    strict:true,
    state: {
        user: {
            name: "",
            email:""
        }
    },
    mutations: {
        UPDATE_USER(state, payload) {
            state.user = payload;
        }
    },
    actions: {
        getUser(state) {
            axios.get("/user")
            .then(response => {
                state.commit("UPDATE_USER", response.data);
            })
        }
    }
}

export default new Vuex.Store(store);
